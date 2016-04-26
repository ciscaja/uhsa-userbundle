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
    /**
     * RoleInterface constructor.
     *
     * @param null|string $role
     */
    public function __construct($role);

    /**
     * @param string $role
     *
     * @return UserInterface
     */
    public function setRole($role);

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
     * @return UserInterface
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
     * @return UserInterface
     */
    public function setViewUserAllowed($allowed);

    /**
     * @return bool
     */
    public function canCreateUser();

    /**
     * @param bool $allowed
     *
     * @return UserInterface
     */
    public function setCreateUserAllowed($allowed);

    /**
     * @return bool
     */
    public function canEditUser();

    /**
     * @param bool $allowed
     *
     * @return UserInterface
     */
    public function setEditUserAllowed($allowed);

    /**
     * @return bool
     */
    public function canDeleteUser();

    /**
     * @param bool $allowed
     *
     * @return UserInterface
     */
    public function setDeleteUserAllowed($allowed);
}