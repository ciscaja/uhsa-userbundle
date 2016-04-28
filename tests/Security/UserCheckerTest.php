<?php

/*
 * This file is part of the Uhsa package.
 *
 * (c) Victor J. C. Geyer <victor@geyer.io>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ciscaja\Uhsa\UserBundle\Tests\Security;

use Ciscaja\Uhsa\UserBundle\Security\Exception\AccountDeletedException;
use Ciscaja\Uhsa\UserBundle\Security\Exception\AccountDisabledException;
use Ciscaja\Uhsa\UserBundle\Security\UserChecker;

class UserCheckerTest extends \PHPUnit_Framework_TestCase
{
    protected static function getUserChecker()
    {
        return new UserChecker;
    }

    public function testAccountDeleted()
    {
        $this->expectException(AccountDeletedException::class);
        $user = $this
            ->getMockBuilder('Ciscaja\Uhsa\UserBundle\Model\User')
            ->getMock();
        $user->expects($this->any())
            ->method('isDeleted')
            ->will($this->returnValue(true));

        $user->expects($this->any())
            ->method('isDisabled')
            ->will($this->returnValue(false));

        $user_checker = new UserChecker;

        $user_checker->checkPreAuth($user);

    }
}
