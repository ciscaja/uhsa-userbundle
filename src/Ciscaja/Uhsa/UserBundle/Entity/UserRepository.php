<?php

/*
 * This file is part of the Uhsa package.
 *
 * (c) Victor J. C. Geyer <victor@geyer.io>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ciscaja\Uhsa\UserBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Security\User\UserLoaderInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class UserRepository extends EntityRepository implements UserLoaderInterface {
    /**
     * @param string $username
     *
     * @return null|User
     */
    public function loadUserByUsername($username)
    {
        $qb = $this->getEntityManager()->createQueryBuilder();

        return $qb
            ->select('u')
            ->from('CiscajaUhsaUserBundle:User', 'u')
            ->where(
                $qb->expr()->orX(
                    $qb->expr()->eq('u.username', ':username'),
                    $qb->expr()->eq('u.email', ':username')
                )
            )
            ->setParameters(array(
                'username' => $username
            ))
            ->getQuery()
            ->getOneOrNullResult();
    }
}