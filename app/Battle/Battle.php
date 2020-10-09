<?php
declare(strict_types=1);

namespace App\Battle;

use App\Units\BaseUnitInterface;
use LogicException;

// TODO: This is a draft, working but ugly battle class. Refactor required
class Battle implements BattleInterface
{
    /**
     * @var BaseUnitInterface $hero
     */
    private $hero;

    /**
     * @var BaseUnitInterface $opponent
     */
    private $opponent;

    /**
     * @var array<string, BaseUnitInterface> $disposition
     */
    private $disposition;

    public function __construct(BaseUnitInterface $hero, BaseUnitInterface $opponent)
    {
        $this->hero = $hero;
        $this->opponent = $opponent;

        $this->disposition = [
            'attacker' => $this->opponent,
            'defender' => $this->hero,
        ];

        $this->defineFirstAttacker();
    }

    private function defineFirstAttacker(): void
    {
        $this->compareSpeed();
    }

    private function isSpeedEqual(): bool
    {
        return $this->hero->getSpeed() == $this->opponent->getSpeed();
    }

    private function compareSpeed(): void
    {
        if ($this->isSpeedEqual())
        {
            $this->compareLuck();
            return;
        }

        if ($this->hero->getSpeed() > $this->opponent->getSpeed())
        {
            $this->disposition = [
                'attacker' => $this->hero,
                'defender' => $this->opponent,
            ];
            return;
        }

    }

    private function compareLuck(): void
    {
        if ($this->hero->getLuck() > $this->opponent->getLuck())
        {
            $this->disposition = [
                'attacker' => $this->hero,
                'defender' => $this->opponent,
            ];
            return;
        }

        if ($this->hero->getLuck() == $this->opponent->getLuck())
        {
            throw new LogicException("Can't determine first attacker");
        }
    }

    private function isMagicShield(): bool
    {
        return (method_exists($this->disposition['defender'], 'isMagicShield') && $this->disposition['defender']->isMagicShield());
    }

    private function calculateDamage(): void
    {
        // defender gets lucky this turn
        if ($this->disposition['defender']->isLucky())
        {
            return;
        }

        $damage = $this->disposition['attacker']->getStrength() - $this->disposition['defender']->getDefence();

        // if defender is hero and he gets power of magicShield this turn
        if ($this->isMagicShield())
        {
            $damage = intval(floor($damage / 2));
        }

        $this->disposition['defender']->setHealth(
            $this->disposition['defender']->getHealth() - $damage
        );
    }

    private function inverseDisposition(): void
    {
        $keys = array_keys($this->disposition);
        $values = array_values($this->disposition);
        $reversedKeys = array_reverse($keys);

        if ( $combinedArray = array_combine($reversedKeys, $values) )
        {
            $this->disposition = $combinedArray;
            return;
        }

        throw new LogicException("Can not inverse attacker and defender");
    }

    private function isDefenderHasEnoughHealth(): bool
    {
        return $this->disposition['defender']->getHealth() > 0;
    }

    private function isRapidStrike(): bool
    {
        return (method_exists($this->disposition['attacker'], 'isRapidStrike') && $this->disposition['attacker']->isRapidStrike());
    }

    private function attack(): void
    {
        if ($this->isDefenderHasEnoughHealth())
        {
            $this->calculateDamage(); // attack
            if ($this->isRapidStrike())
            {
                $this->calculateDamage(); // Orderus gets lucky enough to make second attack
            }
            $this->inverseDisposition();

            return;
        }

        throw new LogicException("{$this->disposition['defender']->getUnitName()} has been defeated!");
    }

    public function run(): void
    {
        for ($i = 1; $i <= 20; ++$i)
        {
            $this->attack();
        }
    }
}
