<?php

namespace App\Picture;

class MimeTypeImage implements MimeTypeImageInterface
{
    public function createImageWithMimeType($mimeType, $path)
    {
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

        return $source;
    }

    public function createFileFromPicture($mimeType, $newPicture, $newPath)
    {
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
}