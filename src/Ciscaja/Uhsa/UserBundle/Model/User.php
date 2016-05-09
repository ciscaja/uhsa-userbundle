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

class User implements UserInterface, BaseUserInterface
{
    /**
     * @var string
     */
    protected $username;

    /**
     * @var string
     */
    protected $salt;

    /**
     * @var string
     */
    protected $password;

    /**
     * @var string
     */
    protected $email;

    /**
     * @var bool
     */
    protected $disabled;

    /**
     * @var bool
     */
    protected $deleted;

    /**
     * @var bool
     */
    protected $admin;
    
    /**
     * @var ArrayCollection
     */
    protected $roles;

    /**
     * User constructor.
     *
     * @param null                 $username
     * @param null                 $password
     * @param null                 $email
     * @param bool                 $disabled
     * @param ArrayCollection|null $roles
     */
    public function __construct($username = null, $password = null, $email = null, $disabled = true, ArrayCollection $roles = null)
    {
        $this->id = null;
        $this->username = $username;
        $this->salt = \base_convert(\sha1(\uniqid(\mt_rand(), true)), 16, 36);
        $this->password = $password;
        $this->email = $email;
        $this->disabled = $disabled;
        $this->deleted = false;
        $this->admin = false;
        $this->roles = ($roles === null) ? new ArrayCollection : $roles;
    }

    /**
     * {@inheritdoc}
     */
    public function eraseCredentials()
    {
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param $username
     *
     * @return User
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @return string
     */
    public function getSalt()
    {
        return $this->salt;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param $password
     *
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param $email
     *
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getRoles()
    {
        return $this->roles->toArray();
    }

    /**+
     * @param Role $role
     *
     * @return User
     */
    public function addRole(RoleInterface $role)
    {
        $this->roles->add($role);

        if ($role->hasUser($this) === false)
            $role->addUser($this);

        return $this;
    }

    /**
     * @param Role $role
     *
     * @return User
     */
    public function removeRole(RoleInterface $role)
    {
        $this->roles->removeElement($role);

        if ($role->hasUser($this) === true)
            $role->removeUser($this);
        
        return $this;
    }

    /**
     * @param Role $role
     *
     * @return bool
     */
    public function hasRole(RoleInterface $role)
    {
        return $this->roles->contains($role);
    }

    /**
     * @return bool
     */
    public function isDisabled()
    {
        return $this->disabled;
    }

    /**
     * @param bool $disabled
     *
     * @return User
     */
    public function setDisabled($disabled)
    {
        $this->disabled = $disabled;

        return $this;
    }

    /**
     * @return bool
     */
    public function isDeleted()
    {
        return $this->deleted;
    }

    /**
     * @param bool $deleted
     *
     * @return User
     */
    public function setDeleted($deleted)
    {
        $this->deleted = $deleted;

        return $this;
    }

    /**
     * @return bool
     */
    public function isAdmin()
    {
        return $this->admin;
    }

    /**
     * @param bool $admin
     *
     * @return User
     */
    public function setAdmin($admin)
    {
        $this->admin = $admin;

        return $this;
    }

    /**
     * @return null|string
     */
    public function __toString()
    {
        return (string)$this->username;
    }
}