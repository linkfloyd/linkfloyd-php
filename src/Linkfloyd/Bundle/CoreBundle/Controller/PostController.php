<?php

namespace Linkfloyd\Bundle\CoreBundle\Controller;

use Linkfloyd\Bundle\CoreBundle\Form\InsertPostForm;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class PostController extends Controller
{
    public function indexAction()
    {
        return $this->render('LinkfloydCoreBundle:Post:index.html.twig', array(

        ));
    }

    public function insertPostAction(Request $request)
    {
        $form = $this->createForm(InsertPostForm::class);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $url = ($form->get('url')->getData());
            $title = $form->get('title')->getData();
            $description = $form->get('description')->getData();

            $urlService = $this->get('linkfloyd.frontend.service.url_service');
            $postService = $this->get('linkfloyd.frontend.service.post.create_post_service');
            $urlDetails = $urlService->getUrlDetails($url);
            $post = $postService->insertPost(
                $urlDetails?$urlDetails:['url'=>$url], $this->getUser(), $title, $description
            );
            if ($post) {
                $this->addFlash('success', $this->get('translator')->trans('post.message.success'));
                return $this->redirectToRoute('homepage', [
                    'post_id'=>$post->getId(),
                ]);
            }
        }

        return $this->render('LinkfloydCoreBundle:Post:insert_post.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}
