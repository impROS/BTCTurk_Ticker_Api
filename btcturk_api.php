<?php
$BASE_URL = "https://api.btcturk.com/api/v2/ticker";
$ch = curl_init($BASE_URL);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$arrCoin = curl_exec($ch);

curl_close($ch);
//print_r($arrCoin);
$arrCoin = json_decode($arrCoin, true);
$arrCoin = $arrCoin["data"];

$arrPair = array(
    "BTCTRY" => 2,//1
    "ETHTRY" => 2,//2
    "XRPTRY" => 2,//3
    "LTCTRY" => 2,//4
    "USDTTRY" => 2,//5
    "XLMTRY" => 4,//6
    "NEOTRY" => 2,//7
    "BTCUSDT" => 2,//8
    "ETHUSDT" => 2,//9
    "XRPUSDT" => 3,//10
    "LTCUSDT" => 2,//11
    "XLMUSDT" => 3,//12
    "NEOUSDT" => 2,//13
    "ETHBTC" => 4,//14
    "LTCBTC" => 5,//15
    "XRPBTC" => 7,//16
    "XLMBTC" => 7,//17
    "NEOBTC" => 5//18
);
$counter = 0;
$arrCoinNew = array();
//echo json_encode($arrCoin);
foreach ($arrPair as $key => $value) {
    $date = new DateTime();
    $coin = array(
        'pair' => $key,
        'pairNormalized' => '_',
        'timestamp' => $date->getTimestamp(),
        'last' => 0,
        'high' => 0,
        'low' => 0,
        'bid' => 0,
        'ask' => 0,
        'open' => 0,
        'volume' => 0,
        'average' => 0,
        'daily' => 0,
        'dailyPercent' => 0,
        'denominatorSymbol' => "-",
        'numeratorSymbol' => "-",
        'order' => 0,
    );
    array_push($arrCoinNew, $coin);
}//END_foreach

foreach ($arrCoin as $tmpCoin) {
    for ($i = 0; $i < count($arrCoinNew); $i++) {

        if ($tmpCoin['pair'] == $arrCoinNew["$i"]['pair']) {
//            echo "</br>" . $tmpCoin['pair'] . "- " . $arrCoinNew["$i"]['pair'] . "</br>";
            $arrCoinNew["$i"]['pairNormalized'] = $tmpCoin['pairNormalized'];
            $arrCoinNew["$i"]['timestamp'] = $tmpCoin['timestamp'];
            $arrCoinNew["$i"]['last'] = number_format($tmpCoin['last'], 2, '.', '');
            $arrCoinNew["$i"]['high'] = number_format($tmpCoin['high'], 2, '.', '');
            $arrCoinNew["$i"]['low'] = number_format($tmpCoin['low'], 2, '.', '');
            $arrCoinNew["$i"]['bid'] = number_format($tmpCoin['bid'], 2, '.', '');
            $arrCoinNew["$i"]['ask'] = number_format($tmpCoin['ask'], 2, '.', '');
            $arrCoinNew["$i"]['open'] = number_format($tmpCoin['open'], 2, '.', '');
            $arrCoinNew["$i"]['volume'] = number_format($tmpCoin['volume'], 2, '.', '');
            $arrCoinNew["$i"]['average'] = number_format($tmpCoin['average'], 2, '.', '');
            $arrCoinNew["$i"]['daily'] = number_format($tmpCoin['daily'], 2, '.', '');
            $arrCoinNew["$i"]['dailyPercent'] = number_format($tmpCoin['dailyPercent'], 2, '.', '');
            $arrCoinNew["$i"]['denominatorSymbol'] = $tmpCoin['denominatorSymbol'];
            $arrCoinNew["$i"]['numeratorSymbol'] = $tmpCoin['numeratorSymbol'];
            $arrCoinNew["$i"]['order'] = $tmpCoin['order'];
        }
    }
}
echo json_encode($arrCoinNew);
?>
