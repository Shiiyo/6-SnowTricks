<?php

namespace App;

class MinifiedPicture
{
    public function minified($originalPicture)
    {
        $percent = 0.5;
        list($width, $height) = getimagesize($originalPicture);
        $newWidth = $width * $percent;
        $newHeight = $height * $percent;

        $newPicture = imagecreatetruecolor($newWidth, $newHeight);
        $source = imagecreatefromjpeg($originalPicture);

        imagecopyresized($newPicture, $source, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

        return $newPicture;
    }
}