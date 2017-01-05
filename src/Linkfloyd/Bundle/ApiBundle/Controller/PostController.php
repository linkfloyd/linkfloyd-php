<?php
/**
 * @author Guven Atbakan <guven@atbakan.com>
 */

namespace Linkfloyd\Bundle\ApiBundle\Controller;

use Doctrine\Common\Annotations\Annotation\Required;
use FOS\RestBundle\Controller\Annotations\QueryParam;
use FOS\RestBundle\Controller\Annotations\RequestParam;
use FOS\RestBundle\Controller\Annotations\View;
use Linkfloyd\Bundle\CoreBundle\Form\InsertPostForm;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class PostController.
 */
class PostController extends ApiController
{
    /**
     * @Route("/posts/public")
     * @Method("GET")
     * @ApiDoc(
     *     section="Post",
     *     description="Lists posts with pagination",
     * )
     * @QueryParam(
     *     name="page",
     *     nullable=true,
     *     default="1",
     *     requirements=@Assert\GreaterThan(1)
     * )
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getPostsAction(Request $request)
    {
        $page = $request->query->getInt('page', 1);

        $postService = $this->get('linkfloyd.frontend.service.post_service');
        $posts = $postService->getPosts($page, $this->getParameter('api_listing_post_limit'));

        $data = [];
        foreach ($posts->getCurrentPageResults() as $post) {
            $data[] = $post;
        }

        $view = $this->view([
            'meta' => [
                'current_page' => $posts->getCurrentPage(),
                'last_page' => $posts->getNbPages(),
                'total_record' => $posts->count(),
            ],
            'data' => $data,
        ]);

        return $this->handleView($view);
    }

    /**
     * @Route("/posts")
     * @Method("POST")
     * @Security("has_role('ROLE_USER')")
     * @ApiDoc(
     *     section="Post",
     *     description="Insert new post with given parameters",
     * )
     * @RequestParam(
     *     name="url",
     *     nullable=false,
     *     description="",
     *     requirements=@Assert\Url()
     * )
     * @RequestParam(
     *     name="title",
     *     nullable=false,
     *     description="**not original url title**. custom title from user",
     *     requirements={@Required(),@Assert\NotBlank()}
     *     )
     *
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Exception
     */
    public function postPostAction(Request $request)
    {
        /*$form = $this->createForm(InsertPostForm::class);
        $form->handleRequest($request);
        if (!$form->isValid()) {
            throw new \Exception('throw 400 error here');
        }*/
        $url = $request->request->get('url');
        $title = $request->request->get('title');

        $urlService = $this->get('linkfloyd.frontend.service.url_service');
        $urlDetails = $urlService->getUrlDetails($url);
        if (!$urlDetails) {
            //throw 400;
        }
        $createPostService = $this->get('linkfloyd.frontend.service.post.create_post_service');
        $post = $createPostService->insertPost($urlDetails, $this->getUser(), $title, $description = null);

        $view = $this->view([
            'data' => $post,
        ], 201);

        return $this->handleView($view);
    }
}
