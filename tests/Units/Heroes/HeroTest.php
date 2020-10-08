<?php
declare(strict_types=1);

namespace tests\Units\Heroes;

use App\Units\Heroes\Hero;
use LengthException;
use PHPUnit\Framework\TestCase;
use OutOfRangeException;
use UnexpectedValueException;


final class HeroTest extends TestCase
{
    /**
     * @test
     * @dataProvider newHeroData
     * @param int $health
     * @param int $strength
     * @param int $defence
     * @param int $speed
     * @param int $luck
     * @param int $rapidStrike
     * @param int $magicShield
     * @param string $unitName
     */
    public function new(
        int $health,
        int $strength,
        int $defence,
        int $speed,
        int $luck,
        int $rapidStrike,
        int $magicShield,
        string $unitName
    ): void
    {
        $hero = new Hero(
            $health,
            $strength,
            $defence,
            $speed,
            $luck,
            $rapidStrike,
            $magicShield,
            $unitName
        );

        $this->assertTrue($health === $hero->getHealth());
        $this->assertTrue($strength === $hero->getStrength());
        $this->assertTrue($defence === $hero->getDefence());
        $this->assertTrue($speed === $hero->getSpeed());
        $this->assertTrue($luck === $hero->getLuck());
        $this->assertTrue($magicShield === $hero->getMagicShield());
        $this->assertTrue($rapidStrike === $hero->getRapidStrike());
        $this->assertTrue($unitName === $hero->getUnitName());
    }

    public function testWrongHealth(): void
    {
        $this->expectException(OutOfRangeException::class);

        $hero = new Hero(
            160,
            79,
            55,
            40,
            10,
            10,
            20,
            'Orderus'
        );
    }

    public function testWrongStrength(): void
    {
        $this->expectException(OutOfRangeException::class);

        $hero = new Hero(
            100,
            150,
            55,
            40,
            10,
            10,
            20,
            'Orderus'
        );
    }

    public function testWrongDefence(): void
    {
        $this->expectException(OutOfRangeException::class);

        $hero = new Hero(
            100,
            79,
            110,
            40,
            10,
            10,
            20,
            'Orderus'
        );
    }

    public function testWrongSpeed(): void
    {
        $this->expectException(OutOfRangeException::class);

        $hero = new Hero(
            100,
            79,
            55,
            110,
            10,
            10,
            20,
            'Orderus'
        );
    }

    public function testWrongLuck(): void
    {
        $this->expectException(OutOfRangeException::class);

        $hero = new Hero(
            100,
            79,
            55,
            40,
            110,
            10,
            20,
            'Orderus'
        );
    }

    public function testWrongRapidStrike(): void
    {
        $this->expectException(UnexpectedValueException::class);

        $hero = new Hero(
            100,
            79,
            55,
            40,
            30,
            101,
            20,
            'Orderus'
        );
    }

    public function testWrongMagicShield(): void
    {
        $this->expectException(UnexpectedValueException::class);

        $hero = new Hero(
            100,
            79,
            55,
            40,
            30,
            10,
            101,
            'Orderus'
        );
    }

    public function testEmptyName(): void
    {
        $this->expectException(LengthException::class);

        $hero = new Hero(
            100,
            79,
            55,
            40,
            30,
            10,
            20,
            ''
        );
    }

    public function newHeroData(): array
    {
        return [
            [
                75, // health
                79, // strength
                55, // defence
                40, // speed
                10, // luck
                10, // rapid strike
                20, // magic shield
                'Orderus'
            ],
            [
                99, // health
                70, // strength
                45, // defence
                50, // speed
                30, // luck
                10, // rapid strike
                20, // magic shield
                'Orderus2'
            ],
        ];
    }
}
