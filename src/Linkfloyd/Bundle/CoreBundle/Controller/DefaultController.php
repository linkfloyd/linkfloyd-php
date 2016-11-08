<?php

namespace Linkfloyd\Bundle\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $postService = $this->get('linkfloyd.frontend.service.post_service');
        dump($postService->getPosts(1, 10));
        return $this->render('LinkfloydCoreBundle:Default:index.html.twig');
    }
}
