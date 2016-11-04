<?php

namespace Linkfloyd\Bundle\ApiBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class DefaultController extends FOSRestController
{
    /**
     * @ApiDoc()
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getDemosAction()
    {
        $data = array("hello" => "world");
        $view = $this->view($data);
        return $this->handleView($view);
    }
    /**
     * @ApiDoc()
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getSecureDemosAction()
    {
        if (false === $this->get('security.firewall.context')->getContext()->isGranted('IS_AUTHENTICATED_FULLY')) {
            throw new AccessDeniedException();
        }
        $user = $this->get('security.context')->getToken()->getUser();
        $data = array("this-is" => "secured");
        $view = $this->view($data);
        return $this->handleView($view);
    }
}
