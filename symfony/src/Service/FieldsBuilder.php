<?php


namespace App\Service;


use App\DTO\ProductDTO;

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
        foreach ($this->buildDTO->buildFromProducts($this->deserializeProduct($response)) as $line) {
            $string = '';
            $string .= $line->sectionId . ';' . $line->xmlId . ';' . $line->idProp . ';' . $line->newPropsValue . "\r\n";
            yield $string;
        }

    }

    public function buildLineFromArray($response)
    {
        foreach ($this->deserializeProduct($response) as $props) {
            if (!empty($props['newProps'])) {


                foreach ($props['newProps'] as $sectionValue) {
//                dd($sectionValue);

                    $string = '';
                    if (strpos($sectionValue['code'], 'ep_id_') !== false) {
                        $string .= $props['sectionId'] . ';';
                        $string .= $props['xmlId'] . ';';
                        $string .= str_replace('ep_id_', '', $sectionValue['code']) . ';';
                        if (isset($sectionValue['values'][0]['value'])) {
                            $str = '';
                            foreach ($sectionValue['values'] as $val) {
                                $str .= $val['value'] . '/';
                            }
                            $string .= rtrim($str, '/');
                        } else {
                            $string .= $sectionValue['value'] ?? '';
                        }
                        $string .= "\r\n";
//                        dd($string);
                        yield $string;
                    }
                }
            }
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