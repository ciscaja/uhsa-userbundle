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

use Ciscaja\Uhsa\UserBundle\Entity\User;
use Ciscaja\Uhsa\UserBundle\Model\Role;

class UserRoleTest extends \PHPUnit_Framework_TestCase
{
    public function testAddRoleToUser()
    {
        $role = new Role('foo');
        $user = new User('bar');
        $user->addRole($role);

        $this->assertTrue($user->hasRole($role));
        $this->assertTrue($role->hasUser($user));
    }

    public function testAddUserToRole()
    {
        $role = new Role('foo');
        $user = new User('bar');
        $role->addUser($user);

        $this->assertTrue($role->hasUser($user));
        $this->assertTrue($user->hasRole($role));
    }

    public function testRemoveRoleFromUser()
    {
        $role = new Role('foo');
        $user = new User('bar');
        $user->addRole($role);
        $user->removeRole($role);

        $this->assertFalse($user->hasRole($role));
        $this->assertFalse($role->hasUser($user));
    }

    public function testRemoveUserFromRole()
    {
        $role = new Role('foo');
        $user = new User('bar');
        $role->addUser($user);
        $role->removeUser($user);

        $this->assertFalse($role->hasUser($user));
        $this->assertFalse($user->hasRole($role));
    }
}
