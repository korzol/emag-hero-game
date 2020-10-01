<?php
declare(strict_types=1);

namespace tests\Units;

use PHPUnit\Framework\TestCase;
use App\Units\Orderus\Orderus;
use App\Units\OrderusBuilder;

final class OrderusBuilderTest extends TestCase
{
    public function testBuilder(): void
    {
        $orderusBuilder = new OrderusBuilder();
        $orderus = $orderusBuilder->build();

        $this->assertInstanceOf(Orderus::class, $orderus);
    }
}
