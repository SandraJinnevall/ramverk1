<?php

namespace Anax\Ip3;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;

class CheckjsonController3 implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;

    public function initialize()
    {
        $this->IpController = new Validera3();
    }

    public function indexAction() : array
    {
        $ipController = new Validera3();
        $ipadress = $this->di->request->getGet("ipjson");
        $weather = $this->di->get("validera3");

        $json = [
            "Stad" => $ipadress,
            "validerbar" => $weather->check($ipadress),
            "weather" => $weather->getWeather($ipadress)
        ];

        return [$json];
    }
}
