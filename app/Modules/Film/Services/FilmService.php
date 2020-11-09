<?php

namespace App\Modules\Film\Services;

use App\Modules\Film\Models\Film;
use App\Modules\Film\Models\Genre;
use App\Modules\Film\Requests\FilmRequest;
use App\Traits\MediaTrait;

class FilmService
{
    use MediaTrait;

    public function create (FilmRequest $request)
    {
        $data = $request->except('_token', 'genres', 'image');
        $image = $request->file('image');
        $genres = $request->input('genres');
        if ($this->checkImageMimeType($image)) {
            $data['image'] = $this->uploadImage($image);
        } else {
            return ['error' => 'Доступны только jpg и png форматы изображений'];
        }
        $film = Film::create($data);
        if ($genres) {
            $film->genres()->attach($genres);
        }

        return ['status' => 'Фильм добавлен'];

    }

    public function update (FilmRequest $request, Film $film)
    {
        $data = $request->only(['name', 'release_date', 'description']);
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            if ($this->checkImageMimeType($image)) {
                $data['image'] = $this->uploadImage($image);
            } else {
                return ['error' => 'Доступны только jpg и png форматы изображений'];
            }
            $data['image'] = $this->uploadImage($image);
            $realPath = storage_path() . '/app/public/upload/images/' . $film->image;
            if (file_exists($realPath)) {
                if (preg_match('/(.*?)(\w+)\.(\w+)$/', $film->image, $matches)) {
                    $files = glob(storage_path() . '/app/public/upload/images/' . $matches[1] . $matches[2] . '_resize_*');
                    if (is_array($files)) {
                        foreach ($files as $file) {
                            unlink($file);
                        }
                    }
                    unlink($realPath);
                }


                if (preg_match('/^(\w+)\//', $film->image, $matches)) {
                    $dir = storage_path() . '/app/public/upload/images/' . $matches[1];
                    if (!empty($dir)) {
                        rmdir($dir);
                    }
                }
            }
        }

        if ($film->update($data)) {
            if ($request->input('genres')) {
                $genres = $request->input('genres');
                if ($genres) {
                    $film->genres()->sync($genres);
                }
            }
        } else {
            return ['error' => 'Ошибка при сохранении'];
        }

        return ['status' => 'Фильм обновлен'];

    }

    public function delete (Film $film)
    {
        $film->genres()->detach();
        if ($film->delete()) {
            return ['status' => 'Фильм удален'];
        } else {
            return ['error' => 'Ошибка при удалении'];
        }
    }

    public function createApi (FilmRequest $request)
    {
        $genre = Genre::where('name', $request->input('genres'))->get();
        $data = $request->except('_token', 'genres', 'image');
        $image = $request->file('image');

        if ($this->checkImageMimeType($image)) {
            $data['image'] = $this->uploadImage($image);
        } else {
            return ['error' => 'Доступны только jpg и png форматы изображений'];
        }
        $film = Film::create($data);
        if ($genre) {
            $film->genres()->attach($genre);
        }

        return ['status' => 'Фильм добавлен'];
    }

    public function updateApi (FilmRequest $request, $id)
    {
        $genre = Genre::where('name', $request->input('genres'))->get();
        $film = Film::find($id);
        $data = $request->only(['name', 'release_date', 'description']);
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            if ($this->checkImageMimeType($image)) {
                $data['image'] = $this->uploadImage($image);
            } else {
                return ['error' => 'Доступны только jpg и png форматы изображений'];
            }
            $data['image'] = $this->uploadImage($image);
        }

        if ($film->update($data)) {
            if ($genre) {
                $film->genres()->sync($genre);
            }
        } else {
            return ['error' => 'Ошибка при сохранении'];
        }

        return ['status' => 'Фильм обновлен'];
    }

    public function deleteApi ($id)
    {
        $film = Film::find($id);
        $film->genres()->detach();
        if ($film->delete()) {
            return ['status' => 'Фильм удален'];
        } else {
            return ['error' => 'Ошибка при удалении'];
        }
    }
}
