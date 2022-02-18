<?php

namespace Dealskoo\Platform\Tests;

use Dealskoo\Platform\Providers\PlatformServiceProvider;

abstract class TestCase extends \Dealskoo\Admin\Tests\TestCase
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
}
