<?php
declare(strict_types=1);

namespace tests\Units;

use LengthException;
use PHPUnit\Framework\TestCase;
use App\Units\BaseUnit;
use OutOfRangeException;

final class BaseUnitTest extends TestCase
{
    /**
     * @test
     * @dataProvider newBaseUnitData
     * @param int $health
     * @param int $strength
     * @param int $defence
     * @param int $speed
     * @param int $luck
     * @param string $unitName
     */
    public function new(
        int $health,
        int $strength,
        int $defence,
        int $speed,
        int $luck,
        string $unitName
    ): void
    {
        $unit = new BaseUnit(
            $health,
            $strength,
            $defence,
            $speed,
            $luck,
            $unitName
        );

        $this->assertTrue($health === $unit->getHealth());
        $this->assertTrue($strength === $unit->getStrength());
        $this->assertTrue($defence === $unit->getDefence());
        $this->assertTrue($speed === $unit->getSpeed());
        $this->assertTrue($luck === $unit->getLuck());
        $this->assertTrue($unitName === $unit->getUnitName());
    }

    public function testWrongHealth(): void
    {
        $this->expectException(OutOfRangeException::class);

        $unit = new BaseUnit(
            160,
            79,
            55,
            40,
            10,
            'Wild Beast'
        );
    }

    public function testWrongStrength(): void
    {
        $this->expectException(OutOfRangeException::class);

        $unit = new BaseUnit(
            100,
            150,
            55,
            40,
            10,
            'Wild Beast'
        );
    }

    public function testWrongDefence(): void
    {
        $this->expectException(OutOfRangeException::class);

        $unit = new BaseUnit(
            100,
            79,
            110,
            40,
            10,
            'Wild Beast'
        );
    }

    public function testWrongSpeed(): void
    {
        $this->expectException(OutOfRangeException::class);

        $unit = new BaseUnit(
            100,
            79,
            55,
            110,
            10,
            'Wild Beast'
        );
    }

    public function testWrongLuck(): void
    {
        $this->expectException(OutOfRangeException::class);

        $unit = new BaseUnit(
            100,
            79,
            55,
            40,
            110,
            'Wild Beast'
        );
    }

    public function testEmptyName(): void
    {
        $this->expectException(LengthException::class);

        $hero = new BaseUnit(
            100,
            79,
            55,
            40,
            30,
            ''
        );
    }

    public function newBaseUnitData(): array
    {
        return [
            [
                60, // health
                60, // strength
                40, // defence
                40, // speed
                25, // luck
                'Wild Beast', // unit name
            ],
            [
                90, // health
                90, // strength
                60, // defence
                60, // speed
                40, // luck
                'Unit', // unit name
            ],
        ];
    }
}
