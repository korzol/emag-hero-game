<?php
declare(strict_types=1);

namespace App\Units;

interface BaseUnitInterface
{
    public function getUnitName(): string;

    public function setHealth(int $health): void;

    public function isLucky(): bool;

    public function getHealth(): int;

    public function getStrength(): int;

    public function getDefence(): int;

    public function getSpeed(): int;

    public function getLuck(): int;
}
