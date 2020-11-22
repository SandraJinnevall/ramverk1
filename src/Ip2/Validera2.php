<?php

namespace Anax\Ip2;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;

class Validera2 implements ContainerInjectableInterface
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

    public function getPosition($ipAdress)
    {
        $accessKey = 'f5afb01ded414d8fcb93fa58a34ca501';
        $curlLink = curl_init('http://api.ipstack.com/'.$ipAdress.'?access_key='.$accessKey.'');
        curl_setopt($curlLink, CURLOPT_RETURNTRANSFER, true);
        $json = curl_exec($curlLink);
        curl_close($curlLink);

        $apiResult = json_decode($json, true);
        $latitude = $apiResult['latitude'];
        $longitude = $apiResult['longitude'];
        $country = $apiResult['country_name'];
        $city = $apiResult['city'];
        $geoInfo = array($latitude, $longitude, $country, $city);
        return $geoInfo;
    }


    public function getCurrentIP()
    {
        $ipadress = isset($_SERVER['HTTP_CLIENT_IP']) ? $_SERVER['HTTP_CLIENT_IP'] : ((isset($_SERVER['HTTP_X_FORWARDED_FOR'])) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR']);
        return $ipadress;
    }
}
