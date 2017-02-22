<?php

namespace Linkfloyd\Bundle\CoreBundle\Controller;

class UserController extends BaseController
{
    public function profileAction($username)
    {
        if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            $this->addFlash('danger', $this->get('translator')->trans('unauthenticated'));

            return $this->redirectToRoute('fos_user_security_login');
        }
    }
}
