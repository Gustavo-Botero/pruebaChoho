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

        $this->app->bind(
            'App\UseCases\Contracts\Modulos\Producto\DeleteProductoInterface',
            'App\UseCases\Modulos\Producto\DeleteProductoUseCase'
        );

        $this->app->bind(
            'App\UseCases\Contracts\Modulos\Producto\UpdateProductoInterface',
            'App\UseCases\Modulos\Producto\UpdateProductoUseCase'
        );

        $this->app->bind(
            'App\UseCases\Contracts\Modulos\Asesor\CreateAsesorInterface',
            'App\UseCases\Modulos\Asesor\CreateAsesorUseCase'
        );

        $this->app->bind(
            'App\UseCases\Contracts\Modulos\Asesor\ShowAsesorInterface',
            'App\UseCases\Modulos\Asesor\ShowAsesorUseCase'
        );

        $this->app->bind(
            'App\UseCases\Contracts\Modulos\Asesor\UpdateAsesorInterface',
            'App\UseCases\Modulos\Asesor\UpdateAsesorUseCase'
        );

        $this->app->bind(
            'App\UseCases\Contracts\Modulos\Asesor\DeleteAsesorInterface',
            'App\UseCases\Modulos\Asesor\DeleteAsesorUseCase'
        );

        $this->app->bind(
            'App\UseCases\Contracts\Modulos\Asesor\ShowClientsByAsesorInterface',
            'App\UseCases\Modulos\Asesor\ShowClientsByAsesorUseCase'
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
