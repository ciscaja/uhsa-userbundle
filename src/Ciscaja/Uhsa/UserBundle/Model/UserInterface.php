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

interface UserInterface
{
    /**
     * @param string $username
     *
     * @return UserInterface
     */
    public function setUsername($username);

    /**
     * @return string
     */
    public function getUsername();

    /**
     * @param string $password
     *
     * @return UserInterface
     */
    public function setPassword($password);

    /**
     * @return string
     */
    public function getPassword();

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
     * @return string
     */
    public function getSalt();

    /**
     * @return array
     */
    public function getRoles();

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
     * @return bool
     */
    public function isDisabled();

    /**
     * @param bool $disabled
     *
     * @return UserInterface
     */
    public function setDisabled($disabled);

    /**
     * @return bool
     */
    public function isDeleted();

    /**
     * @param bool $deleted
     *
     * @return UserInterface
     */
    public function setDeleted($deleted);
    
    /**
     * @return bool
     */
    public function isAdmin();

    /**
     * @param bool $admin
     *
     * @return UserInterface
     */
    public function setAdmin($admin);

    /**
     * @return string
     */
    public function __toString();
}