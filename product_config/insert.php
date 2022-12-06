<?php

use Config\Magento\Product\db;

require_once "config/Dbconfig.php";
require_once "config/db.php";

$users = array('admin' => 'x7HRwgLOTbZl');

if (!isset($users[$_SERVER['PHP_AUTH_USER']]) || $users[$_SERVER['PHP_AUTH_USER']] != $_SERVER['PHP_AUTH_PW']) {
    header('HTTP/1.1 401 Unauthorized');
    header('WWW-Authenticate: Basic realm=""');
    exit('Unauthorized!');
}

$mysql = new db($Db_Magento);
$data = $_POST['data'];

foreach($data as $items) {

    $pdtId = $items['pdtId'];
    $designIndex = $items['designIndex'];
    $textIndex = $items['textIndex'];
    $where = "pdtId='$pdtId' AND designIndex='$designIndex' AND textIndex='$textIndex'";
    $mysql->setSql("SELECT * FROM `porduct_cfg` where 1 AND " . $where);
    $check = $mysql->fetchRows(0);

    if (empty($check)) {
        $insert_sql = "INSERT INTO `porduct_cfg`(`pdtId`, `designIndex`, `textIndex`, `type`, `left`, `top`, `fill`, `angle`, `scaleX`, `scaleY`, `fontSize`, `diameter`, `kerning`, `flipped`, `width`, `height`, `field`)";

        $values = " VALUES ";
        $values .= "('" . addslashes($items['pdtId']) . "',";
        $values .= "'" . addslashes($items['designIndex']) . "',";
        $values .= "'" . addslashes($items['textIndex']) . "',";
        $values .= "'" . addslashes($items['type']) . "',";
        $values .= "'" . addslashes($items['left']) . "',";
        $values .= "'" . addslashes($items['top']) . "',";
        $values .= "'" . addslashes($items['fill']) . "',";
        $values .= "'" . addslashes($items['angle']) . "',";
        $values .= "'" . addslashes($items['scaleX']) . "',";
        $values .= "'" . addslashes($items['scaleY']) . "',";
        $values .= "'" . addslashes($items['fontSize']) . "',";
        $values .= "'" . addslashes($items['diameter']) . "',";
        $values .= "'" . addslashes($items['kerning']) . "',";
        $values .= addslashes($items['flipped']) . ",";
        $values .= "'" . addslashes($items['width']) . "',";
        $values .= "'" . addslashes($items['height']) . "',";
	$values .= "'" . addslashes($items['field']) . "')";


	if (!$mysql->MysqlQuery($insert_sql . $values)) exit($mysql->error);

    } else {
        $update_sql = "UPDATE `porduct_cfg` SET `type`='" . addslashes($items['type']) . "',`left`='" . addslashes($items['left']) . "',`top`='" . addslashes($items['top']) . "',`fill`='" . addslashes($items['fill']) . "',`angle`='" . addslashes($items['angle']) . "',`scaleX`='" . addslashes($items['scaleX']) . "',`scaleY`='" . addslashes($items['scaleY']) . "',`fontSize`='" . addslashes($items['fontSize']) . "',`diameter`='" . addslashes($items['diameter']) . "',`kerning`='" . addslashes($items['kerning']) . "',`flipped`=" . addslashes($items['flipped']) . " ,`width`='" . addslashes($items['width']) . "',`height`='" . addslashes($items['height']) . "',`field`='" . addslashes($items['field']) . "'
                       WHERE " . $where;
        if (!$mysql->MysqlQuery($update_sql)) exit($mysql->error);

    }
}


echo 'true';
