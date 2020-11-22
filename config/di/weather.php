<?php
/**
 * Configuration file for DI container.
 */
return [
    "services" => [
        "validera3" => [
            "shared" => true,
            "callback" => function () {
                $weatherapi = new \Anax\Ip3\Validera3();
                $cfg = $this->get("configuration");
                //laddar filen med nyckeln
                $config = $cfg->load("weather_api.php");
                //skickar iväg nyckeln in i klassen. För att sen bli hämtbar
                $weatherapi->getWeatherApi($config["config"]["key"]);
                return $weatherapi;
            }
        ],
    ],
];
