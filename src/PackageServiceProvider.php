<?php

namespace IbrahimHalilUcan\Keygen;

use Illuminate\Support\ServiceProvider;

/**
 * Class PackageServiceProvider
 */
class PackageServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind('keygen', Keygen::class);
        $this->mergeConfigFrom(__DIR__ . './../config/keygen-config.php', 'keygen-config');
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->configurePublishing();
    }

    /**
     * Configure publishing for the package.
     *
     * @return void
     */
    protected function configurePublishing(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([__DIR__ . './../config/keygen-config.php' => config_path('keygen-config.php')],
                'keygen-config');
        }
    }
}
