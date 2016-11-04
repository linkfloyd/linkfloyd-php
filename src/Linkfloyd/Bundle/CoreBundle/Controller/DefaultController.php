<?php

namespace Linkfloyd\Bundle\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('LinkfloydCoreBundle:Default:index.html.twig');
    }
}
