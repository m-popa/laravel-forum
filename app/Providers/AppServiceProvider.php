<?php

namespace App\Providers;

use Filament\Support\Colors\Color;
use Filament\Support\Facades\FilamentColor;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Model::automaticallyEagerLoadRelationships();
    }

    /**
     * Register any application services.
     */
    public function register(): void
    {
        FilamentColor::register([
            'danger' => Color::Rose,
            'gray' => Color::Gray,
            'info' => Color::Blue,
            'primary' => Color::Zinc,
            'success' => Color::Emerald,
            'warning' => Color::Orange,
        ]);
    }
}
