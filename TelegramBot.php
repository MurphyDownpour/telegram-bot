<?php

use GuzzleHttp\Client;

class TelegramBot
{
    protected $token = "567868369:AAFX531djA8F2OtHaF_P0yDk8TYyHEWoVS4";

    protected $update_id;

    protected function query($method, $params = [])
    {
        $url = "https://api.telegram.org/bot";
        $url .= $this->token;
        $url .= "/" . $method;

        if(!empty($params)){
            $url .= "?" . http_build_query($params);
        }

        $client = new Client([
            "base_uri" => $url
        ]);

        $result = $client->request('GET');

        return json_decode($result->getBody());
    }

    public function getUpdates()
    {
        $response = $this->query('getUpdates', [
            "offset" => $this->update_id + 1
        ]);
        if(!empty($response->result)){
            $this->update_id = $response->result[count($response->result) - 1]->update_id;
        }
        return $response->result;
    }

    public function sendMessage($text, $chat_id)
    {
        $response = $this->query('sendMessage', [
            'text' => $text,
            'chat_id' => $chat_id
        ]);

        return $response;
    }
}