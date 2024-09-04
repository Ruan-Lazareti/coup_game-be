<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * O caminho para o diretório de rotas.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Registre os serviços de roteamento da aplicação.
     *
     * @return void
     */
    public function boot()
    {
        // Registrar as rotas da API
        Route::prefix('api')
            ->middleware('api')
            ->namespace($this->namespace)
            ->group(base_path('routes/api.php'));

        // Registrar as rotas web
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/web.php'));
    }

    /**
     * Registre os serviços de rota da aplicação.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
