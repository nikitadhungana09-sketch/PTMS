<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\ActivityLog;

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
        View::composer('*', function ($view) {

            if (Auth::check()) {

                $notifications = ActivityLog::with('user')
                    ->latest()
                    ->take(5)
                    ->get();

                $view->with('notifications', $notifications);
                $view->with('notificationCount', $notifications->count());

            } else {

                $view->with('notifications', collect());
                $view->with('notificationCount', 0);

            }

        });
    }
}