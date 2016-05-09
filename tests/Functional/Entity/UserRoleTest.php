<?php

/*
 * This file is part of the Uhsa package.
 *
 * (c) Victor J. C. Geyer <victor@geyer.io>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ciscaja\Uhsa\UserBundle\Tests\Functional\Entity;

use Ciscaja\Uhsa\UserBundle\Entity\Role;
use Ciscaja\Uhsa\UserBundle\Entity\User;
use Doctrine\DBAL\DBALException;
use Doctrine\ORM\EntityManager;
use Liip\FunctionalTestBundle\Test\WebTestCase;

/*
 * This test might seem as its testing doctrine itself but its merely for testing that the schema definition is correct
 * and working as expected -> unique, nullable etc.
 */

class UserRoleTest extends WebTestCase
{
    public function testInsertUserWithRole()
    {
        $this->loadFixtures(array());
        /** @var EntityManager $manager */
        $manager = $this->getContainer()->get('doctrine')->getManager();

        $role = new Role('foo');
        $user = new User('foo', 'bar', 'foo@bar');
        $user->addRole($role);
        $manager->persist($user);
        $manager->flush();

        $user_id = $user->getId();

        $manager->clear();

        $qb = $manager->createQueryBuilder();
        $qb
            ->select('u')
            ->from('CiscajaUhsaUserBundle:User', 'u')
            ->where($qb->expr()->eq('u.id', '?1'))
            ->setParameter(1, $user_id);
        /** @var User $user */
        $user = $qb->getQuery()->getSingleResult();

        $this->assertSame('foo', $user->getUsername());
        $roles = $user->getRoles();
        $this->assertCount(1, $roles);
        $this->assertSame('foo', $roles[0]->getRole());
    }

    public function testInsertRoleWithUser()
    {
        $this->loadFixtures(array());
        /** @var EntityManager $manager */
        $manager = $this->getContainer()->get('doctrine')->getManager();

        $user = new User('foo', 'bar', 'foo@bar');
        $role = new Role('foo');
        $role->addUser($user);
        $manager->persist($role);
        $manager->flush();

        $role_id = $role->getId();

        $manager->clear();

        $qb = $manager->createQueryBuilder();
        $qb
            ->select('r')
            ->from('CiscajaUhsaUserBundle:Role', 'r')
            ->where($qb->expr()->eq('r.id', '?1'))
            ->setParameter(1, $role_id);
        /** @var Role $role */
        $role = $qb->getQuery()->getSingleResult();

        $this->assertSame('foo', $role->getRole());
        $users = $role->getUsers();
        $this->assertCount(1, $users);
        $this->assertSame('foo', $users[0]->getUsername());
    }

    public function testRemoveUser()
    {
        $this->loadFixtures(array(
            'Ciscaja\Uhsa\UserBundle\Tests\Functional\Entity\Fixtures\LoadRoleData',
            'Ciscaja\Uhsa\UserBundle\Tests\Functional\Entity\Fixtures\LoadUserRoleData'
        ));
        /** @var EntityManager $manager */
        $manager = $this->getContainer()->get('doctrine')->getManager();

        $qb = $manager->createQueryBuilder();
        $query = $qb
            ->select('u')
            ->from('CiscajaUhsaUserBundle:User', 'u')
            ->where($qb->expr()->eq('u.id', '?1'))
            ->setParameter(1, 1)
            ->getQuery();

        // remove user
        /** @var User $user */
        $user = $query->getSingleResult();

        $this->assertCount(1, $user->getRoles());
        $manager->remove($user);
        $manager->flush();

        // check for removed user
        $users = $query->getResult();
        $this->assertCount(0, $users);

        // check for role which should still exist.
        $qb = $manager->createQueryBuilder();
        $query = $qb
            ->select('r')
            ->from('CiscajaUhsaUserBundle:Role', 'r')
            ->getQuery();

        /** @var Role $role */
        $role = $query->getSingleResult();

        $this->assertSame('foo', $role->getRole());
    }

    public function testRemoveRole()
    {
        $this->loadFixtures(array(
            'Ciscaja\Uhsa\UserBundle\Tests\Functional\Entity\Fixtures\LoadRoleData',
            'Ciscaja\Uhsa\UserBundle\Tests\Functional\Entity\Fixtures\LoadUserRoleData'
        ));
        /** @var EntityManager $manager */
        $manager = $this->getContainer()->get('doctrine')->getManager();

        $qb = $manager->createQueryBuilder();
        $query = $qb
            ->select('r')
            ->from('CiscajaUhsaUserBundle:Role', 'r')
            ->where($qb->expr()->eq('r.id', '?1'))
            ->setParameter(1, 1)
            ->getQuery();

        // remove role
        /** @var Role $role */
        $role = $query->getSingleResult();

        $this->assertCount(2, $role->getUsers());
        $manager->remove($role);
        $manager->flush();

        // check for removed role
        $roles = $query->getResult();
        $this->assertCount(0, $roles);

        // check for user which should still exist.
        $qb = $manager->createQueryBuilder();
        $query = $qb
            ->select('u')
            ->from('CiscajaUhsaUserBundle:User', 'u')
            ->orderBy('u.id', 'desc')
            ->setMaxResults(1)
            ->getQuery();

        /** @var User $user */
        $user = $query->getSingleResult();
        $this->assertSame('foo', $user->getUsername());
    }
}
