<?php
declare(strict_types=1);

namespace App\Battle;

use \App\Battle\Disposition;

interface BattleInterface
{
    public function run(Disposition $disposition): void;
}
