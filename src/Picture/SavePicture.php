<?php

namespace App\Picture;

class SavePicture
{
    public function savePicture($picture)
    {
        if (null !== $picture) {
            $file = $picture->getData();
/*            $fileName = md5(uniqid()).'.'.$file->guessExtension();
            $file->move('public/uploads', $fileName);
            return $fileName;*/
            return $file;
        } else {
            return false;
        }
    }
}