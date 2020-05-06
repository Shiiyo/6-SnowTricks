<?php

namespace App\Picture;

use App\Entity\Picture;
use App\Picture\Interfaces\MinifiedPictureInterface;

class MinifiedPicture implements MinifiedPictureInterface
{
    //Create miniature picture
    public function minified($originalPicture, $mimeType, $upload_directory)
    {
        $percent = 0.5;
        $path = $upload_directory.'/'.$originalPicture.'.'.$mimeType;
        list($width, $height) = getimagesize($path);
        $newWidth = $width * $percent;
        $newHeight = $height * $percent;

        $newPicture = imagecreatetruecolor($newWidth, $newHeight);

        //Create image in function on the mimeType
        $mimeTypeImage = new MimeTypeImage();
        $source = $mimeTypeImage->createImageWithMimeType($mimeType, $path);

        imagecopyresized($newPicture, $source, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

        $newPath = $upload_directory.'/'.$originalPicture.'_mini.'.$mimeType;

        //Create a file from the picture given
        $mimeTypeImage->createFileFromPicture($mimeType, $newPicture, $newPath);

        return true;
    }

    //Get miniature picture name
    public function getMiniFileName(Picture $picture)
    {
        $file = $picture->getFile();
        $extension = pathinfo($file, PATHINFO_EXTENSION);
        $without_extension = substr($file, 0, strrpos($file, '.'));
        $miniFileName = $without_extension.'_mini'.'.'.$extension;

        return $miniFileName;
    }
}
