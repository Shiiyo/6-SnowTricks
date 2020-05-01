<?php

namespace App;

use App\Entity\Video;

class SaveVideo
{
    public function saveVideo($videoURL)
    {
        $video = new Video();
        $hostTemplate = new VideoHostTemplate();

        $hostName = $hostTemplate->getHostName($videoURL);
        $video->setHostName($hostName);

        $videoName = $hostTemplate->getVideoName($videoURL, $hostName);
        $video->setName($videoName);
        return $video;
    }
}