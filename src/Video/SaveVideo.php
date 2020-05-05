<?php

namespace App;

use App\Entity\Video;
use App\Video\Interfaces\SaveVideoInterface;

class SaveVideo implements SaveVideoInterface
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