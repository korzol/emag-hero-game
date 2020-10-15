<?php
declare(strict_types=1);

namespace App\Output;


final class OutputFactory
{
    private static $methods = [
        'cli' => Cli::class,
    ];

    public static function build($method): OutputInterface
    {
        $class = self::$methods[$method];
        return new $class();
    }
}
