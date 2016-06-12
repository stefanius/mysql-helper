<?php

namespace Tests\Stefanius\Slugifier\Manipulators;

use Stefanius\Slugifier\Manipulators\SlugManipulator;

class SlugManipulatorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider provider
     */
    public function testSlugManipulator($string, $expected) {
        $manipulator = new SlugManipulator();

        $result = $manipulator->manipulate($string);

        $this->assertEquals($expected, $result);
    }

    /**
     * @return array
     */
    public function provider() {
        return [
            ["The Black Lazy Brown Fox!", "the-black-lazy-brown-fox"],
            ["http://www.stefanius.nl", "http-www-stefanius-nl"],
            ["my-fake-email@domain.com", "my-fake-email-domain-com"],
        ];
    }
}
