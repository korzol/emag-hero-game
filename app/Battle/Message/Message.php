<?php
declare(strict_types=1);

namespace App\Battle\Message;


final class Message implements MessageInterface
{
    private array $statsData;

    public function __construct(array $statsData)
    {
        $this->statsData = $statsData;
    }

    public function generateMessage(): array
    {
        if ($this->statsData['defender']['isLucky'])
        {
            $message = [
                "message" =>
                    "{$this->statsData['defender']['name']} gets lucky this turn. {$this->statsData['attacker']['name']} missed their hit and caused 0pts damage.",
            ];
        }
        elseif ($this->statsData['attacker']['isRapidStrike'])
        {
            $message = [
                "message" =>
                    "{$this->statsData['attacker']['name']} gets Rapid Strike this turn. Hit {$this->statsData['defender']['name']} twice and caused {$this->statsData['defender']['damage']}pts damage.",
            ];
        }
        elseif ($this->statsData['defender']['isMagicShield'])
        {
            $message = [
                "message" =>
                    "{$this->statsData['attacker']['name']} hit {$this->statsData['defender']['name']}
                    {$this->statsData['defender']['name']} gets Magic Shield this turn. Damage is divided in half: ({$this->statsData['defender']['damage']}pts)",
            ];
        }
        else
        {
            $message = [
                "message" =>
                    "{$this->statsData['attacker']['name']} hit {$this->statsData['defender']['name']} and caused {$this->statsData['defender']['damage']}pts damage."
            ];
        }

        return array_merge(
            $this->statsData,
            $message,
            [
                "messageType" => "statistic"
            ]
        );
    }
}
