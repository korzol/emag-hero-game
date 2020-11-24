<?php
declare(strict_types=1);

namespace App\Output;

use App\Battle\Message\MessageInterface;
use Exception;

final class Cli implements OutputInterface
{
    private const COLORS = [
        "default" => "\e[39m",
        "blue" => "\e[33m",
        "light_cyan" => "\e[96m",
        "light_magenta" => "\e[95m",
        "red" => "\e[91m",
        "green" => "\e[92m",
    ];

    /**
     * @param MessageInterface $messages
     * @return string[]
     */
    private function initialMessage(MessageInterface $messages): array
    {
        $messageArray = $messages->generateMessage();

        return [
            "~".self::COLORS['red'].$messageArray['attacker']['name']."~".self::COLORS['green'].$messageArray['defender']['name'],
            self::COLORS['light_magenta']."Health:~".self::COLORS['light_cyan'].$messageArray['attacker']['health']."~".$messageArray['defender']['health'],
            self::COLORS['light_magenta']."Strength:~".self::COLORS['light_cyan'].$messageArray['attacker']['strength']."~".$messageArray['defender']['strength'],
            self::COLORS['light_magenta']."Defence:~".self::COLORS['light_cyan'].$messageArray['attacker']['defence']."~".$messageArray['defender']['defence'],
            self::COLORS['light_magenta']."Speed:~".self::COLORS['light_cyan'].$messageArray['attacker']['speed']."~".$messageArray['defender']['speed'],
        ];
    }

    /**
     * @param MessageInterface $messages
     * @return string[]
     */
    private function statisticMessage(MessageInterface $messages): array
    {
        $messageArray = $messages->generateMessage();

        return [
            "~".self::COLORS['red'].$messageArray['attacker']['name']."~".self::COLORS['green'].$messageArray['defender']['name'],

            self::COLORS['light_magenta']."Health:~".self::COLORS['light_cyan'].$messageArray['attacker']['health']."~".$messageArray['defender']['health'],

            self::COLORS['light_magenta']."Strength:~".self::COLORS['light_cyan'].$messageArray['attacker']['strength']."~".$messageArray['defender']['strength'],

            self::COLORS['light_magenta']."Defence:~".self::COLORS['light_cyan'].$messageArray['attacker']['defence']."~".$messageArray['defender']['defence'],

            self::COLORS['light_magenta']."Speed:~".self::COLORS['light_cyan'].$messageArray['attacker']['speed']."~".$messageArray['defender']['speed'],

            self::COLORS['light_magenta']."Luck:~".self::COLORS['light_cyan']."- ~".($messageArray['defender']['isLucky'] ? "Yes" : "No"),

            self::COLORS['light_magenta']."Magic Shield:~".self::COLORS['light_cyan']."- ~".($messageArray['defender']['isMagicShield'] ? "Yes" : "No"),
            self::COLORS['light_magenta']."Rapid Strike:~".self::COLORS['light_cyan'].($messageArray['attacker']['isRapidStrike'] ? "Yes" : "No")."~ -",
        ];
    }

    /**
     * @param MessageInterface $messages
     * @return string[]
     */
    private function finalMessage(MessageInterface $messages): array
    {
        $messageArray = $messages->generateMessage();

        return [
            "~".self::COLORS['red'].$messageArray['attacker']['name']."~".self::COLORS['green'].$messageArray['defender']['name'],

            self::COLORS['light_magenta']."Health:~".self::COLORS['light_cyan'].$messageArray['attacker']['health']."~".$messageArray['defender']['health'],

            self::COLORS['light_magenta']."Strength:~".self::COLORS['light_cyan'].$messageArray['attacker']['strength']."~".$messageArray['defender']['strength'],

            self::COLORS['light_magenta']."Defence:~".self::COLORS['light_cyan'].$messageArray['attacker']['defence']."~".$messageArray['defender']['defence'],

            self::COLORS['light_magenta']."Speed:~".self::COLORS['light_cyan'].$messageArray['attacker']['speed']."~".$messageArray['defender']['speed'],

            self::COLORS['light_magenta']."Luck:~".self::COLORS['light_cyan']."- ~".($messageArray['defender']['isLucky'] ? "Yes" : "No"),

            self::COLORS['light_magenta']."Magic Shield:~".self::COLORS['light_cyan']."- ~".($messageArray['defender']['isMagicShield'] ? "Yes" : "No"),
            self::COLORS['light_magenta']."Rapid Strike:~".self::COLORS['light_cyan'].($messageArray['attacker']['isRapidStrike'] ? "Yes" : "No")."~ -",
        ];
    }

    /**
     * @param MessageInterface $messages
     */
    public function yield(MessageInterface $messages): void
    {
        $legend = '';
        if ($messages->generateMessage()['messageType'] == 'initial') {
            $legend .= self::COLORS['default']."Attacker - ".self::COLORS['red']."red".PHP_EOL;
            $legend .= self::COLORS['default']."Defender - ".self::COLORS['green']."green".str_repeat(PHP_EOL, 2);

            $message = $this->initialMessage($messages);
        } elseif ($messages->generateMessage()['messageType'] == 'statistic') {
            $message = $this->statisticMessage($messages);
        } elseif ($messages->generateMessage()['messageType'] == 'final') {
            $message = $this->finalMessage($messages);
        } else {
            throw new Exception('Unknown message type received');
        }


        $m = PHP_EOL;
        foreach ($message as $line)
        {
            $m .= $line.PHP_EOL;
        }

        // TODO: *luck* Wild beast missed their hit ??

        $m .= PHP_EOL;
        echo $legend;
        echo self::COLORS['blue'].$messages->generateMessage()['message'].self::COLORS['default'].PHP_EOL;
        passthru('echo -e "'.$m.'" | column -t -s"~"');
        echo PHP_EOL,PHP_EOL;

    }
}
