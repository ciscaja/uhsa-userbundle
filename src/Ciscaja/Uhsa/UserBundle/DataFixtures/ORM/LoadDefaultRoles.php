<?php

/*
 * This file is part of the Uhsa package.
 *
 * (c) Victor J. C. Geyer <victor@geyer.io>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */


namespace Ciscaja\Uhsa\UserBundle\DataFixtures\ORM;

use Ciscaja\Uhsa\UserBundle\Entity\Role;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadDefaultRoles extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $manager)
    {
        $user_manager_role = $this->getUserManagerRole();
        $manager->persist($user_manager_role);
        $this->addReference('user-manager-role', $user_manager_role);

        $user_role = $this->getUserRole();
        $manager->persist($user_role);
        $this->addReference('user-role', $user_role);

        $manager->flush();
    }

    /**
     * @return Role
     */
    protected function getUserManagerRole()
    {
        $role = new Role('CISCAJA_USER_MANAGER');
        $role
            ->setLoginAllowed(true)
            ->setEditUserAllowed(true)
            ->setCreateUserAllowed(true)
            ->setDeleteUserAllowed(true)
            ->setViewUserAllowed(true);

        return $role;
    }

    /**
     * @return Role
     */
    protected function getUserRole()
    {
        $role = new Role('CISCAJA_USER');

        $role->setLoginAllowed(true);

        return $role;
    }

    public function getOrder()
    {
        return 1;
    }
}