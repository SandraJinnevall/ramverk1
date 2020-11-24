<?php

namespace Anax\Ip3;

use Anax\DI\DIFactoryConfig;
use PHPUnit\Framework\TestCase;

/**
 * Test the SampleController.
 */
class IpController3Test extends TestCase
{
    protected function setUp()
    {
        global $di;

        $this->di = new DIFactoryConfig();
        $di = $this->di;
        $di->loadServices(ANAX_INSTALL_PATH . "/config/di");
        $di->loadServices(ANAX_INSTALL_PATH . "/test/config/di");
        $di->get('cache')->setPath(ANAX_INSTALL_PATH . "/test/cache");
        $this->controller = new IpController3();
        $this->controller->setDI($this->di);
        $this->controller->initialize();
    }

    public function testIndexAction()
    {
        $this->di->get("request")->setGet("ipadress", "Kalmar");
        $res = $this->controller->indexAction();
        $this->assertIsObject($res);
    }
}
