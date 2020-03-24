<?php

namespace App;

class SlugCreator
{
    public function slugify($string, $delimiter = '-')
    {
        $clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $string);
        $clean = strtolower($clean);
        $clean = preg_replace("/[\/_|+ -]+/", $delimiter, $clean);
        $clean = trim($clean, $delimiter);

        return $clean;
    }
}
