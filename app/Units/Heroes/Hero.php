<?php
declare(strict_types=1);

namespace App\Units\Heroes;

use App\Units\BaseUnit;
use UnexpectedValueException;

class Hero extends BaseUnit implements HeroInterface
{
    /**
     * @var int $rapidStrike
     */
    private $rapidStrike;

    /**
     * @var bool $isRapidStrike
     */
    private $isRapidStrike;

    /**
     * @var int $magicShield
     */
    private $magicShield;

    /**
     * @var bool $isMagicShield
     */
    private $isMagicShield;

    /**
     * Hero constructor.
     * @param int $health
     * @param int $strength
     * @param int $defence
     * @param int $speed
     * @param int $luck
     * @param int $rapidStrike
     * @param int $magicShield
     * @param string $unitName
     */
    public function __construct(
        int $health,
        int $strength,
        int $defence,
        int $speed,
        int $luck,
        int $rapidStrike,
        int $magicShield,
        string $unitName
    ) {
        parent::__construct(
            $health,
            $strength,
            $defence,
            $speed,
            $luck,
            $unitName
        );

        $this->rapidStrike = $rapidStrike;
        $this->magicShield = $magicShield;

        $this->validateRapidStrike();
        $this->validateMagicShield();
    }

    private function validateRapidStrike(): void
    {
        if ($this->rapidStrike  < 0 || $this->rapidStrike > 100)
        {
            throw new UnexpectedValueException("Rapid strike value should be in range 0 - 100. {$this->rapidStrike} given");
        }
    }

    private function validateMagicShield(): void
    {
        if ($this->magicShield < 0 || $this->magicShield > 100)
        {
            throw new UnexpectedValueException("Magic Shield value should be in range 0 - 100. {$this->magicShield} given");
        }
    }

    /**
     * @return int
     */
    public function getMagicShield(): int
    {
        return $this->magicShield;
    }

    /**
     * @return int
     */
    public function getRapidStrike(): int
    {
        return $this->rapidStrike;
    }

    /**
     * @return bool
     * @throws \Exception
     */
    public function isRapidStrike(): bool
    {
        $probability = $this->rapidStrike * 10;

        $randomValue = random_int(0, 1000);

        $this->isRapidStrike = $randomValue <= $probability;

        return $this->isRapidStrike;
    }

    /**
     * @return bool
     * @throws \Exception
     */
    public function isMagicShield(): bool
    {
        $probability = $this->magicShield * 10;

        $randomValue = random_int(0, 1000);

        $this->isMagicShield = $randomValue <= $probability;

        return $this->isMagicShield;
    }

    public function debug(): array
    {
        return array_merge(
            parent::debug(),
            [
                'isRapidStrike' => $this->isRapidStrike,
                'isMagicShield' => $this->isMagicShield,
            ]
        );
    }
}
