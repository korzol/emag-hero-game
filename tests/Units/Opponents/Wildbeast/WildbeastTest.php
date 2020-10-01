<?php
declare(strict_types=1);

namespace tests\Units\Opponents\Wildbeast;

use PHPUnit\Framework\TestCase;
use App\Units\Opponents\Wildbeast\Wildbeast;
//use App\Units\Opponents\WildbeastBuilder;
use OutOfRangeException;

final class WildbeastTest extends TestCase
{
    /**
     * @test
     * @dataProvider newWildbeastData
     * @param int $health
     * @param int $strength
     * @param int $defence
     * @param int $speed
     * @param int $luck
     */
    public function new(
        int $health,
        int $strength,
        int $defence,
        int $speed,
        int $luck
    ): void
    {
        $wildBeast = new Wildbeast(
            $health,
            $strength,
            $defence,
            $speed,
            $luck
        );

        $this->assertTrue($health === $wildBeast->getHealth());
        $this->assertTrue($strength === $wildBeast->getStrength());
        $this->assertTrue($defence === $wildBeast->getDefence());
        $this->assertTrue($speed === $wildBeast->getSpeed());
        $this->assertTrue($luck === $wildBeast->getLuck());
    }

    public function newWildBeastData()
    {
        return [
            [
                60, // health
                60, // strength
                40, // defence
                40, // speed
                25, // luck
            ],
            [
                90, // health
                90, // strength
                60, // defence
                60, // speed
                40, // luck

            ],
        ];
    }
}
