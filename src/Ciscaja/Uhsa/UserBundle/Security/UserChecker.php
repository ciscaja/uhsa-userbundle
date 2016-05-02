<?php

/*
 * This file is part of the Uhsa package.
 *
 * (c) Victor J. C. Geyer <victor@geyer.io>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ciscaja\Uhsa\UserBundle\Security;

use Ciscaja\Uhsa\UserBundle\Model\RoleInterface;
use Ciscaja\Uhsa\UserBundle\Model\UserInterface as AppUser;
use Ciscaja\Uhsa\UserBundle\Security\Exception\AccountDeletedException;
use Ciscaja\Uhsa\UserBundle\Security\Exception\AccountDisabledException;
use Ciscaja\Uhsa\UserBundle\Security\Exception\AccountRoleNoLoginPermissionException;
use Symfony\Component\Security\Core\Exception\AccountExpiredException;
use Symfony\Component\Security\Core\User\UserCheckerInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class UserChecker implements UserCheckerInterface
{

    /**
     * {@inheritdoc}
     */
    public function checkPreAuth(UserInterface $user)
    {
        if (!$user instanceof AppUser) {
            return;
        }

        if ($user->isDeleted()) {
            throw new AccountDeletedException('This user has been deleted.');
        }

        if ($user->isDisabled()) {
            throw new AccountDisabledException('This user has been disabled.');
        }

        $can_login = false;
        /** @var RoleInterface $role */
        foreach ($user->getRoles() as $role) {
            if($role->canLogin()) {
                $can_login = true;
                break;
            }
        }

        if($can_login === false)
            throw new AccountRoleNoLoginPermissionException('This user has no role with the login permission.');
    }

    /**
     * {@inheritdoc}
     */
    public function checkPostAuth(UserInterface $user)
    {
    }
}