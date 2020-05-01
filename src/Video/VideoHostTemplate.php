<?php

namespace App;

class VideoHostTemplate
{
    private $hosts = [
        [
            'host' => 'youtube',
            'regex' => "%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^\"&?/ ]{11})%i",
            'url' => 'https://www.youtube.com/embed/',
        ],
        [
            'host' => 'dailymotion',
            'regex' => "/video\/([^_]+)/",
            'url' => 'https://www.dailymotion.com/embed/video/',
        ],
        [
            'host' => 'vimeo',
            'regex' => '%^https?:\/\/(?:www\.|player\.)?vimeo.com\/(?:channels\/(?:\w+\/)?|groups\/([^\/]*)\/videos\/|album\/(\d+)\/video\/|video\/|)(\d+)(?:$|\/|\?)(?:[?]?.*)$%im',
            'url' => 'https://player.vimeo.com/video/',
        ], ];

    public function getHostTemplate($hostName, $name)
    {
        foreach ($this->hosts as $host) {
            foreach ($host as $key => $value) {
                if ('host' == $key and $value == $hostName) {
                    return $host['url'].$name;
                }
            }
        }

        return false;
    }

    public function getHostName($url)
    {
        foreach ($this->hosts as $host) {
            foreach ($host as $key => $value) {
                if ('host' == $key) {
                    $result = preg_match('#'.$value.'#', $url);
                    if (true == $result) {
                        return $value;
                    }
                }
            }
        }

        return false;
    }

    public function getVideoName($url, $hostName)
    {
        foreach ($this->hosts as $host) {
            foreach ($host as $key => $value) {
                if ($host['host'] == $hostName) {
                    if ('regex' == $key) {
                        preg_match($value, $url, $match);
                        switch ($host['host']) {
                            case 'youtube':
                                return $match[1];
                                break;
                            case 'dailymotion':
                                return $match[1];
                                break;
                            case 'vimeo':
                                return $match[3];
                                break;
                        }
                    }
                }
            }
        }

        return false;
    }
}
