<?php
declare(strict_types=1);

namespace App\Battle\Participants;

use App\Units\BaseUnitInterface;

class Defender
{
    private BaseUnitInterface $unit;

    private bool $isLucky;

    private bool $isMagicShield;

    private int $damage;

    public function __construct(BaseUnitInterface $unit)
    {
        $this->unit = $unit;
        $this->setIsLucky();
        $this->setIsMagicShield();
        $this->damage = 0;
    }

    private function setIsLucky(): void
    {
        $this->isLucky = $this->unit->isLucky();
    }

    private function setIsMagicShield(): void
    {
        $this->isMagicShield = false;

        if (method_exists($this->unit, 'isMagicShield'))
        {
            $this->isMagicShield = $this->unit->isMagicShield();
        }
    }

    public function defend(): int
    {
        return $this->unit->getDefence();
    }

    public function setDamage(int $damage): void
    {
        $this->damage = $damage;
    }

    public function calculateHealth(): bool
    {
        $newHealth = $this->unit->getHealth() - $this->damage;

        if ($newHealth <= 0)
        {
            $newHealth = 0;
        }

        $this->unit->setHealth($newHealth);

        return $newHealth > 0;
    }

    public function isLucky(): bool
    {
        return $this->isLucky;
    }

    public function isMagicShield(): bool
    {
        return $this->isMagicShield;
    }

    public function getDamage(): int
    {
        return $this->damage;
    }

    public function getUnitObject(): BaseUnitInterface
    {
        return $this->unit;
    }
}
