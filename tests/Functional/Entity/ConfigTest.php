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


use Symfony\Component\Yaml\Parser;

class ConfigTest extends \PHPUnit_Framework_TestCase
{
    public function testValidUserYaml()
    {
        $yaml = new Parser();

        $yaml->parse(file_get_contents(__DIR__.'/../../../src/Ciscaja/Uhsa/UserBundle/Resources/config/doctrine/User.orm.yml'));
    }

    public function testValidRoleYaml()
    {
        $yaml = new Parser();

        $yaml->parse(file_get_contents(__DIR__.'/../../../src/Ciscaja/Uhsa/UserBundle/Resources/config/doctrine/Role.orm.yml'));
    }
}
