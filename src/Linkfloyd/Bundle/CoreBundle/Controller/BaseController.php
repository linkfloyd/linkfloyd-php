<?php

namespace Linkfloyd\Bundle\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class BaseController extends Controller
{
    private $parameters = [];

    public function setTitle($value)
    {
        $this->parameters['siteTitle'] = $value;
    }

    public function render($view, array $parameters = array(), Response $response = null)
    {
        $parameters = array_merge($this->parameters, $parameters);

        return parent::render($view, $parameters, $response);
    }
}
