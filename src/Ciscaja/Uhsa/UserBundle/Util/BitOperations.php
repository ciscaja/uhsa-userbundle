<?php

/*
 * This file is part of the Uhsa package.
 *
 * (c) Victor J. C. Geyer <victor@geyer.io>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ciscaja\Uhsa\UserBundle\Util;

trait BitOperations
{
    /**
     * @param int $bitfield
     * @param int $bitmask
     *
     * @return bool
     */
    protected function isFlagSet(&$bitfield, &$bitmask)
    {
        return (($bitfield & $bitmask) == $bitmask);
    }

    /**
     * @param int  $bitfield
     * @param int  $bitmask
     * @param bool $enable
     */
    protected function setFlag(&$bitfield, &$bitmask, $enable)
    {
        if ($enable === true) {
            $bitfield |= $bitmask;
        } else {
            $bitfield &= ~$bitmask;
        }
    }
}