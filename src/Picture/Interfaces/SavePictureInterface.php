<?php

namespace App\Picture\Interfaces;

use App\Entity\Picture;

interface SavePictureInterface
{
    /**
     * @param $file
     * @param $upload_directory
     * @return Picture
     */
    public function saveFrontPicture($file, $upload_directory);

    /**
     * @param $pictureForm
     * @param $upload_directory
     * @return Picture
     */
    public function savePicture($pictureForm, $upload_directory);

    /**
     * @param $file
     * @param $temp_directory
     * @param $upload_directory
     * @param $user
     * @return Picture
     */
    public function saveAccountPicture($file, $temp_directory, $upload_directory, $user);
}