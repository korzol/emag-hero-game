<?php
declare(strict_types=1);

namespace App\Output;

use App\Battle\Message\MessageInterface;

final class Cli implements OutputInterface
{
    public function output(MessageInterface $messages): void
    {
//        print_r($messages->generateMessage()); exit();
        echo '---'.PHP_EOL;
        foreach ($messages->generateMessage() as $message)
        {
            echo $message.PHP_EOL;
        }
        echo '---'.PHP_EOL;
    }
}
