<?php
declare(strict_types=1);

namespace App\Storage;

final class StorageClient
{
    private $storage;

    public function __construct(StorageInterface $storageType)
    {
        $this->storage = $storageType;
    }

    public function getPropertiesRangeForUnit(string $unitType, string $unitName): array
    {
        return $this->storage->getPropertiesRangeForUnit($unitType, $unitName);
    }
}
