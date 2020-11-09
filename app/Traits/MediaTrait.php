<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;

trait MediaTrait
{
    private $imageType = [
        "image/jpeg",
        "image/png"
    ];

    public function checkImageMimeType ($image)
    {
        $mimeType = $image->getMimeType();
        if (in_array($mimeType, $this->imageType)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @param UploadedFile $file
     * @return \StdClass
     */
    protected function prepareFile(UploadedFile $file)
    {
        $preparedFile = new \StdClass;

        $parts = explode('.', $file->getClientOriginalName());
        $preparedFile->hash = md5($parts[0]);
        $preparedFile->name = md5($parts[0]).'.'.last($parts);

        $preparedFile->path = substr(md5(microtime()), mt_rand(0, 30), 5);

        return $preparedFile;
    }

    /**
     * @param UploadedFile $file
     * @return string
     */
    public function uploadImage(UploadedFile $file)
    {
        $upload = $this->prepareFile($file);

        $file->storeAs('public/upload/images/'.$upload->path, $upload->name);

        return $upload->path.'/'.$upload->name;
    }
}
