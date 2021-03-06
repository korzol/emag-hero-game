<?php
declare(strict_types=1);

namespace App\Battle\Message;


use App\Battle\Participants\Attacker;
use App\Battle\Participants\Defender;
use InvalidArgumentException;

final class MessageFactory
{
    /**
     * @var array|string[]
     */
    private array $messageTypes = [
        "initial" => InitialMessage::class,
        "statistic" => Message::class,
        "final" => FinalMessage::class,
    ];


    /**
     * @param string $messageType Type of message: initial, statistical (issued after each strike) or final one
     * @param Attacker $attacker
     * @param Defender $defender
     * @param int|null $turnNumber
     * @return MessageInterface
     * @throws \Exception
     */
    public function build(string $messageType, Attacker $attacker, Defender $defender, ?int $turnNumber=null): MessageInterface
    {
        $statsData = array_merge(
            $this->buildStatsArray($attacker, $defender),
            $this->defineTurnNumber($turnNumber),
        );

        if (array_key_exists($messageType, $this->messageTypes))
        {
            return new $this->messageTypes[$messageType]($statsData);
        }

        throw new InvalidArgumentException("Unknown message type requested");
    }

    /**
     * @param Attacker $attacker
     * @param Defender $defender
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
     *       damage: int
     *   }
     * }
     */
    private function buildStatsArray(Attacker $attacker, Defender $defender): array
    {
        $attackerUnit = $attacker->getUnitObject();
        $defenderUnit = $defender->getUnitObject();

        return [
            "attacker" => [
                "name" => $attackerUnit->getUnitName(),
                "health" => $attackerUnit->getHealth(),
                "strength" => $attackerUnit->getStrength(),
                "defence" => $attackerUnit->getDefence(),
                "speed" => $attackerUnit->getSpeed(),
                "isRapidStrike" => $attacker->isRapidStrike(),
            ],
            "defender" => [
                "name" => $defenderUnit->getUnitName(),
                "health" => $defenderUnit->getHealth(),
                "strength" => $defenderUnit->getStrength(),
                "defence" => $defenderUnit->getDefence(),
                "speed" => $defenderUnit->getSpeed(),
                "isLucky" => $defender->isLucky(),
                "isMagicShield" => $defender->isMagicShield(),
                "damage" => $defender->getDamage(),
            ],
        ];
    }

    /**
     * @param int|null $turnNumber
     * @return array|int[]
     */
    private function defineTurnNumber(?int $turnNumber): array
    {
        if ($turnNumber)
        {
            return [
                "turnNumber" => $turnNumber,
            ];
        }

        return [];
    }
}
