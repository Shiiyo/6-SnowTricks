<?php

namespace App\Picture;

use App\Entity\Picture;
use App\Picture\Interfaces\SavePictureInterface;

class SavePicture implements SavePictureInterface
{
    public function saveFrontPicture($frontPicture, $upload_directory)
    {
        $file = $frontPicture->get('file')->getData();
        $typeMime = $file->guessExtension();
        $fileName = md5(uniqid());
        $fullName = $fileName.'.'.$typeMime;
        $file->move($upload_directory, $fullName);

        //Minified picture
        $mini = new MinifiedPicture();
        $mini->minified($fileName, $typeMime, $upload_directory);

        $picture = new Picture();
        $picture->setFile($fullName);

        return $picture;
    }

    public function savePicture($pictureForm, $upload_directory)
    {
        $file = $pictureForm->get('file')->getData();
        $fileName = md5(uniqid()).'.'.$file->guessExtension();

        $picture = new Picture();
        $picture->setFile($fileName);
        $file->move($upload_directory, $fileName);

        return $picture;
    }

    public function saveAccountPicture($file, $temp_directory, $upload_directory, $user)
    {
        //Temporary save the original picture
        $name = $file->getClientOriginalName();
        $mimeType = $file->guessExtension();
        $file->move($temp_directory, $name);

        //Square profile picture
        $square = new SquareProfilePicture();
        $newFile = $square->squarePicture($mimeType, $temp_directory.'/'.$name, $upload_directory);
        unlink($temp_directory.'/'.$name);

        //Create minified picture
        $mini = new MinifiedPicture();
        $mini->minified($newFile, $mimeType, $upload_directory);

        //Save Profile Picture
        $profilePicture = new Picture();
        $profilePicture->setFile($newFile.'.'.$mimeType);
        $profilePicture->setUser($user);

        return $profilePicture;
    }
}
