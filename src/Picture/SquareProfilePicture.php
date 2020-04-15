<?php

namespace App\Picture;

use App\Entity\Picture;

class SquareProfilePicture
{
    //Change the given picture into a square picture
    public function squarePicture($mimeType, $path, $upload_directory)
    {
        //Create image in function on the mimeType
        switch ($mimeType)
        {
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

        $crop_width = imagesx($source);
        $crop_height = imagesy($source);
        $size = min($crop_width, $crop_height);
        if($crop_width >= $crop_height) {
            $newx= ($crop_width-$crop_height)/2;

            $im2 = imagecrop($source, ['x' => $newx, 'y' => 0, 'width' => $size, 'height' => $size]);
        }
        else {
            $newy= ($crop_height-$crop_width)/2;

            $im2 = imagecrop($source, ['x' => 0, 'y' => $newy, 'width' => $size, 'height' => $size]);
        }

        $fileName = md5(uniqid());
        $newPath = $upload_directory.'/'.$fileName.'.'.$mimeType;

        //Create a file from the picture given
        switch ($mimeType)
        {
            case 'jpeg':
                imagejpeg($im2, $newPath);
                break;

            case 'png':
                imagepng($im2, $newPath);
                break;

            case 'gif':
                imagegif($im2, $newPath);
                break;

            default:
                return false;
        }
        return $fileName;
    }
}