<?php namespace Legacy;

use Illuminate\Support\ServiceProvider as LaravelServiceProvider;

class ServiceProvider extends LaravelServiceProvider
{
    private $config = __DIR__ . '/../../config/legacy.php';

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot() {
        $this->publishes([
            $this->config => config_path('legacy.php'),
        ]);

        $this->loadRoutesFrom(app_path('../routes/web.php'));
    }

    public function register() {
        $this->mergeConfigFrom(
            $this->config, 'legacy'
        );

        $this->app->singleton('legacy', function ($app) {
            return new Factory($app);
        });

        $this->registerIncludePath();
        $this->registerMiddlewares();
    }

    private function registerIncludePath(): void {
        $include_path = base_path(config('legacy.folder_name'));
        set_include_path(get_include_path() . PATH_SEPARATOR . $include_path);
    }

    private function registerMiddlewares(): void {
        $router = $this->app['router'];

        foreach (config('legacy.middlewares', []) as $midleware) {
            if (class_exists($midleware)) {
                $router->pushMiddlewareToGroup('legacy', $midleware);
            }
        }
    }
}
