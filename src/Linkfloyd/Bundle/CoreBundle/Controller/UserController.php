<?php

namespace Linkfloyd\Bundle\CoreBundle\Controller;

use Linkfloyd\Bundle\UserBundle\Form\LoginForm;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class UserController extends Controller
{
    public function loginAction(Request $request)
    {
        if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            $this->redirect($this->generateUrl('homepage'));
        }

        $form = $this->createForm(LoginForm::class);
        if ($request->isMethod('post')) {
            $form->handleRequest($request);
        }
        if ($form->isSubmitted() && $form->isValid()) {
        }

        return $this->render('LinkfloydCoreBundle:User:login.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    public function registerAction(Request $request)
    {
        $userService = $this->get('linkfloyd.user_bundle.user_manager');
        return $this->render('LinkfloydCoreBundle:User:register.html.twig', array(
            // ...
        ));
    }

    public function logoutAction()
    {
        return $this->render('LinkfloydCoreBundle:User:logout.html.twig', array(
            // ...
        ));
    }
}
