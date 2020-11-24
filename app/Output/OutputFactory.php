<?php
declare(strict_types=1);

namespace App\Output;


final class OutputFactory
{
    /**
     * @var string[]
     */
    private static $methods = [
        'cli' => Cli::class,
    ];

    /**
     * @param string $method
     * @return OutputInterface
     */
    public static function build(string $method): OutputInterface
    {
        $class = self::$methods[$method];
        return new $class();
    }
}
