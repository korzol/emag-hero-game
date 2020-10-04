<?php
declare(strict_types=1);

namespace App\Units\Opponents;


use App\Units\Opponents\Wildbeast\Wildbeast;

final class WildbeastBuilder
{
    // TODO: It's a quick hack. Need to refactor this array at some later point
    /**
     * @var array<string, array<int>> $stats
     */
    private $stats = [
        "health" => [60, 90],
        "strength" => [60, 90],
        "defence" => [40, 60],
        "speed" => [40, 60],
        "luck" => [25, 40],
    ];

    public function build(): Wildbeast
    {
        $health = $this->randomValueGenerator($this->stats['health'][0], $this->stats['health'][1]);
        $strength = $this->randomValueGenerator($this->stats['strength'][0], $this->stats['strength'][1]);
        $defence = $this->randomValueGenerator($this->stats['defence'][0], $this->stats['defence'][1]);
        $speed = $this->randomValueGenerator($this->stats['speed'][0], $this->stats['speed'][1]);
        $luck = $this->randomValueGenerator($this->stats['luck'][0], $this->stats['luck'][1]);

        return new Wildbeast(
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
