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
     * @var FieldsBuilder
     */
    private FieldsBuilder $fieldsBuilder;

    /**
     * DataBuilder constructor.
     * @param HttpClientInterface $httpClient
     * @param FieldsBuilder $fieldsBuilder
     */
    public function __construct(HttpClientInterface $httpClient, FieldsBuilder $fieldsBuilder)
    {
        $this->httpClient = $httpClient;
        $this->fieldsBuilder = $fieldsBuilder;
    }

    public function getPropertiesData()
    {
        foreach ($this->fieldsBuilder->getArrayFields($this->httpClient->request('GET', 'http://136.243.45.232:8073/v1/catalog/props_all?limit=5')->getContent()) as $res){
            yield $res;
        }

    }
}