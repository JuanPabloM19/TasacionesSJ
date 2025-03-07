<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use App\Models\User;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        // Definir permisos generales basados en roles
        // Gate::define('admin', function (User $user) {
        //     return $user->role === 'admin';
        // });

        // Gate::define('publicador', function (User $user) {
        //     return in_array($user->role, ['admin', 'publicador']);
        // });

        // Gate::define('pasante', function (User $user) {
        //     return in_array($user->role, ['admin', 'publicador', 'pasante']);
        // });

        // Gate::define('gestionar-usuarios', function (User $user) {
        //     return $user->role === 'admin';
        // });

        // Gate::define('aprobar-tasaciones', function ($user) {
        //     return $user->role === 'admin' || $user->role === 'publicador';
        // });

        // Gate::define('editar-tasaciones', function ($user) {
        //     return $user->role === 'admin' || $user->role === 'publicador' || $user->role === 'pasante';
        // });

        // Gate::define('eliminar-tasaciones', function ($user) {
        //     return $user->role === 'admin' || $user->role === 'publicador';
        // });
    }
}
