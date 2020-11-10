<?php

namespace Anax\Ip;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;

// class Validera implements ContainerInjectableInterface
// {
//     use ContainerInjectableTrait;
//
//     public function check($ipadress)
//     {
//         if (filter_var($ipadress, FILTER_VALIDATE_IP)) {
//             return true;
//         }
//         return false;
//     }
//
//     public function vilkenipv($ipadress)
//     {
//         if (filter_var($ipadress, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
//             return "Ipv6";
//         }
//         if (filter_var($ipadress, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) {
//             return "Ipv4";
//         }
//         return "Undefined";
//     }
//
//     public function domain($ipadress)
//     {
//         if (filter_var($ipadress, FILTER_VALIDATE_IP)) {
//             return gethostbyaddr($ipadress);
//         }
//     }
// }

class CheckjsonController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;

    public function initialize()
    {
        $this->IpController = new Validera();
    }

    public function indexAction() : array
    {
        $ipController = new Validera();
        $ipadress = $this->di->request->getGet("ipjson");

        $json = [
            "ip" => $ipadress,
            "validerbar" => $ipController->check($ipadress),
            "ipv" => $ipController->vilkenipv($ipadress) ?? null,
            "domän" => $ipController->domain($ipadress) ?? null,
        ];

        return [$json];
    }
}
