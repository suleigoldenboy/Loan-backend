<?php

namespace App\Providers;

use Illuminate\Routing\Router;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;
use Symfony\Component\Finder\Finder;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * The path to the "home" route for your application.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map(Router $router)
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();
        $this->mapModelRoutes($router);
        //
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/web.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
            ->middleware('api')
            ->namespace($this->namespace)
            ->group(base_path('routes/api.php'));
    }

    protected function mapModelRoutes(Router $router)
    {
        $router->group($this->getDefaultGroup(), function ($router) {
            $this->requireWebRoutes($router);
        });
    }

    /**
     * Returns the Default Group for Routes.
     *
     * @return array
     */
    protected function getDefaultGroup()
    {
        return [
            'namespace' => $this->namespace,
            'middleware' => 'web'
        ];
    }

    /**
     * Requires all of the Files for Web Routes.
     *
     * @param  \Illuminate\Routing\Router  $router
     *
     * @return void
     */
    protected function requireWebRoutes(Router $router)
    {
        $files = Finder::create()
                ->in(base_path('routes/Models'))
                ->name('*.php');
        $this->require($files);
    }

    /**
     * Requires the specified Files.
     *
     * @param  array  $files  The specified Files.
     *
     * @return void
     */
    protected function require($files)
    {
        foreach($files as $file)
            require $file->getRealPath();
    }

}
