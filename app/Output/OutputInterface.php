<?php
declare(strict_types=1);

namespace App\Output;

use App\Output\Message\MessageInterface;

interface OutputInterface
{
    public function output(MessageInterface $messages): void;
}
