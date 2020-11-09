<?php

namespace App\Modules\Film\Facades;

use Illuminate\Support\Facades\Facade;

class FilmFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     *
     * @throws \RuntimeException
     */
    protected static function getFacadeAccessor()
    {
        return 'filmService';
    }
}
