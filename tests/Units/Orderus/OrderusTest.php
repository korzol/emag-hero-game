<?php
declare(strict_types=1);

namespace tests\Units\Orderus;

use App\Units\Orderus\Orderus;
use PHPUnit\Framework\TestCase;
use OutOfRangeException;


final class OrderusTest extends TestCase
{
    /**
     * @test
     * @dataProvider newOrderusData
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
        $orderus = new Orderus(
            $health,
            $strength,
            $defence,
            $speed,
            $luck
        );

        $this->assertTrue($health === $orderus->getHealth());
        $this->assertTrue($strength === $orderus->getStrength());
        $this->assertTrue($defence === $orderus->getDefence());
        $this->assertTrue($speed === $orderus->getSpeed());
        $this->assertTrue($luck === $orderus->getLuck());

    }

    public function testWrongHealth()
    {
        $this->expectException(OutOfRangeException::class);

        $orderus = new Orderus(
            60,
            79,
            55,
            40,
            10
        );
    }

    public function testWrongStrength()
    {
        $this->expectException(OutOfRangeException::class);

        $orderus = new Orderus(
            100,
            50,
            55,
            40,
            10
        );
    }

    public function testWrongDefence()
    {
        $this->expectException(OutOfRangeException::class);

        $orderus = new Orderus(
            100,
            79,
            100,
            40,
            10
        );
    }

    public function testWrongSpeed()
    {
        $this->expectException(OutOfRangeException::class);

        $orderus = new Orderus(
            100,
            79,
            55,
            100,
            10
        );
    }

    public function testWrongLuck()
    {
        $this->expectException(OutOfRangeException::class);

        $orderus = new Orderus(
            100,
            79,
            55,
            40,
            100
        );
    }

    public function newOrderusData()
    {
        return [
            [
                75, // health
                79, // strength
                55, // defence
                40, // speed
                10, // luck
            ],
            [
                99, // health
                70, // strength
                45, // defence
                50, // speed
                30, // luck

            ],
        ];
    }
}
