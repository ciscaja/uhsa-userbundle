<?php

/*
 * This file is part of the Uhsa package.
 *
 * (c) Victor J. C. Geyer <victor@geyer.io>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ciscaja\Uhsa\UserBundle\Tests\Util;


class BitwiseFlagTest extends \PHPUnit_Framework_TestCase
{
    protected function getBitwiseFlag()
    {
        return $this->getMockForTrait('Ciscaja\Uhsa\UserBundle\Util\BitOperations');
    }

    /**
     * Call protected/private method of a class.
     *
     * @param object &$object    Instantiated object that we will run method on.
     * @param string $methodName Method name to call
     * @param array  $parameters Array of parameters to pass into method.
     *
     * @return mixed Method return.
     */
    protected function invokeMethod(&$object, $methodName, array $parameters = array())
    {
        $reflection = new \ReflectionClass(\get_class($object));
        $method = $reflection->getMethod($methodName);
        $method->setAccessible(true);

        return $method->invokeArgs($object, $parameters);
    }

    public function testSingleFlag()
    {
        $bitwise_flag = $this->getBitwiseFlag();

        $test_bitfield = 0;
        $test_bitmask = 64;

        $this->assertFalse($this->invokeMethod($bitwise_flag, 'isFlagSet', array(
            &$test_bitfield,
            $test_bitmask
        )));

        $this->invokeMethod($bitwise_flag, 'setFlag', array(
            &$test_bitfield,
            $test_bitmask,
            true
        ));
        $this->assertTrue($this->invokeMethod($bitwise_flag, 'isFlagSet', array(
            &$test_bitfield,
            $test_bitmask
        )));
    }

    /**
     * @see http://php.net/manual/de/language.types.integer.php
     */
    public function test31Flags()
    {
        $bitwise_flag = $this->getBitwiseFlag();

        $test_bitfield = 0;
        for ($run = 0; $run <= 30; ($run += 2)) {
            $bitmask = \pow(2, $run);
            $this->invokeMethod($bitwise_flag, 'setFlag', array(
                &$test_bitfield,
                $bitmask,
                true
            ));
        }

        for ($run = 0; $run <= 30; ++$run) {
            $bitmask = \pow(2, $run);
            if ($run % 2 == 0) {
                $this->assertTrue($this->invokeMethod($bitwise_flag, 'isFlagSet', array(
                    &$test_bitfield,
                    $bitmask
                )));
            } else {
                $this->assertFalse($this->invokeMethod($bitwise_flag, 'isFlagSet', array(
                    &$test_bitfield,
                    $bitmask
                )));
            }
        }
    }
}
