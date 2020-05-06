<?php

namespace App\Video\Interfaces;

use App\Entity\Video;

interface SaveVideoInterface
{
    /**
     * @param $videoURL
     *
     * @return Video
     */
    public function saveVideo($videoURL);
}
