<?php
ini_set("display_errors", 1);
error_reporting(E_ALL ^ E_NOTICE);
define('ADMIN_USERNAME', 'admin');     // Admin Username
define('ADMIN_PASSWORD', 'x7HRwgLOTbZl');      // Admin Password
require_once "config/web.php";
require_once "controller/DB.php";
require_once "controller/orderInfo.php";

if (!isset($_SERVER['PHP_AUTH_USER']) || !isset($_SERVER['PHP_AUTH_PW']) ||
    $_SERVER['PHP_AUTH_USER'] != ADMIN_USERNAME || $_SERVER['PHP_AUTH_PW'] != ADMIN_PASSWORD) {
    Header("WWW-Authenticate: Basic realm=''");
    Header("HTTP/1.0 401 Unauthorized");
    exit('Unauthorized');
}
$queryStr=empty($_SERVER['QUERY_STRING'])?'':$_SERVER['QUERY_STRING'];
$order_Info = new export\controller\orderInfo($db, $queryStr);

require_once "html.php";
