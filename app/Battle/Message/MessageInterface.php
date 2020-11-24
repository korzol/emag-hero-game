<?php
declare(strict_types=1);

namespace App\Battle\Message;

interface MessageInterface
{
    /**
     * @return array{
     *   attacker: array{
     *       name: string,
     *       health: int,
     *       strength: int,
     *       defence: int,
     *       speed: int,
     *       isRapidStrike: bool
     *   },
     *   defender: array{
     *       name: string,
     *       health: int,
     *       strength: int,
     *       defence: int,
     *       speed: int,
     *       isLucky: bool,
     *       isMagicShield: bool,
     *       damage: int,
     *   },
     *   message: string,
     *   messageType: string,
     * }
     */
    public function generateMessage(): array;
}
