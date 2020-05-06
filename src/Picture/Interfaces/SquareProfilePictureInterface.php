<?php

namespace App\Picture\Interfaces;

interface SquareProfilePictureInterface
{
    /**
     * @param $mimeType
     * @param $path
     * @param $upload_directory
     *
     * @return bool|string
     */
    public function squarePicture($mimeType, $path, $upload_directory);
}
