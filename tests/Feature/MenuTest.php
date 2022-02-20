<?php

namespace Dealskoo\Platform\Tests\Feature;

use Dealskoo\Admin\Facades\AdminMenu;
use Dealskoo\Platform\Tests\TestCase;
use Dealskoo\Seller\Facades\SellerMenu;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MenuTest extends TestCase
{
    use RefreshDatabase;

    public function test_menu()
    {
        $this->assertNotNull(AdminMenu::findBy('title', 'platform::platform.platforms'));
        $this->assertNotNull(SellerMenu::findBy('title', 'platform::platform.platforms'));
    }
}
