<?php
declare(strict_types=1);

namespace App\Storage;

use UnexpectedValueException;
use Symfony\Component\Yaml\Yaml;

class FileStorage implements StorageInterface
{
    private const UNITS_CONFIGURATION_FILE = 'UnitsConfiguration.yml';

    /**
     * @param string $unitType Hero or Opponent
     * @param string $unitName Like Hero or Wild Beast
     * @return array<string, mixed>
     */
    public function getPropertiesRangeForUnit(string $unitType, string $unitName): array
    {
        $units = Yaml::parseFile(self::UNITS_CONFIGURATION_FILE);

        foreach ($units[$unitType] as $unit)
        {
            if ($unit["name"] == $unitName)
            {
                return $unit;
            }
        }

        throw new UnexpectedValueException("Could not find {$unitName} within {$unitType}");
    }
}
