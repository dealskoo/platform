<?php

namespace Dealskoo\Platform\Tests\Feature;

use Dealskoo\Admin\Facades\PermissionManager;
use Dealskoo\Platform\Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PermissionTest extends TestCase
{
    use RefreshDatabase;

    public function test_permissions()
    {
        $this->assertNotNull(PermissionManager::getPermission('platforms.index'));
        $this->assertNotNull(PermissionManager::getPermission('platforms.show'));
        $this->assertNotNull(PermissionManager::getPermission('platforms.edit'));
        $this->assertNotNull(PermissionManager::getPermission('platforms.destroy'));
    }
}
