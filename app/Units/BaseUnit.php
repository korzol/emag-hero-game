<?php
declare(strict_types=1);

namespace App\Units;

use LengthException;
use OutOfRangeException;

class BaseUnit implements BaseUnitInterface
{
    /**
     * @var int $health
     */
    private $health;

    /**
     * @var int $strength
     */
    private $strength;

    /**
     * @var int $defence
     */
    private $defence;

    /**
     * @var int $speed
     */
    private $speed;

    /**
     * @var int $luck
     */
    private $luck;

    /**
     * @var string $unitName
     */
    private $unitName;

    /**
     * BaseUnit constructor.
     * @param int $health
     * @param int $strength
     * @param int $defence
     * @param int $speed
     * @param int $luck
     * @param string $unitName
     */
    public function __construct(
        int $health,
        int $strength,
        int $defence,
        int $speed,
        int $luck,
        string $unitName
    )
    {
        $this->health = $health;
        $this->strength = $strength;
        $this->defence = $defence;
        $this->speed = $speed;
        $this->luck = $luck;
        $this->unitName = $unitName;

        $this->validateHealth();
        $this->validateStrength();
        $this->validateDefence();
        $this->validateSpeed();
        $this->validateLuck();
        $this->validateUnitName();
    }

    private function validateHealth(): void
    {
        if ($this->health < 0 || $this->health > 100)
        {
            throw new OutOfRangeException("Health value should be in range 0 - 100. {$this->health} given");
        }
    }

    private function validateStrength(): void
    {
        if ($this->strength < 0 ||  $this->strength > 100)
        {
            throw new OutOfRangeException("Strength  value should be in range 0 - 100. {$this->strength} given");
        }
    }

    private function validateDefence(): void
    {
        if ($this->defence < 0 || $this->defence > 100)
        {
            throw new OutOfRangeException("Defence  value should be in range 0 - 100. {$this->defence} given");
        }
    }

    private function validateSpeed(): void
    {
        if ($this->speed < 0 || $this->speed > 100)
        {
            throw new OutOfRangeException("Speed  value should be in range 0 - 100. {$this->speed} given");
        }
    }

    private function validateLuck(): void
    {
        if ($this->luck < 0 || $this->luck > 100)
        {
            throw new OutOfRangeException("Luck  value should be in range 0 - 100. {$this->luck} given");
        }
    }

    private function validateUnitName(): void
    {
        if (strlen($this->unitName) < 3 )
        {
            throw new LengthException("Do we need another unnamed unit? Don't think so");
        }
    }

    /**
     * @param int $health
     */
    public function setHealth(int $health): void
    {
        // TODO: Maybe make it 0 if health < 0 and make it 100 if health > 100 ?
        $this->validateHealth();

        $this->health = $health;
    }

    /**
     * @return bool
     * @throws \Exception
     */
    public function isLucky(): bool
    {
        $luck = $this->luck * 10;

        $randomValue = random_int(0, 1000);

        return $randomValue <= $luck;
    }

    /**
     * @return string
     */
    public function getUnitName(): string
    {
        return $this->unitName;
    }

    /**
     * @return int
     */
    public function getHealth(): int
    {
        return $this->health;
    }

    /**
     * @return int
     */
    public function getStrength(): int
    {
        return $this->strength;
    }

    /**
     * @return int
     */
    public function getDefence(): int
    {
        return $this->defence;
    }

    /**
     * @return int
     */
    public function getSpeed(): int
    {
        return $this->speed;
    }

    /**
     * @return int
     */
    public function getLuck(): int
    {
        return $this->luck;
    }
}
