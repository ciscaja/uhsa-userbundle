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

use Ciscaja\Uhsa\UserBundle\Entity\User;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadUserData implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setUsername('foo');
        $user->setPassword('oof');
        $user->setEmail('foo@bar');

        $manager->persist($user);
        $manager->flush();
    }
}