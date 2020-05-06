<?php

namespace App\Video\Interfaces;

interface VideoHostTemplateInterface
{
    /**
     * @param $hostName
     * @param $name
     *
     * @return mixed
     */
    public function getHostTemplate($hostName, $name);

    /**
     * @param $url
     *
     * @return mixed
     */
    public function getHostName($url);

    /**
     * @param $url
     * @param $hostName
     *
     * @return mixed
     */
    public function getVideoName($url, $hostName);
}
