<?php

namespace Anax\Ip3;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;

class Validera3 implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;

    protected $apiWeatherKey;

    public function getWeatherApi(string $key)
    {
        $this->apiWeatherKey = $key;
    }

    public function getPositionApi(string $key)
    {
        $this->apiPositionKey = $key;
    }

    public function check($ipadress)
    {
        $message = $this->getWeather($ipadress)["message"];
        if ($message === 0) {
            return true;
        }
        return false;
    }

    public function getCurrentIP()
    {
        $ipadress = isset($_SERVER['HTTP_CLIENT_IP']) ? $_SERVER['HTTP_CLIENT_IP'] : isset($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];
        return $ipadress;
    }

    public function getPosition($ipAdress)
    {
        $ch1 = curl_init();

        curl_setopt($ch1, CURLOPT_URL, 'http://api.ipstack.com/'.$ipAdress.'?access_key='.$this->apiPositionKey);
        curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true);

        $multi = curl_multi_init();
        $json = curl_exec($ch1);

        do {
            $status = curl_multi_exec($multi, $active);
            if ($active) {
                curl_multi_select($multi);
            }
        } while ($active && $status == CURLM_OK);

        curl_multi_remove_handle($multi, $ch1);
        curl_multi_close($multi);
        // $curlLink = curl_init('http://api.ipstack.com/'.$ipAdress.'?access_key='.$this->apiPositionKey);
        // curl_setopt($curlLink, CURLOPT_RETURNTRANSFER, true);
        // $json = curl_exec($curlLink);
        // curl_close($curlLink);

        $apiResult = json_decode($json, true);
        $latitude = $apiResult['latitude'];
        $longitude = $apiResult['longitude'];
        $country = $apiResult['country_name'];
        $city = $apiResult['city'];
        $geoInfo = array($latitude, $longitude, $country, $city);
        return $geoInfo;
    }

    public function getWeather($ipAdress)
    {
        $ch1 = curl_init();

        curl_setopt($ch1, CURLOPT_URL, 'http://api.openweathermap.org/data/2.5/forecast?q='.$ipAdress.'&appid='.$this->apiWeatherKey);
        curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true);

        $multi = curl_multi_init();
        $json = curl_exec($ch1);

        do {
            $status = curl_multi_exec($multi, $active);
            if ($active) {
                curl_multi_select($multi);
            }
        } while ($active && $status == CURLM_OK);

        curl_multi_remove_handle($multi, $ch1);
        curl_multi_close($multi);
        // $curlLink = curl_init('http://api.openweathermap.org/data/2.5/forecast?q='.$ipAdress.'&appid='.$this->apiWeatherKey);
        // curl_setopt($curlLink, CURLOPT_RETURNTRANSFER, true);
        // $json = curl_exec($curlLink);
        // curl_close($curlLink);

        $apiResult = json_decode($json, true);
        return $apiResult;
    }
}
