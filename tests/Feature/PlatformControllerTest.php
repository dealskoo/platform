<?php

namespace Dealskoo\Platform\Tests\Feature;

use Dealskoo\Platform\Models\Platform;
use Dealskoo\Platform\Tests\TestCase;
use Dealskoo\Seller\Models\Seller;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class PlatformControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index()
    {
        $seller = Seller::factory()->create();
        $response = $this->actingAs($seller, 'seller')->get(route('seller.platforms.index'));
        $response->assertStatus(200);
    }

    public function test_table()
    {
        $seller = Seller::factory()->create();
        $response = $this->actingAs($seller, 'seller')->get(route('seller.platforms.index'), ['HTTP_X-Requested-With' => 'XMLHttpRequest']);
        $response->assertJsonPath('recordsTotal', 0);
        $response->assertStatus(200);
    }

    public function test_create()
    {
        $seller = Seller::factory()->create();
        $response = $this->actingAs($seller, 'seller')->get(route('seller.platforms.create'));
        $response->assertStatus(200);
    }

    public function test_store()
    {
        Storage::fake();
        $seller = Seller::factory()->create();
        $platform = Platform::factory()->make(['seller_id' => $seller->id, 'country_id' => $seller->country->id]);
        $response = $this->actingAs($seller, 'seller')->post(route('seller.platforms.store'), [
            'logo' => UploadedFile::fake()->image('file.jpg'),
            'name' => $platform->name,
            'website' => $platform->website,
            'description' => $platform->description
        ]);
        $response->assertStatus(302);
        $platform = platform::query()->first();
        Storage::assertExists('platforms/' . $platform->id . '.jpg');
    }

    public function test_edit()
    {
        $seller = Seller::factory()->create();
        $platform = Platform::factory()->create(['seller_id' => $seller->id]);
        $response = $this->actingAs($seller, 'seller')->get(route('seller.platforms.edit', $platform));
        $response->assertStatus(200);
    }

    public function test_update()
    {
        $seller = Seller::factory()->create();
        $platform = Platform::factory()->create(['seller_id' => $seller->id, 'country_id' => $seller->country->id]);
        $platform1 = Platform::factory()->make();
        $response = $this->actingAs($seller, 'seller')->put(route('seller.platforms.update', $platform), [
            'name' => $platform1->name,
            'website' => $platform1->website,
            'description' => $platform1->description
        ]);
        $response->assertStatus(302);
    }

    public function test_destroy()
    {
        $seller = Seller::factory()->create();
        $platform = platform::factory()->create(['seller_id' => $seller->id]);
        $response = $this->actingAs($seller, 'seller')->delete(route('seller.platforms.destroy', $platform));
        $response->assertStatus(200);
    }
}
