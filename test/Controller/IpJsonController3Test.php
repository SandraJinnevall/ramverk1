<?php

namespace Anax\Ip3;

use Anax\DI\DIFactoryConfig;
use PHPUnit\Framework\TestCase;

/**
 * Test the SampleController.
 */
class IpJsonController3Test extends TestCase
{
    protected function setUp()
    {
        global $di;

        $this->di = new DIFactoryConfig();
        $di = $this->di;
        $di->loadServices(ANAX_INSTALL_PATH . "/config/di");
        $di->loadServices(ANAX_INSTALL_PATH . "/test/config/di");
        $this->controller = new CheckjsonController3();
        $this->controller->setDI($this->di);
        $this->controller->initialize();
    }

    public function testIndexAction()
    {
        $weather = $this->di->get("validera3");
        $this->di->get("request")->setGet("ipadress", "Kalmar");
        $res = $this->controller->indexAction();
        $this->assertIsArray($res);
    }
}
