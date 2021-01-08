<?php
$file = "./";
ini_set('log_errors','on');
ini_set('error_log',$file."erroryes.log");
require 'geoip2.phar';
$reader = new GeoIp2\Database\Reader('GeoLite2-City.mmdb');
echo $ip = $_SERVER['REMOTE_ADDR'];
try {
    $record = $reader->city($ip);
    $continent = $record->continent->names['en'];
    $city = $record->city->names['en'];
    var_dump($record->country->isoCode);
    error_log("ip:".$_SERVER['REMOTE_ADDR']."  主机时间:".date("Y-m-d H:i:s")."   查询地址:".$ip);
} catch (GeoIp2\Exception\AddressNotFoundException $e) {
    echo 'UNKNOWN';
    error_log("ip:".$_SERVER['REMOTE_ADDR']."  主机时间:".date("Y-m-d H:i:s")."   查询地址:".$ip);
}
//$conn->affected_rows;