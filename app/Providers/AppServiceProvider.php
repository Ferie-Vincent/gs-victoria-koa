<?php

namespace App\Providers;

use App\View\Composers\AdminComposer;
use App\View\Composers\FrontComposer;
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
        View::composer('layouts.admin', AdminComposer::class);
        View::composer('*', FrontComposer::class);
    }
}
