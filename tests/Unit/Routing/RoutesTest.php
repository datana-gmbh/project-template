<?php

declare(strict_types=1);

namespace App\Tests\Unit\Routing;

use App\Routing\Routes;
use App\Tests\Unit\UnitTestCase;
use ReflectionClass;

final class RoutesTest extends UnitTestCase
{
    /**
     * @test
     */
    public function constants(): void
    {
        self::assertSame('get_short_url', Routes::GET_SHORT_URL);
    }

    /**
     * @test
     */
    public function numberOfRoutes(): void
    {
        $class = new ReflectionClass(Routes::class);

        self::assertCount(1, $class->getConstants());
    }
}
