<?php


namespace App\Service;


use Symfony\Contracts\HttpClient\HttpClientInterface;

class DataBuilder
{
    /**
     * @var HttpClientInterface
     */
    private HttpClientInterface $httpClient;

    /**
     * DataBuilder constructor.
     * @param HttpClientInterface $httpClient
     */
    public function __construct(HttpClientInterface $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    public function getPropertiesData()
    {
        $data = $this->httpClient->request('GET', 'http://136.243.45.232:8073/v1/catalog/props_all?limit=1');
        return $data->getContent();
    }
}