<?php

namespace Anax\Ip2;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;

class IpController2 implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;

    private $db = "not active";

    public function initialize() : void
    {
        $this->db = "active";
        $this->IpController = new Validera2();
    }

    public function indexAction() : object
    {
        $title = "Kontrollera IP";
        $show = true;
        $ipController = $this->IpController;
        $getcurrentIp = $ipController->getCurrentIP();

        if ($this->di->get("request")->hasGet("ipadress")) {
            $session = $this->di->get("session");
            $session->set("ipadress", $this->di->get("request")->getGet("ipadress"));
            $resultIp = $this->checkIfValidOrNot();
            $this->di->get("page")->add("ip2/result2", $resultIp);
            $show = false;
        }

        $this->di->get("page")->add("ip2/ip2", [
          "show" => $show,
          "currentIP" => $getcurrentIp,
        ]);
        return $this->di->get("page")->render([
            "title" => $title,
        ]);
    }

    public function checkIfValidOrNot()
    {
        $ipcontroller = $this->IpController;
        $session = $this->di->get("session");
        if ($session->has('ipadress')) {
            $ipadress = $session->get("ipadress");
            $resultIp["ipadress"] = $ipadress;
            $resultIp["validerbar"] = $ipcontroller->check($ipadress);
            $resultIp["ipv"] = $ipcontroller->vilkenipv($ipadress);
            $resultIp["domain"] = $ipcontroller->domain($ipadress);
            $resultIp["latitude"] = $ipcontroller->getPosition($ipadress)[0];
            $resultIp["longitude"] = $ipcontroller->getPosition($ipadress)[1];
            $resultIp["country"] = $ipcontroller->getPosition($ipadress)[2];
            $resultIp["city"] = $ipcontroller->getPosition($ipadress)[3];

            return $resultIp;
        }
        return [];
    }
}
