<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use App\Http\View\Composer\CodeComposer;
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
        //Widok Composera
        View::composer('codes.index', CodeComposer::class);
    }
}
