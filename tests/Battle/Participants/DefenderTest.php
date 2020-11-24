<?php
declare(strict_types=1);

namespace tests\Battle\Participants;


use App\Battle\Participants\Defender;
use App\Units\BaseUnit;
use App\Units\BaseUnitInterface;
use App\Units\Heroes\Hero;
use \PHPUnit\Framework\TestCase;

class DefenderTest extends TestCase
{
    /**
     * @dataProvider baseUnitObject
     * @param BaseUnitInterface $baseUnit
     */
    public function testBaseUnitCalculateHealth(BaseUnitInterface $baseUnit): void
    {
        $damage = 10;
        $expectedHealth = $baseUnit->getHealth() - $damage;

        $defender = new Defender($baseUnit);
        $defender->setDamage($damage);

        $this->assertTrue($defender->calculateHealth());

        $this->assertEquals(
            $defender->getDamage(),
            $damage
        );

        $this->assertEquals(
            $baseUnit->getHealth(),
            $expectedHealth
        );

    }

    /**
     * @dataProvider heroUnitObject
     * @param BaseUnitInterface $heroUnit
     */
    public function testHeroUnitCalculateHealth(BaseUnitInterface $heroUnit): void
    {
        $damage = 10;
        $expectedHealth = $heroUnit->getHealth() - $damage;

        $defender = new Defender($heroUnit);
        $defender->setDamage($damage);

        $this->assertTrue($defender->calculateHealth());

        $this->assertEquals(
            $defender->getDamage(),
            $damage
        );

        $this->assertEquals(
            $heroUnit->getHealth(),
            $expectedHealth
        );

    }

    /**
     * Test if defenders isLucky has same value as BaseUnit's one
     *
     * @dataProvider alwaysLuckyBaseUnitObject
     * @param BaseUnitInterface $baseUnit
     */
    public function testBaseUnitDefenderIsLucky(BaseUnitInterface $baseUnit): void
    {
        $defender = new Defender($baseUnit);

        $this->assertTrue($baseUnit->getIsLucky());

        $this->assertEquals(
            $baseUnit->getIsLucky(),
            $defender->isLucky()
        );
    }

    /**
     * Test if defenders isLucky has same value as BaseUnit's one
     *
     * @dataProvider alwaysUnluckyBaseUnitObject
     * @param BaseUnitInterface $baseUnit
     */
    public function testBaseUnitDefenderIsUnlucky(BaseUnitInterface $baseUnit): void
    {
        $defender = new Defender($baseUnit);

        $this->assertFalse($baseUnit->getIsLucky());

        $this->assertEquals(
            $baseUnit->getIsLucky(),
            $defender->isLucky()
        );
    }

    public function baseUnitObject(): array
    {
        return [
            [
                new BaseUnit(
                    60,
                    60,
                    40,
                    40,
                    25,
                    'Wild Beast'
                )
            ],
        ];
    }

    public function heroUnitObject(): array
    {
        return [
            [
                new Hero(
                    75,
                    79,
                    65,
                    40,
                    10,
                    10,
                    10,
                    'Orderus'
                )
            ],
        ];
    }

    public function alwaysLuckyBaseUnitObject(): array
    {
        return [
            [
                new BaseUnit(
                    60,
                    60,
                    40,
                    40,
                    100,
                    'Wild Beast'
                )
            ],
        ];
    }

    public function alwaysUnluckyBaseUnitObject(): array
    {
        return [
            [
                new BaseUnit(
                    60,
                    60,
                    40,
                    40,
                    0,
                    'Wild Beast'
                )
            ],
        ];
    }

    public function LuckyUnluckyHeroUnitObjects(): array
    {
        return [
            [
                new Hero(
                    75,
                    79,
                    65,
                    40,
                    100,
                    10,
                    10,
                    'Orderus'
                )
            ],
            [
                new Hero(
                    75,
                    79,
                    65,
                    40,
                    0,
                    10,
                    10,
                    'Orderus'
                )
            ],
        ];
    }
}
