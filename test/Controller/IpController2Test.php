<?php

namespace Anax\Ip2;

use Anax\DI\DIFactoryConfig;
use PHPUnit\Framework\TestCase;

/**
 * Test the SampleController.
 */
class IpController2Test extends TestCase
{
    protected function setUp()
    {
        global $di;

        $this->di = new DIFactoryConfig();
        $di = $this->di;
        $di->loadServices(ANAX_INSTALL_PATH . "/config/di");
        $di->get('cache')->setPath(ANAX_INSTALL_PATH . "/test/cache");
        $this->controller = new IpController2();
        $this->controller->setDI($this->di);
        $this->controller->initialize();
    }

    public function testcheckIfValidOrNotipv4()
    {
        $session = $this->di->get("session");
        $session->set("ipadress", "66.249.72.26");

        $resultjson = $this->controller->checkIfValidOrNot();
        $json = [
            "ipadress" => "66.249.72.26",
            "validerbar" => true,
            "ipv" => "Ipv4",
            "domain" => "crawl-66-249-72-26.googlebot.com",
            "latitude" => 37.419158935546875,
            "longitude" => -122.075408935546875,
            "country" => "United States",
            "city" => "Mountain View"
        ];
        $this->assertEquals($json, $resultjson);

        $session->destroy();
    }

    public function testcheckIfValidOrNotipv6()
    {
        $session = $this->di->get("session");
        $session->set("ipadress", "2001:470:ed3d:1000::2:1");

        $resultjson = $this->controller->checkIfValidOrNot();
        $json = [
            "ipadress" => "2001:470:ed3d:1000::2:1",
            "validerbar" => true,
            "ipv" => "Ipv6",
            "domain" => "2001:470:ed3d:1000::2:1",
            "latitude" => 47.642108917236328125,
            "longitude" => -122.40679168701171875,
            "country" => "United States",
            "city" => "Seattle"
        ];
        $this->assertEquals($json, $resultjson);

        $session->destroy();
    }

    public function testcheckIfValidOrNotReturnNull()
    {
        $session = $this->di->get("session");
        $session->set("ipadress", "");

        $resultjson = $this->controller->checkIfValidOrNot();
        $json = [
            "ipadress" => "",
            "validerbar" => false,
            "ipv" => "Undefined",
            "domain" => null,
            "latitude" => null,
            "longitude" => null,
            "country" => null,
            "city" => null
        ];
        $this->assertEquals($json, $resultjson);

        $session->destroy();
    }

    public function testcheckIfValidOrNotReturnNullArray()
    {
        $session = $this->di->get("session");
        $session->set("", "");

        $resultjson = $this->controller->checkIfValidOrNot();
        $this->assertEmpty($resultjson);

        $session->destroy();
    }

    public function testIndexAction()
    {
        $this->di->get("request")->setGet("ipadress", "66.249.72.26");
        $res = $this->controller->indexAction();
        $this->assertIsObject($res);
    }
}
