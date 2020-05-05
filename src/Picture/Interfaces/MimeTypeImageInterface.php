<?php

namespace App\Picture\Interfaces;

interface MimeTypeImageInterface
{
    /**
     * @param $mimeType
     * @param $path
     * @return mixed
     */
    public function createImageWithMimeType($mimeType, $path);

    /**
     * @param $mimeType
     * @param $newPicture
     * @param $newPath
     * @return mixed
     */
    public function createFileFromPicture($mimeType, $newPicture, $newPath);
}