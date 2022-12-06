<?php
function getIP()
{
	if (!empty($_SERVER["HTTP_CLIENT_IP"])) {
		$cip = $_SERVER["HTTP_CLIENT_IP"];
	} elseif (!empty($_SERVER["HTTP_X_FORWARDED_FOR"])) {
		$ip_arr = explode(',', $_SERVER["HTTP_X_FORWARDED_FOR"]);
		$cip = $ip_arr[0];
	} elseif (!empty($_SERVER["REMOTE_ADDR"])) {
		$cip = $_SERVER["REMOTE_ADDR"];
	} else {
		$cip = '';
	}
	return $cip;
}
error_log(date("Y-m-d H:i:s"));
$file = "./";
ini_set('log_errors', 'on');
ini_set('error_log', $file . "erroryes.log");
require 'geoip2.phar';
$reader = new GeoIp2\Database\Reader('GeoLite2-City.mmdb');
echo $ip = '141.164.39.61';
//echo $ip = getIP();
try {
	$record = $reader->city('141.164.39.61');
//	$continent = $record->continent->names['en'];
	$city = $record->city->names['en'];
	var_dump($record->country->names['en']);
	var_dump($record->country->isoCode);
//	error_log("ip:" . getIP() . "  主机时间:" . date("Y-m-d H:i:s") . "   查询地址:" . $ip);
} catch (GeoIp2\Exception\AddressNotFoundException $e) {
	echo 'UNKNOWN';
//	error_log("ip:" . getIP() . "  主机时间:" . date("Y-m-d H:i:s") . "   查询地址:" . $ip);
}