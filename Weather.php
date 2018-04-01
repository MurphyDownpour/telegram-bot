<?php

use GuzzleHttp\Client;

class Weather
{
    protected $token = "1c7cd773f41ec5e45b635bef038a5a20";

    public function getWeather($lat, $lon)
    {
        $url = "api.openweathermap.org/data/2.5/weather";

        $params = [];
        $params['lat'] = $lat;
        $params['lon'] = $lon;
        $params['APPID'] = $this->token;

        $url .= "?" . http_build_query($params);

        $client = new Client([
            'base_uri' => $url
        ]);

        $result = $client->request('GET');

        return json_decode($result->getBody());
    }
}