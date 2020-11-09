<?php

namespace App\Modules\Film\Models;

use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    protected $fillable = [
        'name', 'description', 'image', 'release_date'
    ];

    public function genres ()
    {
        return $this->belongsToMany(Genre::class, 'films_genres');
    }

    protected static function boot()
    {
        parent::boot();
        /**
         * Удаление картинок и ресайзов
         */
        static::deleted (function ($model) {

            $realPath = storage_path().'/app/public/upload/images/'. $model->image;
            if (file_exists($realPath)) {
                if (preg_match('/(.*?)(\w+)\.(\w+)$/', $model->image, $matches)) {
                    $files = glob(storage_path().'/app/public/upload/images/' . $matches[1] . $matches[2] . '_resize_*');
                    if (is_array($files)) {
                        foreach ($files as $file) {
                            unlink($file);
                        }
                    }
                }
                unlink($realPath);

                if (preg_match('/^(\w+)\//', $model->image, $matches)) {
                    $dir = storage_path().'/app/public/upload/images/' . $matches[1];
                    if (!empty($dir)) {
                        rmdir($dir);
                    }
                }
            }

        });
    }
}
