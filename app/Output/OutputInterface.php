<?php
declare(strict_types=1);

namespace App\Output;

use App\Battle\Message\MessageInterface;

interface OutputInterface
{
    public function yield(MessageInterface $messages): void;
}
