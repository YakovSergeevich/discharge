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
        $handle = fopen($this->uploadPath . 'properties.csv', 'w+');
        $nameFields = 'id свойства;id раздела;Наименование свойства;Приоритетная сортировка;Приоритетная сортировка в фильтре;Отображать в фильтре(флаг);Отображать в карточке(флаг);Группировка;isMulti;t' ."\r\n";
        fwrite($handle,  $nameFields);
        foreach ($this->dataBuilder->getPropertiesData() as $fields) {
            fwrite($handle,  $fields);
        }
        fclose($handle);
    }
}





//           fwrite($handle, implode(';',mb_convert_encoding($fields, 'cp1251' ) ) . "\r\n");