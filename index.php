<?php
require_once (dirname(__FILE__) . '/OKCoin/OKCoin.php');

const API_KEY = "OKCoin提供的api_key";
const SECRET_KEY = "OKCoin提供的secret_key";

$value = array(
    'btc' => 0.3894, 
    'ltc' => 26.017,
    'eth' => 19.27,
    'rmb' => 3.78,
);
 
try {

	//OKCoin DEMO 入口
	$client = new OKCoin(new OKCoin_ApiKeyAuthentication(API_KEY, SECRET_KEY));
	//获取OKCoin行情（盘口数据）
	$params = array('symbol' => 'btc_cny');
	$btcInfo = $client -> tickerApi($params);
	
	//获取OKCoin行情（盘口数据）
	$params = array('symbol' => 'ltc_cny');
	$ltcInfo = $client -> tickerApi($params);
	
	//获取OKCoin行情（盘口数据）
	$params = array('symbol' => 'eth_cny');
	$ethInfo = $client -> tickerApi($params);

	//获取via Bcc行情
	$url = 'https://www.viabtc.com/api/v1/market/ticker?market=BCCCNY';
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, $url);
	curl_setopt($curl, CURLOPT_HEADER, 0);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);//这个是重点。
	$data = curl_exec($curl);
	curl_close($curl);
	$bccInfo = json_decode($data);

	$tab_str = "
	    <table border=\"1\" width=\"80%\" align=\"center\">
	        <tr>
                <td width=\"100%\"></td><td width=\"100%\">OKcoin</td>
            </tr>
            <tr>
                <td width=\"100%\">BTC</td><td width=\"100%\">{$btcInfo->ticker->last}</td>
            </tr>
            <tr>
                <td width=\"100%\">LTC</td><td width=\"100%\">{$ltcInfo->ticker->last}</td>
            </tr>
            <tr>
                <td width=\"100%\">ETH</td><td width=\"100%\">{$ethInfo->ticker->last}</td>
            </tr>
            <tr>
                <td width=\"100%\">BCC</td><td width=\"100%\">{$bccInfo->data->ticker->last}</td>
            </tr>
        </table>
	    ";
	
	
	print $tab_str;
	
} catch (Exception $e) {
print_r($e);
	$msg = $e -> getMessage();
	error_log($msg);
}
