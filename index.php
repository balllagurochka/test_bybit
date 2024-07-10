<?php
$connect = require_once "connect.php";
$query = mysqli_query($connect, "SELECT * FROM klines");
$klines_list = [];

while ($row = mysqli_fetch_assoc($query)) {
    $klines_list[] = $row;
}
$klines_list = array_reverse($klines_list);

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://unpkg.com/lightweight-charts/dist/lightweight-charts.standalone.production.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Document</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
    </style>
</head>
<body>
<div id="chart" class="container">
    <script>
        const chart = LightweightCharts.createChart(document.getElementById('chart'), {
            width: 1200,
            height: 400,
            layout: {
                backgroundColor: '#ffffff',
                textColor: '#333',
            },
            grid: {
                vertLines: {
                    color: '#e0e0e0',
                },
                horzLines: {
                    color: '#e0e0e0',
                },
            },
            crosshair: {
                mode: LightweightCharts.CrosshairMode.Normal,
            },
        });

        const candleSeries = chart.addCandlestickSeries({
            upColor: '#4b861e',
            borderUpColor: '#4b861e',
            wickUpColor: '#4b861e',
            downColor: '#af2837',
            borderDownColor: '#af2837',
            wickDownColor: '#af2837',
            borderVisible: true,
            borderColor: '#378658',
        });

        let data = []
        <?php
        foreach ($klines_list as $kline){
        ?>
        data.push(
            {
                open: <?= $kline['open_price'] ?>,
                high: <?= $kline['high_price'] ?>,
                low: <?= $kline['low_price'] ?>,
                close: <?= $kline['close_price'] ?>,
                time: new Date(<?= $kline['start_time'] ?>).toISOString() ,
            }
        );

        <?php
        }
        ?>


        candleSeries.setData(data);
        chart.timeScale().fitContent();

    </script>
</div>

</body>
</html>












