<?php

/*
 * This file is part of the Uhsa package.
 *
 * (c) Victor J. C. Geyer <victor@geyer.io>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ciscaja\Uhsa\UserBundle\Model;

use Symfony\Component\Security\Core\Role\RoleInterface as BaseRoleInterface;

interface RoleInterface extends BaseRoleInterface
{
    const FLAG_NOTHING = 0;
    const FLAG_SYSTEM_LOGIN = 1;
    const FLAG_USER_VIEW = 2;
    const FLAG_USER_CREATE = 4;
    const FLAG_USER_EDIT = 8;
    const FLAG_USER_DELETE = 16;

    /**
     * RoleInterface constructor.
     *
     * @param null|string $role
     */
    public function __construct($role);

    /**
     * @param string $role
     *
     * @return RoleInterface
     */
    public function setRole($role);

    /**
     * @return bool
     */
    public function getUsers();

    /**
     * @param UserInterface $user
     *
     * @return UserInterface
     */
    public function addUser(UserInterface $user);

    /**
     * @param UserInterface $user
     *
     * @return UserInterface
     */
    public function removeUser(UserInterface $user);

    /**
     * @param UserInterface $user
     *
     * @return bool
     */
    public function hasUser(UserInterface $user);

    /**
     * @return string
     */
    public function __toString();

    /*
     * Common
     */

    /**
     * @return bool
     */
    public function canLogin();

    /**
     * @param bool $allowed
     *
     * @return RoleInterface
     */
    public function setLoginAllowed($allowed);

    /*
     * Uhsa
     */

    /**
     * @return bool
     */
    public function canViewUser();

    /**
     * @param bool $allowed
     *
     * @return RoleInterface
     */
    public function setViewUserAllowed($allowed);

    /**
     * @return bool
     */
    public function canCreateUser();

    /**
     * @param bool $allowed
     *
     * @return RoleInterface
     */
    public function setCreateUserAllowed($allowed);

    /**
     * @return bool
     */
    public function canEditUser();

    /**
     * @param bool $allowed
     *
     * @return RoleInterface
     */
    public function setEditUserAllowed($allowed);

    /**
     * @return bool
     */
    public function canDeleteUser();

    /**
     * @param bool $allowed
     *
     * @return RoleInterface
     */
    public function setDeleteUserAllowed($allowed);
}