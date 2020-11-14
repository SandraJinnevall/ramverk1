<?php

namespace Anax\Ip2;

use Anax\DI\DIFactoryConfig;
use PHPUnit\Framework\TestCase;

/**
 * Test the SampleController.
 */
class IpJsonController2Test extends TestCase
{
    protected function setUp()
    {
        global $di;

        $this->di = new DIFactoryConfig();
        $di = $this->di;
        $di->loadServices(ANAX_INSTALL_PATH . "/config/di");
        $di->get('cache')->setPath(ANAX_INSTALL_PATH . "/test/cache");
        $this->controller = new CheckjsonController2();
        $this->controller->setDI($this->di);
        $this->controller->initialize();
    }

    public function testindexAction()
    {
        $this->di->get("request")->setGet("ipjson", "66.249.72.26");
        $resultjson = $this->controller->indexAction();
        $json = [[
            "ip" => "66.249.72.26",
            "validerbar" => true,
            "ipv" => "Ipv4",
            "domän" => "crawl-66-249-72-26.googlebot.com",
            "latitude" => 37.419158935546875,
            "longitude" => -122.075408935546875,
            "country" => null,
            "city" => "Mountain View"
        ]];
        $this->assertEquals($json, $resultjson);
    }
}
