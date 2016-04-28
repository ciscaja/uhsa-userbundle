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
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadDefaultRoles implements FixtureInterface, ContainerAwareInterface
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
        $manager->persist($this->getAdminRole());
        $manager->persist($this->getUserManagerRole());
        $manager->persist($this->getUserRole());
        $manager->flush();
    }

    /**
     * @return Role
     */
    protected function getAdminRole()
    {
        $role = new Role('CISCAJA_ADMIN');
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
        return $role;
    }
}