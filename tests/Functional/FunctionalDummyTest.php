<?php

declare(strict_types=1);

namespace App\Tests\Functional;

use App\Tests\Integration\IntegrationTestCase;
use PHPUnit\Framework\TestCase;

final class FunctionalDummyTest extends FunctionalTestCase
{
    /**
     * @test
     */
    public function dummy(): void
    {
        self::assertTrue(true);
    }
}
