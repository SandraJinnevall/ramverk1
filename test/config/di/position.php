<?php
/**
 * Configuration file for DI container.
 */
return [
    "services" => [
        "positionKey" => [
            "shared" => true,
            "callback" => function () {
                $weatherapi = new \Anax\Ip3\Validera3();
                $cfg = $this->get("configuration");
                //laddar filen med nyckeln
                $config = $cfg->load("position_api.php");
                //skickar iväg nyckeln in i klassen. För att sen bli hämtbar
                $weatherapi->getPositionApi($config["config"]["key"]);
                return $weatherapi;
            }
        ],
    ],
];
