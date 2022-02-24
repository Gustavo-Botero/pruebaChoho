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

        $this->app->bind(
            'App\Repositories\Contracts\Modulos\Factura\FacturaRepositoryInterface',
            'App\Repositories\Modulos\Factura\FacturaRepository'
        );

        $this->app->bind(
            'App\Repositories\Contracts\Modulos\Factura\FacturaRepositoryInterface',
            'App\Repositories\Modulos\Factura\FacturaRepository'
        );

        $this->app->bind(
            'App\Repositories\Contracts\Modulos\DetallePedido\DetallePedidoRepositoryInterface',
            'App\Repositories\Modulos\DetallePedido\DetallePedidoRepository'
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
