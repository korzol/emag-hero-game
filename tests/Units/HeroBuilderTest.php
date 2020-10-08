<?php
declare(strict_types=1);

namespace tests\Units;

use PHPUnit\Framework\TestCase;
use App\Units\Heroes\Hero;
use App\Units\HeroBuilder;

final class HeroBuilderTest extends TestCase
{
    public function testBuilder(): void
    {
        $stats = [
            'name' => 'Hero',
            'health' => [80, 100],
            'strength' => [70, 80],
            'defence' => [45, 55],
            'speed' => [40, 50],
            'luck' => [10, 30],
            'rapidStrike' => 10,
            'magicShield' => 20,
        ];

        $heroBuilder = new HeroBuilder($stats);
        $hero = $heroBuilder->build();

        $this->assertInstanceOf(Hero::class, $hero);
    }
}
