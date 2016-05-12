<?php

/*
 * This file is part of the Uhsa package.
 *
 * (c) Victor J. C. Geyer <victor@geyer.io>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ciscaja\Uhsa\UserBundle\Tests\Functional\Security;


use Liip\FunctionalTestBundle\Test\WebTestCase;
use Symfony\Component\Yaml\Parser;

class ConfigTest extends WebTestCase
{
    public function testUserCheckerServiceYaml()
    {
        $yaml = new Parser();

        $yaml->parse(file_get_contents(__DIR__ . '/../../../src/Ciscaja/Uhsa/UserBundle/Resources/config/services/security.yml'));
    }

    public function testUserCheckerServiceConfigured()
    {
        $this->getContainer()->get('ciscaja.uhsa.userbundle.user_checker');
    }
}