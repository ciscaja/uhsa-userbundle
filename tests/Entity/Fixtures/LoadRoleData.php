<?php

/*
 * This file is part of the Uhsa package.
 *
 * (c) Victor J. C. Geyer <victor@geyer.io>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ciscaja\Uhsa\UserBundle\Tests\Entity\Fixtures;

use Ciscaja\Uhsa\UserBundle\Entity\Role;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadRoleData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $role = new Role('foo');

        $manager->persist($role);
        $manager->flush();

        $this->addReference('foo-role', $role);
    }

    public function getOrder()
    {
        return 1;
    }
}