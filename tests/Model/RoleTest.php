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

use Ciscaja\Uhsa\UserBundle\Model\Role;

class RoleTest extends \PHPUnit_Framework_TestCase
{
    public static function getRole()
    {
        return new Role();
    }

    public function testName()
    {
        $role = self::getRole();
        $this->assertNull($role->getRole());

        $role->setRole('ROLE_USER');
        $this->assertEquals('ROLE_USER', $role->getRole());
    }

    public function testSetNameRole()
    {
        $role = self::getRole();
        $this->assertSame($role->setRole('ROLE_USER'), $role);
    }


    public function testUsersDefault()
    {
        $role = self::getRole();
        $this->assertCount(0, $role->getRoles());
    }

    public function testGetUsers()
    {
        $user1 = $this
            ->getMockBuilder('Ciscaja\Uhsa\UserBundle\Model\User')
            ->disableOriginalConstructor()
            ->getMock();

        $user2 = $this
            ->getMockBuilder('Ciscaja\Uhsa\UserBundle\Model\User')
            ->disableOriginalConstructor()
            ->getMock();

        $role = self::getRole();

        $role
            ->addUser($user1)
            ->addUser($user2);

        $this->assertCount(2, $role->getRoles());
    }

    public function testAddUser()
    {
        $user = $this
            ->getMockBuilder('Ciscaja\Uhsa\UserBundle\Model\User')
            ->disableOriginalConstructor()
            ->getMock();

        $role = self::getRole();

        $this->assertFalse($role->hasUser($user));
        $role->addUser($user);
        $this->assertTrue($role->hasUser($user));
    }

    public function testRemoveUser()
    {
        $user = $this
            ->getMockBuilder('Ciscaja\Uhsa\UserBundle\Model\User')
            ->disableOriginalConstructor()
            ->getMock();

        $role = self::getRole();

        $role->addUser($user);
        $this->assertTrue($role->hasUser($user));
        $role->removeUser($user);
        $this->assertFalse($role->hasUser($user));
    }

    public function testMultipleUsers()
    {
        $user = $this
            ->getMockBuilder('Ciscaja\Uhsa\UserBundle\Model\User')
            ->disableOriginalConstructor()
            ->getMock();

        $admin = $this
            ->getMockBuilder('Ciscaja\Uhsa\UserBundle\Model\User')
            ->disableOriginalConstructor()
            ->getMock();

        $role = self::getRole();

        $role
            ->addUser($user)
            ->addUser($admin);
        $this->assertCount(2, $role->getUsers());

        $role->removeUser($user);

        $this->assertFalse($role->hasUser($user));
        $this->assertTrue($role->hasUser($admin));

        $role->removeUser($admin);
        $this->assertCount(0, $role->getUsers());
    }

    public function testRoleToStringName()
    {
        $role = self::getRole();
        $this->assertEmpty((string)$role);

        $role->setRole('ROLE_USER');
        $this->assertEquals('ROLE_USER', (string)$role);
    }

    /*
     * Common
     */

    public function testLoginPermission()
    {
        $role = self::getRole();
        $this->assertFalse($role->canLogin());

        $role->setLoginAllowed(true);
        $this->assertTrue($role->canLogin());
    }

    public function testSetLoginPermissionReturn()
    {
        $role = self::getRole();

        $this->assertSame($role->setLoginAllowed(true), $role);
    }

    /*
     * Uhsa
     */
    // view
    public function testViewUserPermission()
    {
        $role = self::getRole();
        $this->assertFalse($role->canViewUser());

        $role->setViewUserAllowed(true);
        $this->assertTrue($role->canViewUser());
    }

    public function testSetViewUserPermissionReturn()
    {
        $role = self::getRole();

        $this->assertSame($role->setLoginAllowed(true), $role);
    }

    // create
    public function testCreateUserPermission()
    {
        $role = self::getRole();
        $this->assertFalse($role->canCreateUser());

        $role->setCreateUserAllowed(true);
        $this->assertTrue($role->canCreateUser());
    }

    public function testSetCreateUserPermissionReturn()
    {
        $role = self::getRole();

        $this->assertSame($role->setLoginAllowed(true), $role);
    }

    // edit
    public function testEditUserPermission()
    {
        $role = self::getRole();
        $this->assertFalse($role->canEditUser());

        $role->setEditUserAllowed(true);
        $this->assertTrue($role->canEditUser());
    }

    public function testSetEditUserPermissionReturn()
    {
        $role = self::getRole();

        $this->assertSame($role->setLoginAllowed(true), $role);
    }

    // delete
    public function testDeleteUserPermission()
    {
        $role = self::getRole();
        $this->assertFalse($role->canDeleteUser());

        $role->setDeleteUserAllowed(true);
        $this->assertTrue($role->canDeleteUser());
    }

    public function testSetDeleteUserPermissionReturn()
    {
        $role = self::getRole();

        $this->assertSame($role->setLoginAllowed(true), $role);
    }
}
