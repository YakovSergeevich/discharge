<?php


namespace App\Service;


class FileBuilder
{
    /**
     * @var DataBuilder
     */
    private DataBuilder $dataBuilder;
    private string $uploadPath;

    /**
     * FileBuilder constructor.
     * @param string $uploadPath
     * @param DataBuilder $dataBuilder
     */
    public function __construct(string $uploadPath, DataBuilder $dataBuilder)
    {
        $this->dataBuilder = $dataBuilder;
        $this->uploadPath = $uploadPath;
    }

    public function createFileCsvFromProperties()
    {
        $handle = fopen($this->uploadPath,'rb');
        $data = $this->dataBuilder->getPropertiesData();
       dd(json_decode($data, true));
    }
}