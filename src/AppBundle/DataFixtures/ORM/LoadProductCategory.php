<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

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
        $products = [
            'iPhone 6',
            'Samsung Galaxy S6',
            'Xiaomi RedMi 3',
            'iPhone 6s',
            'Nokia Lumia',
            'HTC One M8',
            'LG Optimus G',
            'Samsung 4K 32 inch',
            'Sony 4K 32 inch',
            'LG 4K 32 inch',
            'Panasonic 4K 32 inch',
            'Xiaomi 4K 32 inch',
            'Sony 4K 40 inch',
            'Samsung 4K 4- inch',
        ];

        $categories = [
            'Phones',
            'TVs',
        ];

        for ($i = 0; $i < 14; ++$i) {
            if ($i < 7) {
                $category = $manager->getRepository('AppBundle:Category')->findOneByName($categories[0]);
                $product = $manager->getRepository('AppBundle:Product')->findOneByName($products[$i]);

                $category->addProducts($product);
            } else {
                $category = $manager->getRepository('AppBundle:Category')->findOneByName($categories[1]);
                $product = $manager->getRepository('AppBundle:Product')->findOneByName($products[$i]);

                $category->addProducts($product);
            }
        }

        $manager->flush();
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
