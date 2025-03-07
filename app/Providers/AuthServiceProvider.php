<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        // $this->registerPolicies();

        // // Definir permisos generales basados en roles
        // Gate::define('admin', function (User $user) {
        //     return $user->role === 'admin';
        // });

        // Gate::define('publicador', function (User $user) {
        //     return in_array($user->role, ['admin', 'publicador']);
        // });

        // Gate::define('pasante', function (User $user) {
        //     return in_array($user->role, ['admin', 'publicador', 'pasante']);
        // });

        // // Permisos específicos de tasaciones
        // Gate::define('aprobar-tasaciones', function (User $user) {
        //     return in_array($user->role, ['admin', 'publicador']);
        // });

        // Gate::define('editar-tasaciones', function (User $user) {
        //     return in_array($user->role, ['admin', 'publicador', 'pasante']);
        // });

        // Gate::define('eliminar-tasaciones', function (User $user) {
        //     return in_array($user->role, ['admin', 'publicador']);
        // });
        // // Definir permisos para cada tipo de usuario
        // Gate::define('gestionar-usuarios', function (User $user) {
        //     return $user->role === 'admin';
        // });
    }
}
