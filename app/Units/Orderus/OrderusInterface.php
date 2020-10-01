<?php
declare(strict_types=1);

namespace App\Units\Orderus;


interface OrderusInterface
{
    public function isRapidStrike(): bool;

    public function isMagicShield(): bool;
}
