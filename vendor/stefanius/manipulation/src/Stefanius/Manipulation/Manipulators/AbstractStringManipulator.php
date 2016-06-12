<?php

namespace Stefanius\Manipulation\Manipulators;

use Stefanius\Manipulation\Interfaces\ManipulatorInterface;

abstract class AbstractStringManipulator implements ManipulatorInterface
{
    /**
     * @param $input
     *
     * @return null|string
     *
     * @throws \InvalidArgumentException
     */
    public function manipulate($input)
    {
        if ($input === null) {
            return null;
        }

        if (!is_string($input)) {
            throw new \InvalidArgumentException("Expected string");
        }

        return $this->run($input);
    }

    /**
     * @param $string
     *
     * @return string
     */
    abstract protected function run($string);
} 