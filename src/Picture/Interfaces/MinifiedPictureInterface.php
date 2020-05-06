<?php

namespace App\Picture\Interfaces;

use App\Entity\Picture;

interface MinifiedPictureInterface
{
    /**
     * @param $originalPicture
     * @param $mimeType
     * @param $upload_directory
     *
     * @return true
     */
    public function minified($originalPicture, $mimeType, $upload_directory);

    /**
     * @return string
     */
    public function getMiniFileName(Picture $picture);
}
