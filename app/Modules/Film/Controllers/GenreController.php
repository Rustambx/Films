<?php

namespace App\Modules\Film\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Film\Models\Genre;
use App\Modules\Film\Requests\GenreRequest;
use GenreService;

class GenreController extends Controller
{
    public function index ()
    {
        $genres = Genre::all();

        $this->title('Жанры');
        $this->view('film::genre.index');
        return $this->render(compact('genres'));
    }

    public function create ()
    {
        $this->title('Добавление жанров');
        $this->view('film::genre.create');

        return $this->render();
    }

    public function store (GenreRequest $request)
    {
        $result = GenreService::create($request);

        if (is_array($result) && !empty($result['error'])) {
            return back()->with($result);
        } else {
            return redirect()->route('genre')->with($result);
        }
    }

    public function edit (Genre $genre)
    {
        $this->title('Редактирование жанров');
        $this->view('film::genre.edit');

        return $this->render(compact('genre'));
    }

    public function update (GenreRequest $request, Genre $genre)
    {
        $result = GenreService::update($request, $genre);

        if (is_array($result) && !empty($result['error'])) {
            return back()->with('error');
        } else {
            return redirect()->route('genre')->with($result);
        }
    }

    public function delete (Genre $genre)
    {
        $result = GenreService::delete($genre);

        if (is_array($result) && !empty($result['error'])) {
            return back()->with('error');
        } else {
            return redirect()->route('genre')->with($result);
        }
    }
}
