<?php

namespace Linkfloyd\Bundle\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BaseController extends Controller
{
    protected function redirectIfNotAuthenticated()
    {
        if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            $this->addFlash('danger', $this->get('translator')->trans('unauthenticated'));

            return $this->redirectToRoute('fos_user_security_login');
        }
    }
}
