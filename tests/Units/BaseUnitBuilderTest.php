<?php
declare(strict_types=1);

namespace tests\Units;

use PHPUnit\Framework\TestCase;
use App\Units\BaseUnit;
use App\Units\BaseUnitBuilder;

final class BaseUnitBuilderTest extends TestCase
{
    public function testBuilder(): void
    {
        $stats = [
            'name' => 'Wild Beast',
            'health' => [60, 90],
            'strength' => [60, 90],
            'defence' => [40, 60],
            'speed' => [40, 60],
            'luck' => [25, 40],
        ];

        $unitBuilder = new BaseUnitBuilder($stats);
        $unit = $unitBuilder->build();

        $this->assertInstanceOf(BaseUnit::class, $unit);
    }
}
