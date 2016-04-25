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
}