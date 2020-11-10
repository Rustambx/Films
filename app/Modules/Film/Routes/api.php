<?php
Route::group([
    'middleware' => 'auth:api',
    'prefix' => 'api',
    'namespace' => 'App\Modules\Film\Controllers',
], function () {

    Route::get('film/{id}', 'ApiController@getFilmId');
    Route::get('genres', 'ApiController@getGenres');

    Route::post('genre/create', 'ApiController@createGenre');
    Route::post('genre/update/{id}', 'ApiController@updateGenre');
    Route::post('genre/delete/{id}', 'ApiController@deleteGenre');

    Route::post('get/films', 'ApiController@getFilms');
    Route::post('film/create', 'ApiController@createFilm');
    Route::post('film/update/{id}', 'ApiController@updateFilm');
    Route::post('film/delete/{id}', 'ApiController@deleteFilm');


});
