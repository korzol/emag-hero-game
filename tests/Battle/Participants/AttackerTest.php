<?php
declare(strict_types=1);

namespace tests\Battle\Participants;

use App\Battle\Participants\Attacker;
use App\Units\BaseUnit;
use App\Units\BaseUnitInterface;
use App\Units\Heroes\Hero;
use PHPUnit\Framework\TestCase;

class AttackerTest extends TestCase
{
    /**
     * @dataProvider baseUnitInterfaceObject
     * @param BaseUnitInterface $unit
     */
    public function testGetUnitObject(BaseUnitInterface $unit): void
    {
        $attacker = new Attacker($unit);

        $this->assertInstanceOf(
            'App\Units\BaseUnitInterface',
            $attacker->getUnitObject()
        );
    }

    /**
     * @dataProvider baseUnitInterfaceObject
     * @param BaseUnitInterface $unit
     */
    public function testIsRapidStrike(BaseUnitInterface $unit): void
    {
        $attacker = new Attacker($unit);

        $this->assertIsBool($attacker->isRapidStrike());
    }

    /**
     * @dataProvider baseUnitObject
     * @param BaseUnitInterface $unit
     */
    public function testBaseUnitAttack(BaseUnitInterface $unit): void
    {
        $attacker = new Attacker($unit);

        $this->assertEquals(
            $unit->getStrength(),
            $attacker->attack()
        );
    }

    /**
     * @dataProvider heroUnitObject
     * @param BaseUnitInterface $unit
     */
    public function testHeroUnitAttack(BaseUnitInterface $unit): void
    {
        $attacker = new Attacker($unit);

        $this->assertEquals(
            $unit->getStrength(),
            $attacker->attack()
        );
    }

    public function baseUnitInterfaceObject(): array
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
                ),
            ],
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
            ]
        ];
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
                ),
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
                    100,
                    10,
                    10,
                    'Orderus'
                ),
            ],
        ];
    }
}
