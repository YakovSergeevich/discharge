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

//        $dto = $this->buildDTO->build($this->deserialize($response));
//        dd($dto);
        foreach ($this->buildDTO->build($this->deserialize($response)) as $line) {

            foreach ($line->sections as $section){
                $array = [];
                $array[] = $line->code;
                $array[] = $section;
                $array[] = $line->name;
                $array[] = $line->sortBySectionCard[$section]['card'];
                $array[] = $line->sortBySectionFilter[$section]['filter'];
                $array[] = $line->isSmartBySectionIsSmart[$section]['isSmart'];
                $array[] = $line->isVisibleBySection[$section]['isVisible'];
                $array[] = ($line->groupingBySection[$section]['grouping'] === null) ? false : $line->groupingBySection[$section]['grouping'];
                $array[] = $line->isMulti;
                $array[] = $line->t;
                yield $array;
            }

        }

    }

    private function deserialize($response)
    {
        return json_decode($response, true)['data']['props'];
    }

}