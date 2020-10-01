<?php
declare(strict_types=1);

namespace App\Units\Orderus;

use OutOfRangeException;
use UnexpectedValueException;
use \App\Units\UnitsBaseSkillsInterface;

class Orderus implements UnitsBaseSkillsInterface, OrderusInterface
{
    /**
     * @var int $health Random in range 70 - 100
     */
    private $health;

    /**
     * @var int $strength Random in range 70 - 80
     */
    private $strength;

    /**
     * @var int $defence Random in range 45 - 55
     */
    private $defence;

    /**
     * @var int $speed Random in range 40 - 50
     */
    private $speed;

    /**
     * @var int $luck Random in range 10% - 30% (0% - no luck, 100% - lucky all the time )
     */
    private $luck;

    /**
     * @var int $rapidStrike 10% probability
     */
    private $rapidStrike;

    /**
     * @var int $magicShield 20% probability
     */
    private $magicShield;

    /**
     * @var array<string, mixed> $stats
     */
    private $stats = [
        "health" => [70, 100],
        "strength" => [70, 80],
        "defence" => [45, 55],
        "speed" => [40, 50],
        "luck" => [10, 30],
        "rapidStrike" => 10,
        "magicShield" => 20
    ];

    public function __construct(
        int $health,
        int $strength,
        int $defence,
        int $speed,
        int $luck
    )
    {
        $this->health = $health;
        $this->strength = $strength;
        $this->defence = $defence;
        $this->speed = $speed;
        $this->luck = $luck;
        $this->rapidStrike = 10;
        $this->magicShield = 20;

        $this->validateHealth();
        $this->validateStrength();
        $this->validateDefence();
        $this->validateSpeed();
        $this->validateLuck();
        $this->validateRapidStrike();
        $this->validateMagicShield();
    }

    private function validateHealth(): void
    {
        if ($this->health < $this->stats["health"][0] || $this->health > $this->stats["health"][1])
        {
            throw new OutOfRangeException("Health value is out of range: {$this->stats["health"][0]} - {$this->stats["health"][1]}");
        }
    }

    private function validateStrength(): void
    {
        if ($this->strength < $this->stats["strength"][0] || $this->strength > $this->stats["strength"][1])
        {
            throw new OutOfRangeException("Strength value is out of range: {$this->stats["strength"][0]} - {$this->stats["strength"][1]}");
        }
    }

    private function validateDefence(): void
    {
        if ($this->defence < $this->stats["defence"][0] || $this->defence > $this->stats["defence"][1])
        {
            throw new OutOfRangeException("Defence value is out of range: {$this->stats["defence"][0]} - {$this->stats["defence"][1]}");
        }
    }

    private function validateSpeed(): void
    {
        if ($this->speed < $this->stats["speed"][0] || $this->speed > $this->stats["speed"][1])
        {
            throw new OutOfRangeException("Speed value is out of range: {$this->stats["speed"][0]} - {$this->stats["speed"][1]}");
        }
    }

    private function validateLuck(): void
    {
        if ($this->luck < $this->stats["luck"][0] || $this->luck > $this->stats["luck"][1])
        {
            throw new OutOfRangeException("Luck value is out of range: {$this->stats["luck"][0]} - {$this->stats["luck"][1]}");
        }
    }

    private function validateRapidStrike(): void
    {
        if ($this->rapidStrike != $this->stats["rapidStrike"])
        {
            throw new UnexpectedValueException("Rapid strike value should be equal to: {$this->stats['rapidStrike']}");
        }
    }

    private function validateMagicShield(): void
    {
        if ($this->magicShield != $this->stats["magicShield"])
        {
            throw new UnexpectedValueException("Magic Shield value should be equal to: {$this->stats["magicShield"]}");
        }
    }

    public function setHealth(int $health): void
    {
        if ($this->health < 0 || $this->health > 100)
        {
            throw new OutOfRangeException("Health value should be between 0 and 100");
        }

        $this->health = $health;
    }

    /**
     * Find out if unit (as a defender) gets lucky this turn
     *
     * @return bool
     */
    public function isLucky(): bool
    {
        $luck = $this->luck * 10;

        $randomValue = random_int(0, 1000);

        return $randomValue <= $luck;
    }

    public function isMagicShield(): bool
    {
        // 20
        $probability = $this->magicShield * 10;

        $randomValue = random_int(0, 1000);

        return $randomValue <= $probability;
    }

    public function isRapidStrike(): bool
    {
        $probability = $this->rapidStrike * 10;

        $randomValue = random_int(0, 1000);

        return $randomValue <= $probability;
    }

    public function getHealth(): int
    {
        return $this->health;
    }

    public function getStrength(): int
    {
        return $this->strength;
    }

    public function getDefence(): int
    {
        return $this->defence;
    }

    public function getSpeed(): int
    {
        return $this->speed;
    }

    public function getLuck(): int
    {
        return $this->luck;
    }
}
