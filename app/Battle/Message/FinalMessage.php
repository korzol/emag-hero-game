<?php
declare(strict_types=1);

namespace App\Battle\Message;

use Exception;

final class FinalMessage implements MessageInterface
{
    /**
     * @var array{
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
     *   turnNumber: int,
     * }
     */
    private array $statsData;

    /**
     * @param array{
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
     *   turnNumber: int,
     * } $statsData
     */
    public function __construct(array $statsData)
    {
        if (!isset($statsData['turnNumber']))
        {
            throw new Exception('Can not create Message object. Turn number is mandatory');
        }

        $this->statsData = $statsData;
    }

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
    public function generateMessage(): array
    {
        // I'd prefer array_merge but phpstan raise false positive
        // See: https://github.com/phpstan/phpstan/issues/2567
        return
            $this->statsData +
            [
                "message" => "After {$this->statsData['turnNumber']} moves {$this->statsData['defender']['name']} has been defeated! {$this->statsData['attacker']['name']} is the winner!",
                "messageType" => "final",
            ];
    }
}
