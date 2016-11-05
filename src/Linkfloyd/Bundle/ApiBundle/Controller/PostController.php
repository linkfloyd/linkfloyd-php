<?php
/**
 * @author Guven Atbakan <guven@atbakan.com>
 */

namespace Linkfloyd\Bundle\ApiBundle\Controller;

use FOS\RestBundle\Controller\Annotations\View;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class PostController extends ApiController
{
    /**
     * @Route("/posts/public")
     * @Method("GET")
     * @ApiDoc(
     *     section="Post",
     *     description="Lists posts with pagination",
     *     filters={
     *      {"name"="a-filter", "dataType"="integer"},
     *     }
     * )
     * @View()
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getPostsAction()
    {
        $data = array("hello" => "world");
        $view = $this->view($data);
        return $this->handleView($view);
    }
    /**
     * @Route("/posts")
     * @Method("POST")
     * @ApiDoc(
     *     section="Post",
     *     description="Insert new post with given parameters",
     * )
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function postPostAction()
    {
        $data = array("hello" => "world");
        $view = $this->view($data);
        return $this->handleView($view);
    }
}
