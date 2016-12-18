<?php

namespace Linkfloyd\Bundle\CoreBundle\Controller;

use Symfony\Component\HttpFoundation\Request;

class DefaultController extends BaseController
{
    public function indexAction(Request $request)
    {
        $page = $request->query->getInt('page', 1);
        $postService = $this->get('linkfloyd.frontend.service.post_service');

        $posts = $postService->getPosts($page, $this->getParameter('homepage_listing_post_limit'));

        return $this->render('LinkfloydCoreBundle:Default:index.html.twig', [
            'posts' => $posts,
        ]);
    }
}
