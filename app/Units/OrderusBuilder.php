<?php
declare(strict_types=1);

namespace App\Units;

use App\Units\Orderus\Orderus;

// TODO: Probably rename Orderus directory to Heroes to reflect its content and do not duplicate class name

final class OrderusBuilder
{
    // TODO: It's a quick hack. Need to refactor this array at some later point
    /**
     * @var array<string, array<int>> $stats
     */
    private $stats = [
        "health" => [70, 100],
        "strength" => [70, 80],
        "defence" => [45, 55],
        "speed" => [40, 50],
        "luck" => [10, 30],
    ];

    public function build(): Orderus
    {
        $health = $this->randomValueGenerator($this->stats['health'][0], $this->stats['health'][1]);
        $strength = $this->randomValueGenerator($this->stats['strength'][0], $this->stats['strength'][1]);
        $defence = $this->randomValueGenerator($this->stats['defence'][0], $this->stats['defence'][1]);
        $speed = $this->randomValueGenerator($this->stats['speed'][0], $this->stats['speed'][1]);
        $luck = $this->randomValueGenerator($this->stats['luck'][0], $this->stats['luck'][1]);

        return new Orderus(
            $health,
            $strength,
            $defence,
            $speed,
            $luck
        );
    }

    private function randomValueGenerator(int $from, int $to): int
    {
        return random_int($from, $to);
    }
}
