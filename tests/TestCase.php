<?php

namespace Dealskoo\Platform\Tests;

use Dealskoo\Platform\Providers\PlatformServiceProvider;

abstract class TestCase extends \Dealskoo\Seller\Tests\TestCase
{
    protected function getPackageProviders($app)
    {
        return [
            PlatformServiceProvider::class
        ];
    }

    protected function getPackageAliases($app)
    {
        return [];
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->loadMigrationsFrom(__DIR__ . '/migrations');
    }
}
