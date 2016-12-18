<?php

namespace Linkfloyd\Bundle\CoreBundle\Request\Traits;

use Symfony\Bundle\FrameworkBundle\Routing\Router;
use Symfony\Component\HttpFoundation\Request;

trait Referer
{
    private function getRefererParams(Request $request)
    {
        $route = 'homepage';
        $parameters = [];
        $referer = $request->headers->get('referer');

        $baseUrl = $request->getHost();
        if (!$baseUrl || !$baseUrl) {
            return;
        }

        $lastPath = substr($referer, strpos($referer, $baseUrl) + strlen($baseUrl));
        if (!$lastPath) {
            return;
        }
        /*
         * "/soru-cevap?user=admin&page=2"
         *
         * route match etmek için, soru işaretinden öncesini almak gerekiyor.
         * native bi fonksiyon varsa explode yerine kullanabiliriz :)
         */
        $exploded = explode('?', $lastPath);
        $basePath = $exploded[0];
        if (!empty($exploded[1])) {
            $parameters = \GuzzleHttp\Psr7\parse_query($exploded[1]);
        }

        /** @var Router $router */
        $router = $this->get('router');
        $match = $router->getMatcher()->match($basePath);
        if (!empty($match['_route'])) {
            $route = $match['_route'];
            unset($match['_controller']);
            unset($match['_route']);
            $parameters = array_merge($parameters, $match);
        }

        return [
            'route' => $route,
            'parameters' => $parameters,
        ];
    }

    private function redirectPreviousUrl(Request $request)
    {
        $params = $this->getRefererParams($request);
        if (!$params) {
            $params = [
                'route' => 'homepage',
                'parameters' => [],
            ];
        }

        return $this->redirectToRoute($params['route'], $params['parameters']);
    }
}
