<?php

namespace App\Modules\Film\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Film\Models\Film;
use App\Modules\Film\Models\Genre;
use App\Modules\Film\Requests\FilmRequest;
use App\Modules\Film\Requests\GenreRequest;
use Illuminate\Http\Request;
use FilmService;
use GenreService;

class ApiController extends Controller
{
    public function getFilmId ($id)
    {
        $film = Film::find($id);

        return response()->json([
            'status' => 'Фильм успешно получен',
            'film' => $film
        ]);
    }

    public function getGenres ()
    {
        $genres = Genre::all();

        return response()->json([
            'status' => 'Жанры успешно получены',
            'genres' => $genres
        ]);
    }

    public function getFilms (Request $request)
    {
        $genres = Genre::where('name', $request->input('genres'))->first();
        $films = $genres->films()->orderBy('name', $request->input('order'))->paginate($request->input('paginate'));
        return response()->json([
            'status' => 'Фильмы успешно получены',
            'films' => $films
        ]);
    }

    public function createFilm (FilmRequest $request)
    {
        $result = FilmService::createApi($request);

        if (is_array($result) && !empty($result['error'])) {
            return response()->json([
                'Ошибка' => $result['error']
            ]);
        } else {
            return response()->json([
                'status' => $result,
            ]);
        }
    }

    public function updateFilm (FilmRequest $request, $id)
    {
        $result = FilmService::updateApi($request, $id);

        if (is_array($result) && !empty($result['error'])) {
            return response()->json([
                'Ошибка' => $result['error']
            ]);
        } else {
            return response()->json([
                'status' => $result,
            ]);
        }
    }

    public function deleteFilm ($id)
    {
        $result = FilmService::deleteApi($id);

        if (is_array($result) && !empty($result['error'])) {
            return response()->json([
                'Ошибка' => $result['error']
            ]);
        } else {
            return response()->json([
                'status' => $result,
            ]);
        }
    }

    /**    REST API  */
    public function createGenre (GenreRequest $request)
    {
        $result = GenreService::createApi($request);

        if (is_array($result) && !empty($result['error'])) {
            return response()->json([
                'Ошибка' => $result['error']
            ]);
        } else {
            return response()->json([
                'status' => $result,
            ]);
        }
    }

    public function updateGenre (GenreRequest $request, $id)
    {
        $result = GenreService::updateApi($request, $id);

        if (is_array($result) && !empty($result['error'])) {
            return response()->json([
                'Ошибка' => $result['error']
            ]);
        } else {
            return response()->json([
                'status' => $result,
            ]);
        }
    }

    public function deleteGenre ($id)
    {
        $result = GenreService::deleteApi($id);

        if (is_array($result) && !empty($result['error'])) {
            return response()->json([
                'Ошибка' => $result['error']
            ]);
        } else {
            return response()->json([
                'status' => $result,
            ]);
        }
    }
}
