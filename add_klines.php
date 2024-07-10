<?php
$klines_list = require_once "curl_config.php";
$connect = require_once "connect.php";

define("START_TIME_INDEX", 0);
define("OPEN_PRICE_INDEX", 1);
define("HIGH_PRICE_INDEX", 2);
define("LOW_PRICE_INDEX", 3);
define("CLOSE_PRICE_INDEX", 4);
define("VOLUME_INDEX", 5);
define("TURNOVER_INDEX", 6);

foreach ($klines_list as $kline) {
    $kline_start_time_index = floatval($kline[START_TIME_INDEX]);
    $kline_open_price_index = floatval($kline[OPEN_PRICE_INDEX]);
    $kline_high_price_index = floatval($kline[HIGH_PRICE_INDEX]);
    $kline_low_price_index = floatval($kline[LOW_PRICE_INDEX]);
    $kline_close_price_index = floatval($kline[CLOSE_PRICE_INDEX]);
    $kline_volume_index = floatval($kline[VOLUME_INDEX]);
    $kline_turnover_index = $kline[TURNOVER_INDEX];
    mysqli_query($connect, "INSERT INTO `klines`(`id`, `start_time`, `open_price`, `high_price`, `low_price`, `close_price`, `volume`, `turnover`) 
                        VALUES (NULL, 
                                $kline_start_time_index, 
                                CAST($kline_open_price_index AS DECIMAL(10,2)), 
                                CAST($kline_high_price_index AS DECIMAL(10,2)), 
                                CAST($kline_low_price_index AS DECIMAL(10,2)), 
                                CAST($kline_close_price_index AS DECIMAL(10,2)), 
                                CAST($kline_volume_index AS DECIMAL(10,2)), 
                                CAST($kline_turnover_index AS DECIMAL(22,4)))");
}