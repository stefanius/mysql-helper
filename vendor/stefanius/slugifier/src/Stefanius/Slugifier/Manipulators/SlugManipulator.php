<?php

namespace Stefanius\Slugifier\Manipulators;

use Stefanius\Manipulation\Manipulators\AbstractStringManipulator;

class SlugManipulator extends AbstractStringManipulator
{
    /**
     * @param $string
     *
     * @return string
     */
    protected function run($string)
    {
        $string = iconv('UTF-8', 'ASCII//TRANSLIT', $string);
        $string = trim($string);
        $string = preg_replace("/[^a-zA-Z0-9_| -]/", ' ', $string);
        $string = preg_replace("/[| -]+/", '-', $string);
        $string = strtolower(trim($string, '-'));
        $string = preg_replace('/-{2,}/', ' ', $string);

        return $string;
    }
}
