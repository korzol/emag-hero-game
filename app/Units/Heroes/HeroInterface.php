<?php
declare(strict_types=1);

namespace App\Units\Heroes;

use App\Units\BaseUnitInterface;

interface HeroInterface extends BaseUnitInterface
{
    /**
     * @return int
     */
    public function getMagicShield(): int;

    /**
     * @return int
     */
    public function getRapidStrike(): int;

    /**
     * @return bool
     */
    public function isRapidStrike(): bool;

    /**
     * @return bool
     */
    public function isMagicShield(): bool;
}
