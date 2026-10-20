<?php

namespace App\Providers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
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
        View::composer('layout', function ($view): void {
            $notifications = collect();
            $notificationCount = 0;

            if (Schema::hasTable('profiles') && Schema::hasTable('users')) {
                $pendingProfiles = DB::table('profiles')
                    ->where('verification_status', 'pending');

                $notificationCount = (clone $pendingProfiles)->count();
                $notifications = $pendingProfiles
                    ->leftJoin('users', 'users.id', '=', 'profiles.user_id')
                    ->select([
                        'profiles.id',
                        'profiles.profile_id',
                        'profiles.created_at',
                        'users.name as member_name',
                    ])
                    ->orderByDesc('profiles.id')
                    ->limit(7)
                    ->get();
            }

            $view->with([
                'adminNotifications' => $notifications,
                'adminNotificationCount' => $notificationCount,
            ]);
        });
    }
}
