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
        </table>
	    ";
	
	
	print $tab_str;
	
} catch (Exception $e) {
	$msg = $e -> getMessage();
	error_log($msg);
}
