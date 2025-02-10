<?php

namespace App\Providers;

use App\Models\Position;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

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
    public function boot(): void
    {
        view()->composer('admin.*', function ($view) {
            $page = request()->query('page', 1);
            $perPage = ($page == 1) ? 5 : 6;
            $users = User::whereIn('role', ['user'])->latest('created_at')->paginate($perPage);
            $managers = User::whereIn('role', ['admin', 'superadmin'])->latest('created_at')->paginate($perPage);
            $positions = Position::all();
            return $view->with(compact('users', 'managers', 'positions'));
        });

        view()->composer('*', function ($view) {
            $loginUser = Auth::user();
            $usersCount = User::all()->count();
            return $view->with(compact('loginUser', 'usersCount'));
        });
    }
}
