<?php
declare(strict_types=1);

namespace App\Battle;

use App\Battle\Participants\Attacker;
use App\Battle\Participants\Defender;
use App\Units\BaseUnitInterface;
use LogicException;

class Disposition
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
     * @var array<string, BaseUnitInterface> $position
     */
    private $position;

    public function __construct(BaseUnitInterface $hero, BaseUnitInterface $opponent)
    {
        $this->hero = $hero;
        $this->opponent = $opponent;

        $this->position = [
            'attacker' => $this->opponent,
            'defender' => $this->hero,
        ];

        $this->defineFirstAttacker();
    }

    private function defineFirstAttacker(): void
    {
        $this->compareSpeed();
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
            $this->position = [
                'attacker' => $this->hero,
                'defender' => $this->opponent,
            ];
            return;
        }

    }

    private function isSpeedEqual(): bool
    {
        return $this->hero->getSpeed() == $this->opponent->getSpeed();
    }

    private function compareLuck(): void
    {
        if ($this->hero->getLuck() > $this->opponent->getLuck())
        {
            $this->position = [
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

    public function inversePositions(): array
    {
        $keys = array_keys($this->position);
        $values = array_values($this->position);
        $reversedKeys = array_reverse($keys);

        if ( $combinedArray = array_combine($reversedKeys, $values) )
        {
            $this->position = $combinedArray;
            return $this->convertUnitsToRoles();
        }

        throw new LogicException("Can not inverse attacker and defender");
    }

    private function convertUnitsToRoles(): array
    {
        return [
            'attacker' => new Attacker($this->position['attacker']),
            'defender' => new Defender($this->position['defender'])
        ];
    }

    public function getPositions(): array
    {
        return $this->convertUnitsToRoles();
    }

}
