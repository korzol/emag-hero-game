<?php
declare(strict_types=1);

namespace App\Battle\Message;

use Exception;

final class FinalMessage implements MessageInterface
{
    private array $statsData;

    public function __construct(array $statsData)
    {
        if (!isset($statsData['turnNumber']))
        {
            throw new Exception('Can not create Message object. Turn number is mandatory');
        }

        $this->statsData = $statsData;
    }

    /**
     * @inheritDoc
     */
    public function generateMessage(): array
    {
        return array_merge(
            $this->statsData,
            [
                "message" => "After {$this->statsData['turnNumber']} moves {$this->statsData['defender']['name']} has been defeated! {$this->statsData['attacker']['name']} is the winner!",
                "messageType" => "final",
            ],
        );
    }
}
