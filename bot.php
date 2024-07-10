<?php
require_once 'vendor/autoload.php';
use Telegram\Bot\Api;

$connect = require_once "connect.php";
$query = mysqli_query($connect, "SELECT * FROM klines");
$klines = [];

while ($row = mysqli_fetch_assoc($query)) {
    $klines[] = $row;
}

$botToken = "7136788852:AAEYJfSQQvp_RLSZ5NUt-J0DHOriXQms87w";
$telegram = new Api($botToken);

$update = $telegram->getWebhookUpdate();
$date = date('d-M-Y', $klines[0]['start_time'] / 1000);

if ($update->getMessage()) {
    $chatId = $update->getMessage()->getChat()->getId();
    $text = $update->getMessage()->getText();

    if ($text == "/kurs") {
        $telegram->sendMessage([
            'chat_id' => $chatId,
            'text' => "Курс BTC = \ndate : $date\nopen price : " . $klines[0]['open_price'] . "$\nhigh price : " . $klines[0]['high_price'] . "$\nlow price : " . $klines[0]['low_price'] . "$\nclose price : " . $klines[0]['close_price'] . "$\nvolume : " . $klines[0]['volume'] . "\nturnover : " . $klines[0]['turnover'],
            'reply_markup' => json_encode([
                'inline_keyboard' => [
                    [
                        ['text' => 'Подробнее', 'url' => 'https://cp20475.tw1.ru/']
                    ]
                ]
            ])
        ]);
    } else {
        $telegram->sendMessage([
            'chat_id' => $chatId,
            'text' => "Вы написали: " .  $text
        ]);
    }
} else {
    http_response_code(200);
    exit;
}