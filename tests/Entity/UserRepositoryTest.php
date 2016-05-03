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
use Ciscaja\Uhsa\UserBundle\Entity\UserRepository;
use Doctrine\DBAL\DBALException;
use Doctrine\ORM\EntityManager;
use Liip\FunctionalTestBundle\Test\WebTestCase;

/*
 * This test might seem as its testing doctrine itself but its merely for testing that the schema definition is correct
 * and working as expected -> unique, nullable etc.
 */

class UserRepositoryTest extends WebTestCase
{
    public function testLoadUserByUsername()
    {
        $this->loadFixtures(array(
            'Ciscaja\Uhsa\UserBundle\Tests\Entity\Fixtures\LoadUserData'
        ));
        /** @var UserRepository $repository */
        $repository = $this->getContainer()->get('doctrine')->getRepository('CiscajaUhsaUserBundle:User');

        $this->assertEquals($repository->loadUserByUsername('foo')->getUsername(), 'foo');
    }

    public function testLoadUserByUsernameFail()
    {
        $this->loadFixtures(array());
        /** @var UserRepository $repository */
        $repository = $this->getContainer()->get('doctrine')->getRepository('CiscajaUhsaUserBundle:User');

        $this->assertNull($repository->loadUserByUsername('foo'));
    }

    public function testLoadUserByEmail()
    {
        $this->loadFixtures(array(
            'Ciscaja\Uhsa\UserBundle\Tests\Entity\Fixtures\LoadUserData'
        ));
        /** @var UserRepository $repository */
        $repository = $this->getContainer()->get('doctrine')->getRepository('CiscajaUhsaUserBundle:User');

        $this->assertEquals($repository->loadUserByUsername('foo@bar')->getEmail(), 'foo@bar');
    }

    public function testLoadUserByEmailFail()
    {
        $this->loadFixtures(array());
        /** @var UserRepository $repository */
        $repository = $this->getContainer()->get('doctrine')->getRepository('CiscajaUhsaUserBundle:User');

        $this->assertNull($repository->loadUserByUsername('foo@bar'));
    }
}
