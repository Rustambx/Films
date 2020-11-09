<?php

namespace App\Modules\Film;

use App\Modules\Film\Services\FilmService;
use App\Modules\Film\Services\GenreService;
use Illuminate\Support\ServiceProvider as BaseProvider;
use function foo\func;

class ServiceProvider extends BaseProvider
{
    /**
     * @return void
     */
    public function boot(): void
    {
        $this->loadMigrationsFrom(__DIR__.'/Migrations');
        $this->loadRoutesFrom(__DIR__.'/Routes/web.php');
        $this->loadRoutesFrom(__DIR__.'/Routes/api.php');
        $this->loadViewsFrom(__DIR__.'/Views', 'film');
    }

    /**
     * @return void
     */
    public function register(): void
    {
        $this->app->singleton(FilmService::class, function () {
            return new FilmService();
        });

        $this->app->singleton(GenreService::class, function () {
            return new GenreService();
        });

        $this->app->alias(FilmService::class, 'filmService');
        $this->app->alias(GenreService::class, 'genreService');
    }
}
