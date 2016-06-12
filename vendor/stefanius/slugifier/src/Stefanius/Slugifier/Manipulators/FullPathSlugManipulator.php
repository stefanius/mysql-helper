<?php

namespace Stefanius\Slugifier\Manipulators;

use Stefanius\Manipulation\Manipulators\AbstractStringManipulator;

class FullPathSlugManipulator extends AbstractStringManipulator
{
    /**
     * @var AbstractStringManipulator
     */
    protected $slugManipulator;

    /**
     * @param AbstractStringManipulator $manipulator
     */
    function __construct(AbstractStringManipulator $manipulator)
    {
        $this->slugManipulator = $manipulator;
    }

    /**
     * @param $string
     *
     * @return string
     */
    protected function run($string)
    {
        $string = trim($string);
        $string = trim($string, '/');
        $parts = explode('/', $string);

        foreach ($parts as $key => $value) {
            $parts[$key] = $this->slugManipulator->manipulate($value);
        }

        return implode('/', $parts);
    }
}
