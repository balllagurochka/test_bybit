<?php
$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://api-testnet.bybit.com/v5/market/kline?category=linear&symbol=BTCUSDT&interval=D',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'GET',
    CURLOPT_SSL_VERIFYPEER => false,
));

$response = curl_exec($curl);
$decoded_json = json_decode($response, true);
$klines_list = $decoded_json['result']['list'];
curl_close($curl);

return $klines_list;