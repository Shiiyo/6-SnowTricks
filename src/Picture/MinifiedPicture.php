<?php

namespace App\Picture;

use App\Entity\Picture;

class MinifiedPicture
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
        switch ($mimeType) {
            case 'jpeg':
                $source = imagecreatefromjpeg($path);
                break;

            case 'png':
                $source = imagecreatefrompng($path);
                break;

            case 'gif':
                $source = imagecreatefromgif($path);
                break;

            default:
                return false;
        }

        imagecopyresized($newPicture, $source, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

        $newPath = $upload_directory.'/'.$originalPicture.'_mini.'.$mimeType;

        //Create a file from the picture given
        switch ($mimeType) {
            case 'jpeg':
                imagejpeg($newPicture, $newPath);
                break;

            case 'png':
                imagepng($newPicture, $newPath);
                break;

            case 'gif':
                imagegif($newPicture, $newPath);
                break;

            default:
                return false;
        }

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
