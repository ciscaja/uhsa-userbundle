<?php

/*
 * This file is part of the Uhsa package.
 *
 * (c) Victor J. C. Geyer <victor@geyer.io>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ciscaja\Uhsa\UserBundle\Tests\Model;

use Ciscaja\Uhsa\UserBundle\Model\User;

class UserTest extends \PHPUnit_Framework_TestCase
{
    public static function getUser()
    {
        return new User();
    }

    public function testUsername()
    {
        $user = self::getUser();
        $this->assertNull($user->getUsername());

        $user->setUsername('username');
        $this->assertEquals('username', $user->getUsername());
    }

    public function testSetUsernameReturn()
    {
        $user = self::getUser();

        $this->assertSame($user->setUsername('username'), $user);
    }

    public function testSalt()
    {
        $user = self::getUser();
        $this->assertNotEmpty($user->getSalt());
    }

    public function testPassword()
    {
        $user = self::getUser();
        $this->assertNull($user->getPassword());

        $user->setPassword('password');
        $this->assertEquals('password', $user->getPassword());
    }

    public function testSetPasswordReturn()
    {
        $user = self::getUser();

        $this->assertSame($user->setPassword('password'), $user);
    }

    public function testEmail()
    {
        $user = self::getUser();
        $this->assertNull($user->getEmail());

        $user->setEmail('email@email.email');
        $this->assertEquals('email@email.email', $user->getEmail());
    }

    public function testSetEmailReturn()
    {
        $user = self::getUser();

        $this->assertSame($user->setEmail('email@email.email'), $user);
    }

    public function testIsDisabled()
    {
        $user = self::getUser();
        $this->assertTrue($user->isDisabled());

        $user->setDisabled(false);
        $this->assertFalse($user->isDisabled());
    }

    public function testIsDisabledReturn()
    {
        $user = self::getUser();

        $this->assertSame($user->setDisabled(true), $user);
    }

    public function testIsDeleted()
    {
        $user = self::getUser();
        $this->assertFalse($user->isDeleted());

        $user->setDeleted(true);
        $this->assertTrue($user->isDeleted());
    }

    public function testIsDeletedReturn()
    {
        $user = self::getUser();

        $this->assertSame($user->setDeleted(true), $user);
    }

    public function testIsAdmin()
    {
        $user = self::getUser();
        $this->assertFalse($user->isAdmin());

        $user->setAdmin(true);
        $this->assertTrue($user->isAdmin());
    }

    public function testIsAdminReturn()
    {
        $user = self::getUser();

        $this->assertSame($user->setAdmin(true), $user);
    }

    public function testRolesDefault()
    {
        $user = self::getUser();
        $this->assertCount(0, $user->getRoles());
    }

    public function testGetRoles()
    {
        $user_role1 = $this
            ->getMockBuilder('Ciscaja\Uhsa\UserBundle\Model\Role')
            ->disableOriginalConstructor()
            ->getMock();

        $user_role2 = $this
            ->getMockBuilder('Ciscaja\Uhsa\UserBundle\Model\Role')
            ->disableOriginalConstructor()
            ->getMock();

        $user = self::getUser();

        $user
            ->addRole($user_role1)
            ->addRole($user_role2);

        $this->assertCount(2,$user->getRoles());
    }

    public function testAddRoles()
    {
        $user_role = $this
            ->getMockBuilder('Ciscaja\Uhsa\UserBundle\Model\Role')
            ->disableOriginalConstructor()
            ->getMock();

        $user = self::getUser();

        $this->assertfalse($user->hasRole($user_role));
        $user->addRole($user_role);
        $this->assertTrue($user->hasRole($user_role));
    }

    public function testAddRoleReturn()
    {
        $user_role = $this
            ->getMockBuilder('Ciscaja\Uhsa\UserBundle\Model\Role')
            ->disableOriginalConstructor()
            ->getMock();

        $user = self::getUser();

        $this->assertSame($user->addRole($user_role), $user);
    }


    public function testRemoveRoles()
    {
        $user_role = $this
            ->getMockBuilder('Ciscaja\Uhsa\UserBundle\Model\Role')
            ->disableOriginalConstructor()
            ->getMock();

        $user = self::getUser();

        $user->addRole($user_role);
        $this->assertTrue($user->hasRole($user_role));
        $user->removeRole($user_role);
        $this->assertFalse($user->hasRole($user_role));
    }

    public function testRemoveRoleReturn()
    {
        $user_role = $this
            ->getMockBuilder('Ciscaja\Uhsa\UserBundle\Model\Role')
            ->disableOriginalConstructor()
            ->getMock();

        $user = self::getUser();

        $this->assertSame($user->removeRole($user_role), $user);
    }

    public function testMultipleRoles()
    {
        $user_role = $this
            ->getMockBuilder('Ciscaja\Uhsa\UserBundle\Model\Role')
            ->disableOriginalConstructor()
            ->getMock();

        $admin_role = $this
            ->getMockBuilder('Ciscaja\Uhsa\UserBundle\Model\Role')
            ->disableOriginalConstructor()
            ->getMock();

        $user = self::getUser();

        $user
            ->addRole($user_role)
            ->addRole($admin_role);
        $this->assertCount(2,$user->getRoles());

        $user->removeRole($user_role);

        $this->assertFalse($user->hasRole($user_role));
        $this->assertTrue($user->hasRole($admin_role));

        $user->removeRole($admin_role);
        $this->assertCount(0,$user->getRoles());
    }
}
