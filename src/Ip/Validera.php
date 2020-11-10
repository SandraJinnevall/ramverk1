<?php

namespace Anax\Ip;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;

class Validera implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;

    public function check($ipadress)
    {
        if (filter_var($ipadress, FILTER_VALIDATE_IP)) {
            return true;
        }
        return false;
    }

    public function domain($ipadress)
    {
        if (filter_var($ipadress, FILTER_VALIDATE_IP)) {
            return gethostbyaddr($ipadress);
        }
    }

    public function vilkenipv($ipadress)
    {
        if (filter_var($ipadress, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) {
            return "Ipv6";
        }
        if (filter_var($ipadress, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
            return "Ipv4";
        }
        return "Undefined";
    }
}
