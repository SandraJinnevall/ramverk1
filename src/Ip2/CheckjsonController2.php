<?php

namespace Anax\Ip2;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;

class CheckjsonController2 implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;

    public function initialize()
    {
        $this->IpController = new Validera2();
    }

    public function indexAction() : array
    {
        $ipController = new Validera2();
        $ipadress = $this->di->request->getGet("ipjson");

        $json = [
            "ip" => $ipadress,
            "validerbar" => $ipController->check($ipadress),
            "ipv" => $ipController->vilkenipv($ipadress) ?? null,
            "domän" => $ipController->domain($ipadress) ?? null,
            "latitude" => $ipController->getPosition($ipadress)[0] ?? null,
            "longitude" => $ipController->getPosition($ipadress)[1] ?? null,
            "country" => $ipController->getPosition($ipadress)[4] ?? null,
            "city" => $ipController->getPosition($ipadress)[3] ?? null,
        ];

        return [$json];
    }
}
