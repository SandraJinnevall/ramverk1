<?php

namespace Anax\Ip;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;

class IpController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;

    private $db = "not active";

    public function initialize() : void
    {
        $this->db = "active";
        $this->IpController = new Validera();
    }

    public function indexAction() : object
    {
        $title = "Kontrollera IP";
        $show["show"] = true;

        if ($this->di->get("request")->hasGet("ipadress")) {
            $session = $this->di->get("session");
            $session->set("ipadress", $this->di->get("request")->getGet("ipadress"));
            $resultIp = $this->checkIfValidOrNot();
            $this->di->get("page")->add("ip/result", $resultIp);
            $show["show"] = false;
        }

        $this->di->get("page")->add("ip/ip", $show);

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

            return $resultIp;
        }
        return [];
    }
}
