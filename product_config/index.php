<?php
header('Access-Control-Allow-Origin: *');
use Config\Magento\Product\db;

require_once "config/Dbconfig.php";
require_once "config/db.php";
if($_GET['a'] != 'get')
    exit();

$config = new db($Db_Magento);

$pid = addslashes($_GET['pid']);

$config->setSql("SELECT * FROM `porduct_cfg` WHERE 1 AND pdtId='$pid'");

$re = $config->fetchRows(1);
echo (json_encode($re));

exit();
