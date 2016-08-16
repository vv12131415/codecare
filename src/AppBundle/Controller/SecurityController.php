<?php
/**
 * Created by PhpStorm.
 * User: ubuntu
 * Date: 7/10/16
 * Time: 5:41 PM
 */

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;


class SecurityController extends Controller
{

    public function loginAction(Request $request)
    {
        $authenticationUtils = $this->get('security.authentication_utils');

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render(
            'AppBundle:Security:login.html.twig',
            [
                // last username entered by the user
                'last_username' => $lastUsername,
                'error'         => $error,
            ]
        );
    }


    public function logoutAction()
    {
    }
}