<?php

namespace App\Modules\Film\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Film\Models\Film;
use App\Modules\Film\Models\Genre;
use App\Modules\Film\Requests\FilmRequest;
use App\Modules\Resize\CImage;
use FilmService;

class FilmController extends Controller
{
    public function index ()
    {
        $films = Film::all();
        foreach ($films as $film) {
            $film->resized_image = CImage::resize($film->image, 100, 150);
        }

        $this->title('Фильмы');
        $this->view('film::index');
        return $this->render(compact('films'));
    }

    public function create ()
    {
        $genres = Genre::all();
        $this->title('Добавление фильмов');
        $this->view('film::create');

        return $this->render(compact('genres'));
    }

    public function store (FilmRequest $request)
    {
        $result = FilmService::create($request);

        if (is_array($result) && !empty($result['error'])) {
            return back()->with($result);
        } else {
            return redirect()->route('film')->with($result);
        }
    }

    public function edit (Film $film)
    {
        $film->resized_image = CImage::resize($film->image, 100, 150);
        $genres = Genre::all();
        $this->title('Редактирование Компании');
        $this->view('film::edit');

        return $this->render(compact('film', 'genres'));
    }

    public function update (FilmRequest $request, Film $film)
    {
        $result = FilmService::update($request, $film);

        if (is_array($result) && !empty($result['error'])) {
            return back()->with('error');
        } else {
            return redirect()->route('film')->with($result);
        }
    }

    public function delete (Film $film)
    {
        $result = FilmService::delete($film);

        if (is_array($result) && !empty($result['error'])) {
            return back()->with('error');
        } else {
            return redirect()->route('film')->with($result);
        }
    }
}
