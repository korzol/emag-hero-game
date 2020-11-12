<?php
declare(strict_types=1);

namespace App\Battle\Message;

final class FinalMessage implements MessageInterface
{
    private array $statsData;

    public function __construct(array $statsData)
    {
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
