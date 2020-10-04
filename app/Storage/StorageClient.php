<?php
declare(strict_types=1);

namespace App\Storage;

final class StorageClient
{
    /**
     * @var StorageInterface $storage
     */
    private $storage;

    public function __construct(StorageInterface $storageType)
    {
        $this->storage = $storageType;
    }

    /**
     * @param string $unitType
     * @param string $unitName
     * @return array<string, mixed>
     */
    public function getPropertiesRangeForUnit(string $unitType, string $unitName): array
    {
        return $this->storage->getPropertiesRangeForUnit($unitType, $unitName);
    }
}
