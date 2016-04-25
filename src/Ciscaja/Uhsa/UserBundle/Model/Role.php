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

class Role implements RoleInterface
{

    /**
     * @var string
     */
    protected $role;

    /**
     * Role constructor.
     *
     * @param null|string $role
     */
    public function __construct($role = null)
    {
        $this->role = $role;
    }

    /**
     * @param string $role
     *
     * @return RoleInterface
     */
    public function setRole($role)
    {
        $this->role = $role;

        return $this;
    }

    /**
     * @return string
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return (string)$this->role;
    }
}