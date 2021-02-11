<?php


namespace App\Service;


use App\DTO\ProductDTO;
use App\DTO\PropDTO;

class BuildDTO
{
    public function buildFromProps(array $data): \Generator
    {
        foreach ($data as $sections) {
            if (strpos($sections['code'], 'ep_id_') !== false) {
                foreach ($sections['isSmartBySection'] as $section) {
                    $dto = new PropDTO();
                    $dto->code = str_replace('ep_id_', '', $sections['code']);
                    $dto->sections = $section['sectId'];
                    $dto->name = $sections['name'];
                    $dto->sortBySectionCard = $sections['sortBySection'][$section['sectId']]['card'] ?? 500;
                    $dto->sortBySectionFilter = $sections['sortBySection'][$section['sectId']]['filter'] ?? 500;
                    $dto->isSmartBySectionIsSmart = $sections['isSmartBySection'][$section['sectId']]['isSmart'] ?? false;
                    $dto->isVisibleBySection = $sections['isVisibleBySection'][$section['sectId']]['isVisible'];
                    $dto->groupingBySection = $sections['groupingBySection'][$section['sectId']]['grouping'] ?? false;
                    $dto->isMulti = $sections['isMulti'];
                    $dto->t = $this->revertTfropProps($sections['t']);
                    yield $dto;
                }
            }
        }
    }

    public function buildFromProducts(array $data): \Generator
    {
        foreach ($data as $sections) {

                foreach ($sections['isSmartBySection'] as $section) {
                    $dto = new ProductDTO();
                    $dto->sectionId = 1;
                    $dto->xmlId = 1;
                    $dto->newProps = 1;
                    $dto->value = 1;
                    yield $dto;
                }
        }
    }




    private function revertTfropProps(int $t): string
    {
        return ($t == 0) ? 'integer' : 'string';
    }
}












//        foreach ($data as $fields) {
//            $dto = new PropDTO();
//            $dto->code = str_replace('ep_id_', '', $fields['code']);
//            $dto->sections = $fields['sections'];
//            $dto->name = $fields['name'];
//            $dto->sortBySectionCard = $fields['sortBySection'];
//            $dto->sortBySectionFilter = $fields['sortBySection'];
//            $dto->isSmartBySectionIsSmart = $fields['isSmartBySection'];
//            $dto->isVisibleBySection = $fields['isVisibleBySection'];
//            $dto->groupingBySection =  $fields['groupingBySection'] ?? null;
//            $dto->isMulti = $fields['isMulti'];
//            $dto->t = $fields['t'];
//            yield $dto;
//        }