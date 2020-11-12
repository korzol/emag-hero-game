<?php
declare(strict_types=1);

namespace App\Battle\Message;

interface MessageInterface
{
    /**
     * @return array<string>
     */
    public function generateMessage(): array;
}
