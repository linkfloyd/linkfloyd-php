<?php
/**
 * @author Guven Atbakan <guven@atbakan.com>
 */

namespace Linkfloyd\Bundle\CoreBundle\Service;

use GuzzleHttp\Client;

/**
 * Siteye eklenen URL ile ilgili işlemler burada yapılır.
 * Örneğin, verilen URL için title, description, thumbnail gibi detayların alınması.
 *
 * Class UrlService
 * @package Linkfloyd\Bundle\CoreBundle\Service
 */
class UrlService
{
    /**
     * @var Client
     */
    private $client;
    /**
     * @var string
     */
    private $iframelyApiKey;

    public function __construct(Client $client, string $iframelyApiKey)
    {
        $this->client = $client;
        $this->iframelyApiKey = $iframelyApiKey;
    }

    public function getUrlDetails(string $url)
    {
        $oembed = $this->getOembed($url);

        if (!$oembed) {
            return [
                'url' => $url,
            ];
        }

        return [
            'url' => $oembed['url'],
            'title' => @$oembed['title'],
            'description' => @$oembed['description'],
            'thumbnail_url' => @$oembed['thumbnail_url'],
        ];
    }

    private function getOembed(string $url)
    {
        try {
            $url = "http://open.iframe.ly/api/oembed?url=$url&api_key={$this->iframelyApiKey}";
            $response = $this->client->get($url);

            if (200 == $response->getStatusCode()) {
                return json_decode($response->getBody()->getContents(), true);
            }
        } catch (\Exception $e) {
        }
        return;
    }
}
