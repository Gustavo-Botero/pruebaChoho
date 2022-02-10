<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class UseCaseServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'App\UseCases\Contracts\Modulos\Producto\CreateProductoInterface',
            'App\UseCases\Modulos\Producto\CreateProductoUseCase'
        );
        $this->app->bind(
            'App\UseCases\Contracts\Modulos\Producto\ShowProductoInterface',
            'App\UseCases\Modulos\Producto\ShowProductoUseCase'
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
