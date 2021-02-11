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

    public function getArrayFields($response)
    {

        foreach ($this->buildDTO->build($this->deserialize($response)) as $line) {
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
//                    dd($string);
                yield $string;
        }
    }
    private function deserialize($response)
    {
        return json_decode($response, true)['data']['props'];
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