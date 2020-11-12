<?php
declare(strict_types=1);

namespace App\Battle\Message;

final class InitialMessage implements MessageInterface
{
    private array $statsData;

    public function __construct(array $statsData)
    {
        $this->statsData = $statsData;
    }

    public function generateMessage(): array
    {
        return array_merge(
            $this->statsData,
            [
                "message" => "Initial participants disposition",
                "messageType" => "initial",
            ],
        );
    }
}
