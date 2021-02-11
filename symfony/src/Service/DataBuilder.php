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
        foreach ($this->fieldsBuilder->getArrayFieldsProperties($this->httpClient->request('GET', 'http://136.243.45.232:8073/v1/catalog/props_all?limit=1387')->getContent()) as $res) {
            yield $res;
        }
    }

    public function getProductsFullData()
    {
        foreach ($this->getProductsIds() as $key => $value) {
//            dd($key);
            foreach ($this->fieldsBuilder->getArrayFieldsProducts($this->httpClient->request('GET', 'http://136.243.45.232:8073/v1/catalog/products/2/0?ids[]=' . $key)->getContent()) as $res) {
                yield $res;
            }

        }
    }

    public function getProductsFullDataNew()
    {
        foreach ($this->getProductsIds() as $key => $value) {

            foreach ($this->fieldsBuilder->getArrayFieldsProductsNew($this->httpClient->request('GET', 'http://136.243.45.232:8073/v1/catalog/products/2/0?ids[]=' . $key)->getContent()) as $res) {
                yield $res;
            }

        }
    }

    public function getProductsIds()
    {
        return $this->fieldsBuilder->getArrayFieldsIds($this->httpClient->request('GET', 'http://136.243.45.232:8073/v1/catalog/products_multipurpose?action=existing_products')->getContent());


    }


}