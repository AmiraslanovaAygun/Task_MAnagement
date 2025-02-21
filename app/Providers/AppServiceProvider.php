<?php

namespace App\Providers;

use App\Models\Position;
use App\Models\Project;
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
            $users = User::whereIn('role', ['user'])->latest('created_at')->paginate(11);
            $managers = User::whereIn('role', ['admin', 'superadmin'])->latest('created_at')->paginate(5);
            $positions = Position::all();
            $projects = Project::with('tasks')->latest('created_at')->paginate(11);
            return $view->with(compact('users', 'managers', 'positions', 'projects'));
        });

        view()->composer('*', function ($view) {
            $loginUser = Auth::user();
            $usersCount = User::all()->count();

            return $view->with(compact('loginUser', 'usersCount'));
        });
    }
}
