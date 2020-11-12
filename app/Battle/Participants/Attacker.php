<?php
declare(strict_types=1);

namespace App\Battle\Participants;

use App\Units\BaseUnitInterface;

class Attacker
{
    private BaseUnitInterface $unit;

    private bool $isRapidStrike;

    public function __construct(BaseUnitInterface $unit)
    {
        $this->unit = $unit;

        $this->setInitialRapidStrike();
    }

    private function setInitialRapidStrike(): void
    {
        $this->isRapidStrike = false;

        if (method_exists($this->unit, 'isRapidStrike'))
        {
            $this->isRapidStrike = $this->unit->isRapidStrike();
        }
    }

    public function isRapidStrike(): bool
    {
        return $this->isRapidStrike;
    }

    public function setRapidStrikeFalse(): void
    {
        $this->isRapidStrike = false;
    }

    public function attack(): int
    {
        return $this->unit->getStrength();
    }

    public function getUnitObject(): BaseUnitInterface
    {
        return $this->unit;
    }
}
