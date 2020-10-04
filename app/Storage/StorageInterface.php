<?php
declare(strict_types=1);

namespace App\Storage;


interface StorageInterface
{
    /**
     * @param string $unitType Hero or Opponent
     * @param string $unitName Like Orderus or Wild Beast
     * @return array
     */
    public function getPropertiesRangeForUnit(string $unitType, string $unitName): array;
}
