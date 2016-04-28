<?php

/*
 * This file is part of the Uhsa package.
 *
 * (c) Victor J. C. Geyer <victor@geyer.io>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ciscaja\Uhsa\UserBundle\Tests\Entity;

use Ciscaja\Uhsa\UserBundle\Entity\User;
use Doctrine\DBAL\DBALException;
use Doctrine\ORM\EntityManager;
use Liip\FunctionalTestBundle\Test\WebTestCase;

/*
 * This test might seem as its testing doctrine itself but its merely for testing that the schema definition is correct
 * and working as expected -> unique, nullable etc.
 */

class UserTest extends WebTestCase
{
    protected static function getUser()
    {
        return new User();
    }

    public function testInsertUser()
    {
        $this->loadFixtures(array());
        /** @var EntityManager $manager */
        $manager = $this->getContainer()->get('doctrine')->getManager();

        $user = new User('foo', 'bar', 'foo@bar', false);

        $manager->persist($user);
        $manager->flush();

        $user_id = $user->getId();
        $user_salt = $user->getSalt();
        $manager->clear();

        $qb = $manager->createQueryBuilder();
        $qb
            ->select('u')
            ->from('CiscajaUhsaUserBundle:User', 'u')
            ->where($qb->expr()->eq('u.id', '?1'));

        $qb->setParameter(1, $user_id);
        /** @var User $user */
        $user = $qb->getQuery()->getSingleResult();

        $this->assertEquals($user_id, $user->getId());
        $this->assertEquals($user_salt, $user->getSalt());
        $this->assertEquals('foo', $user->getUsername());
        $this->assertEquals('bar', $user->getPassword());
        $this->assertEquals('foo@bar', $user->getEmail());
        $this->assertFalse($user->isDisabled());
        $this->assertFalse($user->isDeleted());
    }

    public function testInsertUserFailCauseUserNull()
    {
        $this->expectException(DBALException::class);
        $this->loadFixtures(array());
        /** @var EntityManager $manager */
        $manager = $this->getContainer()->get('doctrine')->getManager();

        $user = new User(null, 'XXX', 'XXX');

        $manager->persist($user);
        $manager->flush();
    }

    public function testInsertUserFailCausePasswordNull()
    {
        $this->expectException(DBALException::class);
        $this->loadFixtures(array());
        /** @var EntityManager $manager */
        $manager = $this->getContainer()->get('doctrine')->getManager();

        $user = new User('XXX', null, 'XXX');

        $manager->persist($user);
        $manager->flush();
    }

    public function testInsertUserFailCauseEmailNull()
    {
        $this->expectException(DBALException::class);
        $this->loadFixtures(array());
        /** @var EntityManager $manager */
        $manager = $this->getContainer()->get('doctrine')->getManager();

        $user = new User('XXX', 'XXX', null);

        $manager->persist($user);
        $manager->flush();
    }

    public function testInsertUserFailCauseUserUnique()
    {
        $this->expectException(DBALException::class);
        $this->loadFixtures(array(
            'Ciscaja\Uhsa\UserBundle\Tests\Entity\Fixtures\LoadUserData'
        ));
        /** @var EntityManager $manager */
        $manager = $this->getContainer()->get('doctrine')->getManager();

        $user = new User('foo', 'XXX', 'XXX');

        $manager->persist($user);
        $manager->flush();
    }

    public function testInsertUserFailCauseEmailUnique()
    {
        $this->expectException(DBALException::class);
        $this->loadFixtures(array(
            'Ciscaja\Uhsa\UserBundle\Tests\Entity\Fixtures\LoadUserData'
        ));
        /** @var EntityManager $manager */
        $manager = $this->getContainer()->get('doctrine')->getManager();

        $user = new User('XXX', 'XXX', 'foo@bar');

        $manager->persist($user);
        $manager->flush();
    }
}
