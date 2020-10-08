<?php
declare(strict_types=1);

namespace App\Storage;


interface StorageInterface
{
    /**
     * @param string $unitType Hero or Opponent
     * @param string $unitName Like Hero or Wild Beast
     * @return array<string, mixed>
     */
    public function getPropertiesRangeForUnit(string $unitType, string $unitName): array;
}
