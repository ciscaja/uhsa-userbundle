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
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadRoleData implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $role = new Role('foo');

        $manager->persist($role);
        $manager->flush();
    }
}