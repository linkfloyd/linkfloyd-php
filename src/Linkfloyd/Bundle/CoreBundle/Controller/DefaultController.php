<?php

namespace Linkfloyd\Bundle\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction(Request $request)
    {
        $page = $request->query->getInt('page', 1);
        $postService = $this->get('linkfloyd.frontend.service.post_service');
        dump($postService->getPosts($page, $limit = 10));
        return $this->render('LinkfloydCoreBundle:Default:index.html.twig');
    }
}
