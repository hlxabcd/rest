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
function request_api($url)
{
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, $url);
	curl_setopt($curl, CURLOPT_HEADER, 0);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);//这个是重点。
	$data = curl_exec($curl);
	curl_close($curl);
	return json_decode($data,1);
}
 
try {
	// btc价格
	$url = 'https://www.okex.com/api/v1/future_ticker.do?symbol=btc_usd&contract_type=this_week';
	$data = request_api($url);
	$btc = $data['ticker']['last'];
	
	// ltc价格
	$url = 'https://www.okex.com/api/v1/future_ticker.do?symbol=ltc_usd&contract_type=this_week';
	$data = request_api($url);
	$ltc = $data['ticker']['last'];

	// eth价格
	$url = 'https://www.okex.com/api/v1/future_ticker.do?symbol=eth_usd&contract_type=this_week';
	$data = request_api($url);
	$eth = $data['ticker']['last'];

	// bch价格
	$url = 'https://www.okex.com/api/v1/future_ticker.do?symbol=bch_usd&contract_type=this_week';
	$data = request_api($url);
	$bch = $data['ticker']['last'];
	
	$btcP = $btc+$bch;

	$tab_str = "
	    <table border=\"1\" width=\"80%\" align=\"center\">
	        <tr>
                <td width=\"100%\"></td><td width=\"100%\">OKcoin</td>
            </tr>
            <tr>
                <td width=\"100%\">BTC</td><td width=\"100%\">{$btc}</td>
            </tr>
            <tr>
                <td width=\"100%\">LTC</td><td width=\"100%\">{$ltc}</td>
            </tr>
            <tr>
                <td width=\"100%\">ETH</td><td width=\"100%\">{$eth}</td>
            </tr>
            <tr>
                <td width=\"100%\">BCC</td><td width=\"100%\">{$bch}</td>
            </tr>
            <tr>
                <td width=\"100%\">BTC+BCC</td><td width=\"100%\">{$btcP}</td>
            </tr>
        </table>
	    ";
	
	
	print $tab_str;
	
} catch (Exception $e) {
print_r($e);
	$msg = $e -> getMessage();
	error_log($msg);
}
