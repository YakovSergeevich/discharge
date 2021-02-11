<?php


namespace App\Service;


class FieldsBuilder
{
    /**
     * @var BuildDTO
     */
    private BuildDTO $buildDTO;

    /**
     * FieldsBuilder constructor.
     * @param BuildDTO $buildDTO
     */
    public function __construct(BuildDTO $buildDTO)
    {
        $this->buildDTO = $buildDTO;
    }

    public function getArrayFieldsProperties($response)
    {

        foreach ($this->buildDTO->buildFromProps($this->deserializeProps($response)) as $line) {
            $string = '';
//            foreach ($line->sections as $section){}
                $string .= $line->code .
                    ';' . $line->sections .
                    ';' . $line->name .
                    ';' . $line->sortBySectionCard .
                    ';' . $line->sortBySectionFilter .
                    ';' . $line->isSmartBySectionIsSmart .
                    ';' . $line->isVisibleBySection .
                    ';' . $line->groupingBySection .
                    ';' . $line->isMulti .
                    ';' . $line->t . "\r\n";
                yield $string;
        }
    }

    public function getArrayFieldsProducts($response)
    {
        foreach ($this->buildDTO->buildFromProducts($this->deserializeProduct($response)) as $line){
            $string = '';
            $string .= $line->sectionId . ';' . $line->xmlId . ';' . $line->idProp . ';' . $line->newPropsValue . "\r\n";
            yield $string;
        }

    }

    public function getArrayFieldsProductsNew($response)
    {
        foreach ($this->buildDTO->buildFromProductsNew($this->deserializeProduct($response)) as $line){
            $string = '';
            $string .= $line->sectionId . ';' . $line->xmlId . ';' . $line->idProp . ';' . $line->newPropsValue . "\r\n";
            yield $string;
        }

    }



    public function getArrayFieldsIds($response)
    {
        return json_decode($response, true)['data'];

    }
    private function deserializeProps($response)
    {
        return json_decode($response, true)['data']['props'];
    }

    private function deserializeProduct($response)
    {
        return json_decode($response, true)['data'];
    }

}





//                $array = [];
//                $array[] = $line->code;
//                $array[] = $section;
//                $array[] = $line->name;
//                $array[] = $line->sortBySectionCard[$section]['card'];
//                $array[] = $line->sortBySectionFilter[$section]['filter'];
//                $array[] = $line->isSmartBySectionIsSmart[$section]['isSmart'];
//                $array[] = $line->isVisibleBySection[$section]['isVisible'];
//                $array[] = ($line->groupingBySection[$section]['grouping'] === null) ? false : $line->groupingBySection[$section]['grouping'];
//                $array[] = $line->isMulti;
//                $array[] = $line->t;