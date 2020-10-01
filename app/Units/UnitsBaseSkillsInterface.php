<?php
declare(strict_types=1);

namespace App\Units;


interface UnitsBaseSkillsInterface
{
    public function setHealth(int $health): void;

    public function isLucky(): bool;

    public function getStrength(): int;

    public function getDefence(): int;

    public function getSpeed(): int;

    public function getLuck(): int;
}
