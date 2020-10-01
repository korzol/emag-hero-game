<?php
declare(strict_types=1);

namespace tests\Units;

use PHPUnit\Framework\TestCase;
use App\Units\Opponents\Wildbeast\Wildbeast;
use App\Units\Opponents\WildbeastBuilder;

final class WildbeastBuilderTest extends TestCase
{
    public function testBuilder(): void
    {
        $wildbeastBuilder = new WildbeastBuilder();
        $wildbeast = $wildbeastBuilder->build();

        $this->assertInstanceOf(Wildbeast::class, $wildbeast);
    }
}
