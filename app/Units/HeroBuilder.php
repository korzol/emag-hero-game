<?php
declare(strict_types=1);

namespace App\Units;

use App\Units\Heroes\HeroInterface;
use App\Units\Heroes\Hero;

final class HeroBuilder
{
    /**
     * @var array{
     *      name:string,
     *      health:array<int, int>,
     *      strength:array<int, int>,
     *      defence:array<int, int>,
     *      speed:array<int, int>,
     *      luck:array<int, int>,
     *      rapidStrike: int,
     *      magicShield: int,
     * } $stats
     */
    private $stats;

    /**
     * HeroBuilder constructor.
     * @param array{
     *      name:string,
     *      health:array<int, int>,
     *      strength:array<int, int>,
     *      defence:array<int, int>,
     *      speed:array<int, int>,
     *      luck:array<int, int>,
     *      rapidStrike: int,
     *      magicShield: int,
     * } $stats
     */
    public function __construct($stats)
    {
        $this->stats = $stats;
    }

    /**
     * @return HeroInterface
     */
    public function build(): HeroInterface
    {
        $health = $this->randomValueGenerator($this->stats['health'][0], $this->stats['health'][1]);
        $strength = $this->randomValueGenerator($this->stats['strength'][0], $this->stats['strength'][1]);
        $defence = $this->randomValueGenerator($this->stats['defence'][0], $this->stats['defence'][1]);
        $speed = $this->randomValueGenerator($this->stats['speed'][0], $this->stats['speed'][1]);
        $luck = $this->randomValueGenerator($this->stats['luck'][0], $this->stats['luck'][1]);

        return new Hero(
            $health,
            $strength,
            $defence,
            $speed,
            $luck,
            $this->stats['rapidStrike'],
            $this->stats['magicShield'],
            $this->stats['name']
        );
    }

    /**
     * @param int $from
     * @param int $to
     * @return int
     * @throws \Exception
     */
    private function randomValueGenerator(int $from, int $to): int
    {
        return random_int($from, $to);
    }
}
