<?php

namespace Dealskoo\Platform\Tests\Unit;

use Dealskoo\Platform\Models\Platform;
use Dealskoo\Platform\Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PlatformTest extends TestCase
{
    use RefreshDatabase;

    public function test_logo_url()
    {
        $file = '1.png';
        $platform = Platform::factory()->create(['logo' => $file]);
        $this->assertEquals(Storage::url($file), $platform->logo_url);
    }

    public function test_slug()
    {
        $slug = 'Baa';
        $platform = Platform::factory()->create(['slug' => $slug]);
        $this->assertNotNull($platform->slug);
        $this->assertEquals(Str::lower($slug), $platform->slug);
    }

    public function test_country()
    {
        $platform = Platform::factory()->create();
        $this->assertNotNull($platform->country);
    }

    public function test_seller()
    {
        $platform = Platform::factory()->create();
        $this->assertNotNull($platform->seller);
    }

    public function test_approved()
    {
        $count = 2;
        Platform::factory()->create();
        Platform::factory()->count($count)->approved()->create();
        $this->assertEquals($count, Platform::approved()->count());
    }
}
