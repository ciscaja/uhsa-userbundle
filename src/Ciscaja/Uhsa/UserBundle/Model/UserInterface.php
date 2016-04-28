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

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Security\Core\User\UserInterface as BaseUserInterface;

interface UserInterface extends BaseUserInterface
{
    /**
     * @param string $username
     *
     * @return UserInterface
     */
    public function setUsername($username);

    /**
     * @param string $password
     *
     * @return UserInterface
     */
    public function setPassword($password);

    /**
     * @param string $mail
     *
     * @return UserInterface
     */
    public function setEmail($mail);

    /**
     * @return string
     */
    public function getEmail();

    /**
     * @param RoleInterface $role
     *
     * @return UserInterface
     */
    public function addRole(RoleInterface $role);

    /**
     * @param RoleInterface $role
     *
     * @return UserInterface
     */
    public function removeRole(RoleInterface $role);

    /**
     * @param RoleInterface $role
     *
     * @return bool
     */
    public function hasRole(RoleInterface $role);

    /**
     * @return string
     */
    public function __toString();
}