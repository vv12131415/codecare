<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Product;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

class LoadProductCategory implements FixtureInterface, ContainerAwareInterface, OrderedFixtureInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        for($i = 0; $i < 20; $i++){
            if ($i % 2 == 0) {
                $category = $manager->getRepository('AppBundle:Category')->findOneByName('blabla');
                $product = $manager->getRepository('AppBundle:Product')->findOneByName('iPhone' . $i);

                $category->addProducts($product);
            } else {
                $category = $manager->getRepository('AppBundle:Category')->findOneByName('Test category');
                $product = $manager->getRepository('AppBundle:Product')->findOneByName('iPhone' . $i);

                $category->addProducts($product);
            }
        }

        $manager->flush();
    }

    private function encodePassword(Product $product, $plainPassword)
    {
        $encoder = $this->container->get('security.password_encoder');
        $encoded = $encoder->encodePassword($product, $plainPassword);

        return $encoded;
    }

    public function setContainer(ContainerInterface $container = null)
    {
        // TODO: Implement setContainer() method.
        $this->container = $container;
    }

    public function getOrder()
    {
        return 10;
    }
}
