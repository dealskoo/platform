<?php

namespace Dealskoo\Platform\Providers;

use Dealskoo\Admin\Facades\AdminMenu;
use Dealskoo\Admin\Facades\PermissionManager;
use Dealskoo\Admin\Permission;
use Illuminate\Support\ServiceProvider;

class PlatformServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../../config/platform.php', 'platform');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');

            $this->publishes([
                __DIR__ . '/../../config/platform.php' => config_path('platform.php')
            ], 'config');

            $this->publishes([
                __DIR__ . '/../../resources/lang' => resource_path('lang/vendor/platform')
            ], 'lang');
        }

        $this->loadRoutesFrom(__DIR__ . '/../../routes/admin.php');
        $this->loadRoutesFrom(__DIR__ . '/../../routes/seller.php');

        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'platform');

        $this->loadTranslationsFrom(__DIR__ . '/../../resources/lang', 'platform');

        AdminMenu::route('admin.platforms.index', 'platform::platform.platforms', [], ['icon' => 'uil-cell', 'permission' => 'platforms.index'])->order(8);

        PermissionManager::add(new Permission('platforms.index', 'Platform Lists'));
        PermissionManager::add(new Permission('platforms.show', 'View Platform'), 'platforms.index');
        PermissionManager::add(new Permission('platforms.edit', 'Edit Platform'), 'platforms.index');
        PermissionManager::add(new Permission('platforms.destroy', 'Destroy Platform'), 'platforms.index');
    }
}
