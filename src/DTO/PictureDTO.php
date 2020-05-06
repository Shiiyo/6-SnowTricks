<?php

namespace App\DTO;

use Symfony\Component\HttpFoundation\File\UploadedFile;

class PictureDTO
{
    public $picture;

    public function __construct(?UploadedFile $picture)
    {
        $this->picture = $picture;
    }
}
