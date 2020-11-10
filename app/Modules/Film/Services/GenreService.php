<?php

namespace App\Modules\Film\Services;

use App\Modules\Film\Models\Genre;
use App\Modules\Film\Requests\GenreRequest;

class GenreService
{
    public function create (GenreRequest $request)
{
    $data = $request->except('_token');
    if (Genre::create($data)) {
        return ['status' => 'Жанр добавлен'];
    } else {
        return ['error' => 'Ошибка при сохранении'];
    }
}

    public function update (GenreRequest $request, Genre $genre)
    {
        $data = $request->except('_token');
        if ($genre->update($data)) {
            return ['status' => 'Жанр обновлен'];
        } else {
            return ['error' => 'Ошибка при сохранении'];
        }
    }

    public function delete (Genre $genre)
    {
        if ($genre->delete()) {
            return ['status' => 'Жанр удален'];
        } else {
            return ['error' => 'Ошибка при удалении'];
        }
    }

    public function createApi (GenreRequest $request)
    {
        $data = $request->except('_token');
        if (Genre::create($data)) {
            return ['status' => 'Жанр добавлен'];
        } else {
            return ['error' => 'Ошибка при сохранении'];
        }
    }

    public function updateApi (GenreRequest $request, $id)
    {
        $genre = Genre::find($id);
        $data = $request->except('_token');
        if ($genre->update($data)) {
            return ['status' => 'Жанр обновлен'];
        } else {
            return ['error' => 'Ошибка при сохранении'];
        }
    }

    public function deleteApi ($id)
    {
        $genre = Genre::find($id);
        if ($genre->delete()) {
            return ['status' => 'Жанр удален'];
        } else {
            return ['error' => 'Ошибка при удалении'];
        }
    }
}
