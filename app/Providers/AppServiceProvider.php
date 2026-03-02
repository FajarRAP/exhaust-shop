<?php

namespace App\Providers;

use App\Http\Controllers\ProductController;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Support\Facades\Storage;
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
        $this->app
            ->when(ProductController::class)
            ->needs(Filesystem::class)
            ->give(fn() => Storage::disk('public'));
    }
}
