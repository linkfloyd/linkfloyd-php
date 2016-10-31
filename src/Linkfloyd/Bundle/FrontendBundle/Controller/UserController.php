<?php

namespace Linkfloyd\Bundle\FrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class UserController extends Controller
{
    public function loginAction()
    {
        return $this->render('FrontendBundle:User:login.html.twig', array(
            // ...
        ));
    }

    public function registerAction(Request $request)
    {
        $userService = $this->get('linkfloyd.user_bundle.user_manager');
        return $this->render('FrontendBundle:User:register.html.twig', array(
            // ...
        ));
    }

    public function logoutAction()
    {
        return $this->render('FrontendBundle:User:logout.html.twig', array(
            // ...
        ));
    }
}
