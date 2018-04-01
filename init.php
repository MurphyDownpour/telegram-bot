<?php

include('vendor/autoload.php');
include('TelegramBot.php');
include('Weather.php');

$telegramApi = new TelegramBot();
$weatherApi = new Weather();



while(true){
    sleep(2);
    $updates = $telegramApi->getUpdates();

    foreach ($updates as $update){
        if(isset($update->message->location)){
            $telegramApi->sendMessage('Окей. Погоди секунду.', $update->message->chat->id);
            sleep(5);
            $result = $weatherApi->getWeather($update->message->location->latitude, $update->message->location->longitude);
            $telegramApi->sendMessage(json_encode($result), $update->message->chat->id);
            sleep(2);
            $telegramApi->sendMessage('Я пока могу отправлять данные в JSON-формате, уж прости. Но скоро, надеюсь, мой создатель это поправит.', $update->message->chat->id);
        }else{
            $telegramApi->sendMessage('Привет. Отправь мне, пожалуйста, свою геопозицию. Я дам тебе информацию о погоде.', $update->message->chat->id);

        }
    }
}

