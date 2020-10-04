<?php
declare(strict_types=1);

namespace App\Units\Opponents\Wildbeast;


use App\Units\UnitsBaseSkillsInterface;
use OutOfRangeException;

class Wildbeast implements UnitsBaseSkillsInterface
{
    /**
     * @var int $health Random in range 60 - 90
     */
    private $health;

    /**
     * @var int $strength Random in range 60 - 90
     */
    private $strength;

    /**
     * @var int $defence Random in range 40 - 60
     */
    private $defence;

    /**
     * @var int $speed Random in range 40 - 60
     */
    private $speed;

    /**
     * @var int $luck Random in range 25% - 40% (0% - no luck, 100% - lucky all the time )
     */
    private $luck;

    /**
     * @var array<string, mixed> $stats
     */
    private $stats = [
        "health" => [60, 90],
        "strength" => [60, 90],
        "defence" => [40, 60],
        "speed" => [40, 60],
        "luck" => [25, 45],
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

        $this->validateHealth();
        $this->validateStrength();
        $this->validateDefence();
        $this->validateSpeed();
        $this->validateLuck();
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
