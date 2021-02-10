<?php


namespace App\Service;


use App\DTO\PropDTO;

class BuildDTO
{
    public function build(array $data): \Generator
    {

        foreach ($data as $fields) {
            $dto = new PropDTO();
            $dto->code = str_replace('ep_id_', '', $fields['code']);
            $dto->sections = $fields['sections'];
            $dto->name = $fields['name'];
            $dto->sortBySectionCard = $fields['sortBySection'];
            $dto->sortBySectionFilter = $fields['sortBySection'];
            $dto->isSmartBySectionIsSmart = $fields['isSmartBySection'];
            $dto->isVisibleBySection = $fields['isVisibleBySection'];
            $dto->groupingBySection =  $fields['groupingBySection'] ?? null;
            $dto->isMulti = $fields['isMulti'];
            $dto->t = $fields['t'];
            yield $dto;
        }
    }
}