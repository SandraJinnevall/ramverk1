<?php

namespace Anax\Ip3;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;

class IpController3 implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;

    private $db = "not active";

    public function initialize() : void
    {
        $this->db = "active";
        $this->IpController = new Validera3();
    }

    public function indexAction() : object
    {
        $title = "Kontrollera IP";
        $show = true;
        $ipController = $this->IpController;
        $getcurrentIp = $ipController->getCurrentIP();
        $postion = $this->di->get("positionKey");
        $getcurrentCity = $postion->getPosition($getcurrentIp);

        if ($this->di->get("request")->hasGet("ipadress")) {
            $session = $this->di->get("session");
            $session->set("ipadress", $this->di->get("request")->getGet("ipadress"));
            $resultIp = $this->checkIfValidOrNot();
            $this->di->get("page")->add("ip3/result3", $resultIp);
            $show = false;
        }

        $this->di->get("page")->add("ip3/ip3", [
          "show" => $show,
          "currentIP" => $getcurrentIp,
          "currentCity" => $getcurrentCity[3],
        ]);
        return $this->di->get("page")->render([
            "title" => $title,
        ]);
    }

    public function checkIfValidOrNot()
    {
        $ipcontroller = $this->IpController;
        $session = $this->di->get("session");
        $weather = $this->di->get("validera3");
        if ($session->has('ipadress')) {
            $ipadress = $session->get("ipadress");
            $resultIp["ipadress"] = $ipadress;
            $resultIp["validerbar"] = $weather->check($ipadress);
            $resultIp["weather"] = $weather->getWeather($ipadress);

            return $resultIp;
        }
        return [];
    }
}
