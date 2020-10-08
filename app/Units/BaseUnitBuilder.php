<?php
declare(strict_types=1);

namespace App\Units;

class BaseUnitBuilder
{
    /**
     * @var array{
     *      name:string,
     *      health:array<int, int>,
     *      strength:array<int, int>,
     *      defence:array<int, int>,
     *      speed:array<int, int>,
     *      luck:array<int, int>
     * } $stats
     */
    private $stats;

    /**
     * BaseUnitBuilder constructor.
     * @param array{
     *      name:string,
     *      health:array<int, int>,
     *      strength:array<int, int>,
     *      defence:array<int, int>,
     *      speed:array<int, int>,
     *      luck:array<int, int>
     * } $stats
     */
    public function __construct($stats)
    {
        $this->stats = $stats;
    }

    /**
     * @return BaseUnitInterface
     */
    public function build(): BaseUnitInterface
    {
        $health = $this->randomValueGenerator($this->stats['health'][0], $this->stats['health'][1]);
        $strength = $this->randomValueGenerator($this->stats['strength'][0], $this->stats['strength'][1]);
        $defence = $this->randomValueGenerator($this->stats['defence'][0], $this->stats['defence'][1]);
        $speed = $this->randomValueGenerator($this->stats['speed'][0], $this->stats['speed'][1]);
        $luck = $this->randomValueGenerator($this->stats['luck'][0], $this->stats['luck'][1]);

        return new BaseUnit(
            $health,
            $strength,
            $defence,
            $speed,
            $luck,
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
