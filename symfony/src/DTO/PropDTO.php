<?php


namespace App\DTO;


class PropDTO
{
    public string $code;
    public array $sections;
    public string $name;
    public array $sortBySectionCard;
    public array $sortBySectionFilter;
    public array $isSmartBySectionIsSmart;
    public array $isVisibleBySection;
    public ?array $groupingBySection;
    public int $isMulti;
    public string $t;
}