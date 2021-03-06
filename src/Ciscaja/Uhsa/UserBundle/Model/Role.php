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

use Ciscaja\Uhsa\UserBundle\Util\BitOperations;
use Doctrine\Common\Collections\ArrayCollection;

class Role implements RoleInterface
{
    use BitOperations;

    /**
     * @var string
     */
    protected $role;

    /**
     * @var ArrayCollection
     */
    protected $users;

    /**
     * @var int
     */
    protected $flags;

    /**
     * Role constructor.
     *
     * @param null|string $role
     */
    public function __construct($role = null, ArrayCollection $users = null)
    {
        $this->role = $role;
        $this->flags = self::FLAG_NOTHING;
        $this->users = ($users === null) ? new ArrayCollection : $users;
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
     * @return ArrayCollection|null
     */
    public function getUsers()
    {
        return $this->users->toArray();
    }

    /**
     * @param UserInterface $user
     *
     * @return RoleInterface
     */
    public function addUser(UserInterface $user)
    {
        $this->users->add($user);

        if ($user->hasRole($this) === false)
            $user->addRole($this);

        return $this;
    }

    /**
     * @param UserInterface $user
     *
     * @return RoleInterface
     */
    public function removeUser(UserInterface $user)
    {
        $this->users->removeElement($user);

        if ($user->hasRole($this) === true)
            $user->removeRole($this);
        
        return $this;
    }

    /**
     * @param UserInterface $user
     *
     * @return bool
     */
    public function hasUser(UserInterface $user)
    {
        return $this->users->contains($user);
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return (string)$this->role;
    }

    /**
     * @return int
     */
    public function getFlags()
    {
        return $this->flags;
    }

    /**
     * {@inheritdoc}
     */
    public function canLogin()
    {
        return $this->isFlagSet($this->flags, self::FLAG_SYSTEM_LOGIN);
    }

    /**
     * {@inheritdoc}
     */
    public function setLoginAllowed($allowed)
    {
        $this->setFlag($this->flags, self::FLAG_SYSTEM_LOGIN, $allowed);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function canViewUser()
    {
        return $this->isFlagSet($this->flags, self::FLAG_USER_VIEW);
    }

    /**
     * {@inheritdoc}
     */
    public function setViewUserAllowed($allowed)
    {
        $this->setFlag($this->flags, self::FLAG_USER_VIEW, $allowed);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function canCreateUser()
    {
        return $this->isFlagSet($this->flags, self::FLAG_USER_CREATE);
    }

    /**
     * {@inheritdoc}
     */
    public function setCreateUserAllowed($allowed)
    {
        $this->setFlag($this->flags, self::FLAG_USER_CREATE, $allowed);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function canEditUser()
    {
        return $this->isFlagSet($this->flags, self::FLAG_USER_EDIT);
    }

    /**
     * {@inheritdoc}
     */
    public function setEditUserAllowed($allowed)
    {
        $this->setFlag($this->flags, self::FLAG_USER_EDIT, $allowed);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function canDeleteUser()
    {
        return $this->isFlagSet($this->flags, self::FLAG_USER_DELETE);
    }

    /**
     * {@inheritdoc}
     */
    public function setDeleteUserAllowed($allowed)
    {
        $this->setFlag($this->flags, self::FLAG_USER_DELETE, $allowed);

        return $this;
    }
}