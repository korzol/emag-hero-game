<?php

namespace App\Battle;

use App\Units\BaseUnit;
use App\Units\BaseUnitInterface;
use App\Units\Heroes\Hero;
use PHPUnit\Framework\TestCase;

class DispositionTest extends TestCase
{

    /**
     * @dataProvider baseUnitHasHigherSpeedData
     * @param array<BaseUnitInterface> $units
     */
    public function testBaseUnitFirstAttackerBySpeed(array $units): void
    {
        $disposition = new Disposition($units['hero'], $units['baseUnit']);

        $positions = $disposition->getPositions();

        $this->assertInstanceOf('App\Units\BaseUnit', $positions['attacker']->getUnitObject());
    }

    /**
     * @dataProvider baseUnitHasHigherLuckData
     * @param array<BaseUnitInterface> $units
     */
    public function testBaseUnitFirstAttackerByLuck(array $units): void
    {
        $disposition = new Disposition($units['hero'], $units['baseUnit']);

        $positions = $disposition->getPositions();

        $this->assertInstanceOf('App\Units\BaseUnit', $positions['attacker']->getUnitObject());
    }

    /**
     * @dataProvider heroUnitHasHigherSpeedData
     * @param array<BaseUnitInterface> $units
     */
    public function testHeroUnitFirstAttackerBySpeed(array $units): void
    {
        $disposition = new Disposition($units['hero'], $units['baseUnit']);

        $positions = $disposition->getPositions();

        $this->assertInstanceOf('App\Units\Heroes\Hero', $positions['attacker']->getUnitObject());
    }

    /**
     * @dataProvider heroUnitHasHigherLuckData
     * @param array<BaseUnitInterface> $units
     */
    public function testHeroUnitFirstAttackerByLuck(array $units): void
    {
        $disposition = new Disposition($units['hero'], $units['baseUnit']);

        $positions = $disposition->getPositions();

        $this->assertInstanceOf('App\Units\Heroes\Hero', $positions['attacker']->getUnitObject());
    }

    /**
     * @dataProvider heroUnitHasHigherLuckData
     * @param array<BaseUnitInterface> $units
     */
    public function testInversePositions(array $units): void
    {
        $disposition = new Disposition($units['hero'], $units['baseUnit']);

        $initialPositions = $disposition->getPositions();

        $invertedPositions = $disposition->inversePositions();

        $this->assertInstanceOf('App\Units\BaseUnit', $invertedPositions['attacker']->getUnitObject());
    }

    public function baseUnitHasHigherSpeedData(): array
    {
        return [
            [
                [
                    'baseUnit' => new BaseUnit(
                        60,
                        60,
                        40,
                        50,
                        25,
                        'Wild Beast'
                    ),
                    'hero' => new Hero(
                        75,
                        79,
                        65,
                        40,
                        15,
                        10,
                        10,
                        'Orderus'
                    ),
                ],
            ],
        ];
    }

    public function baseUnitHasHigherLuckData(): array
    {
        return [
            [
                [
                    'baseUnit' => new BaseUnit(
                        60,
                        60,
                        40,
                        40,
                        25,
                        'Wild Beast'
                    ),
                    'hero' => new Hero(
                        75,
                        79,
                        65,
                        40,
                        15,
                        10,
                        10,
                        'Orderus'
                    ),
                ],
            ],
        ];
    }

    public function heroUnitHasHigherSpeedData(): array
    {
        return [
            [
                [
                    'baseUnit' => new BaseUnit(
                        60,
                        60,
                        40,
                        40,
                        25,
                        'Wild Beast'
                    ),
                    'hero' => new Hero(
                        75,
                        79,
                        65,
                        50,
                        15,
                        10,
                        10,
                        'Orderus'
                    ),
                ],
            ],
        ];
    }

    public function heroUnitHasHigherLuckData(): array
    {
        return [
            [
                [
                    'baseUnit' => new BaseUnit(
                        60,
                        60,
                        40,
                        40,
                        25,
                        'Wild Beast'
                    ),
                    'hero' => new Hero(
                        75,
                        79,
                        65,
                        40,
                        30,
                        10,
                        10,
                        'Orderus'
                    ),
                ],
            ],
        ];
    }
}
