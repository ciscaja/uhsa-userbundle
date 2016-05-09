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
use Doctrine\DBAL\DBALException;
use Doctrine\ORM\EntityManager;
use Liip\FunctionalTestBundle\Test\WebTestCase;

/*
 * This test might seem as its testing doctrine itself but its merely for testing that the schema definition is correct
 * and working as expected -> unique, nullable etc.
 */
class RoleTest extends WebTestCase
{
    protected static function getRole()
    {
        return new Role();
    }

    public function testInsertUser()
    {
        $this->loadFixtures(array());
        /** @var EntityManager $manager */
        $manager = $this->getContainer()->get('doctrine')->getManager();

        $role = new Role('foo');
        $role->setLoginAllowed(true);

        $manager->persist($role);
        $manager->flush();

        $role_id = $role->getId();

        $manager->clear();

        $qb = $manager->createQueryBuilder();
        $qb
            ->select('r')
            ->from('CiscajaUhsaUserBundle:Role', 'r')
            ->where($qb->expr()->eq('r.id', '?1'));

        $qb->setParameter(1, $role_id);
        /** @var Role $role */
        $role = $qb->getQuery()->getSingleResult();

        $this->assertEquals($role_id, $role->getId());
        $this->assertTrue(true, $role->canLogin());
        $this->assertEquals('foo', $role->getRole());
    }

    public function testInsertRoleFailCauseRollNull()
    {
        $this->expectException(DBALException::class);
        $this->loadFixtures(array());
        /** @var EntityManager $manager */
        $manager = $this->getContainer()->get('doctrine')->getManager();

        $role = new Role(null);

        $manager->persist($role);
        $manager->flush();
    }

    public function testInsertRoleFailCauseRollUnique()
    {
        $this->expectException(DBALException::class);
        $this->loadFixtures(array(
            'Ciscaja\Uhsa\UserBundle\Tests\Functional\Entity\Fixtures\LoadRoleData'
        ));
        /** @var EntityManager $manager */
        $manager = $this->getContainer()->get('doctrine')->getManager();

        $role = new Role('foo');

        $manager->persist($role);
        $manager->flush();
    }
}
