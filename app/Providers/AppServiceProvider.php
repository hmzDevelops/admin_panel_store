<?php

namespace App\Providers;

use App\Models\Notification;
use App\Models\Content\Comment;
use Illuminate\Support\Facades\Blade;
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
        //متغیر عمومی uncseenComments جهت دسترسی در کل برنامه
        view()->composer('admin.layouts.header', function($view){
            $view->with('unseenComments', Comment::where('seen', 0)->get());
            $view->with('notifications', Notification::where('read_at', null)->get());
        });

        //my custom component
        Blade::component('package-loading',Loading::class);
    }
}
