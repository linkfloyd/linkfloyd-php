<?php
/**
 * @author Guven Atbakan <guven@atbakan.com>
 */

namespace Linkfloyd\Bundle\ApiBundle\Controller;

use Doctrine\Common\Annotations\Annotation\Required;
use FOS\RestBundle\Controller\Annotations\Prefix;
use FOS\RestBundle\Controller\Annotations\RequestParam;
use FOS\RestBundle\Controller\Annotations\View;
use FOS\RestBundle\Request\ParamFetcher;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class PostController
 * @package Linkfloyd\Bundle\ApiBundle\Controller
 */
class PostController extends ApiController
{
    /**
     * @Route("/posts/public")
     * @Method("GET")
     * @ApiDoc(
     *     section="Post",
     *     description="Lists posts with pagination",
     *     filters={
     *          {"name"="a-filter", "dataType"="integer"},
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
     * @RequestParam(
     *     name="description",
     *     nullable=true,
     *     description="",
     * )
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function postPostAction(Request $request)
    {
        $data = $this->getUser();
        $view = $this->view($data);
        return $this->handleView($view);
    }
}
