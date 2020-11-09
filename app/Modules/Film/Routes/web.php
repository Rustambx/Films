<?php
Route::group([
    'middleware' => ['web', 'auth'],
    'prefix' => 'films',
    'namespace' => 'App\Modules\Film\Controllers'
], function () {
    Route::get('/', 'FilmController@index')->name('film');
    Route::get('/create', 'FilmController@create')->name('film.create');
    Route::post('/store', 'FilmController@store')->name('film.store');
    Route::get('/edit/{film}', 'FilmController@edit')->name('film.edit');
    Route::post('/update/{film}', 'FilmController@update')->name('film.update');
    Route::delete('/delete/{film}', 'FilmController@delete')->name('film.delete');
});

Route::group([
    'middleware' => ['web', 'auth'],
    'prefix' => 'genres',
    'namespace' => 'App\Modules\Film\Controllers'
], function () {
    Route::get('/', 'GenreController@index')->name('genre');
    Route::get('/create', 'GenreController@create')->name('genre.create');
    Route::post('/store', 'GenreController@store')->name('genre.store');
    Route::get('/edit/{genre}', 'GenreController@edit')->name('genre.edit');
    Route::post('/update/{genre}', 'GenreController@update')->name('genre.update');
    Route::delete('/delete/{genre}', 'GenreController@delete')->name('genre.delete');
});
