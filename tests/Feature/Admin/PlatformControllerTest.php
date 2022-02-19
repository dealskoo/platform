<?php

namespace Dealskoo\Platform\Tests\Feature\Admin;

use Dealskoo\Admin\Models\Admin;
use Dealskoo\Platform\Models\Platform;
use Dealskoo\Platform\Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PlatformControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index()
    {
        $admin = Admin::factory()->isOwner()->create();
        $response = $this->actingAs($admin, 'admin')->get(route('admin.platforms.index'));
        $response->assertStatus(200);
    }

    public function test_table()
    {
        $admin = Admin::factory()->isOwner()->create();
        $response = $this->actingAs($admin, 'admin')->get(route('admin.platforms.index'), ['HTTP_X-Requested-With' => 'XMLHttpRequest']);
        $response->assertJsonPath('recordsTotal', 0);
        $response->assertStatus(200);
    }

    public function test_show()
    {
        $admin = Admin::factory()->isOwner()->create();
        $platform = Platform::factory()->create();
        $response = $this->actingAs($admin, 'admin')->get(route('admin.platforms.show', $platform));
        $response->assertStatus(200);
    }

    public function test_edit()
    {
        $admin = Admin::factory()->isOwner()->create();
        $platform = Platform::factory()->create();
        $response = $this->actingAs($admin, 'admin')->get(route('admin.platforms.edit', $platform));
        $response->assertStatus(200);
    }

    public function test_update()
    {
        $admin = Admin::factory()->isOwner()->create();
        $platform = Platform::factory()->create();
        $platform1 = Platform::factory()->make();
        $response = $this->actingAs($admin, 'admin')->put(route('admin.platforms.update', $platform), $platform1->only([
            'approved',
        ]));
        $response->assertStatus(302);
    }

    public function test_destroy()
    {
        $admin = Admin::factory()->isOwner()->create();
        $platform = Platform::factory()->create();
        $response = $this->actingAs($admin, 'admin')->delete(route('admin.platforms.destroy', $platform));
        $response->assertStatus(200);
        $this->assertSoftDeleted($platform);
    }
}
