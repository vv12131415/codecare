<?php
/**
 * Created by PhpStorm.
 * User: ubuntu
 * Date: 7/10/16
 * Time: 7:51 PM
 */

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\User;
use AppBundle\Form\RegisterFormType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormView;

class RegisterController extends Controller
{

    public function registerAction(Request $request)
    {
        $user = new User();

        $form = $this->createForm(RegisterFormType::class, $user);

        $form->handleRequest($request);

        if($form->isValid()){

            $user = $form->getData();


            $user->setPassword($this->encodePassword($user, $user->getPlainPassword()));

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();


            $url = $this->generateUrl('homepage');

            return $this->redirect($url);
        }

        return [
            'form' => $form->createView(),
        ];
    }

    private function encodePassword(User $user, $plainPassword)
    {
        $encoder = $this->container->get('security.password_encoder');
        $encoded = $encoder->encodePassword($user, $plainPassword);

        return $encoded;

    }
}