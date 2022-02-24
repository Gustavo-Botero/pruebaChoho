<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'App\Repositories\Contracts\Modulos\Producto\ProductoRepositoryInterface',
            'App\Repositories\Modulos\Producto\ProductoRepository'
        );

        $this->app->bind(
            'App\Repositories\Contracts\Modulos\Asesor\AsesorRepositoryInterface',
            'App\Repositories\Modulos\Asesor\AsesorRepository'
        );

        $this->app->bind(
            'App\Repositories\Contracts\Modulos\Cliente\ClienteRepositoryInterface',
            'App\Repositories\Modulos\Cliente\ClienteRepository'
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
