<?php
require_once "config/web.php";
require_once "controller/DB.php";
require_once "controller/orderInfo.php";

$queryStr=empty($_SERVER['QUERY_STRING'])?'':$_SERVER['QUERY_STRING'];
$order_Info = new export\controller\orderInfo($db, $queryStr);

$field = $order_Info->getField();
$filename = 'order-info_'.date('Y-m-d').'.xls';

$excelData = implode("\t",$field)."\n";

foreach ($order_Info->getOrderInfo() as $items){
    $lineData = array_values($items);
    $excelData .= implode("\t", $lineData)."\n";
}

ob_end_clean();
ob_start();
header("Content-Type:application/vnd.ms-excel;charset=UTF-8");
header("Content-Disposition: attachment; filename=".$filename);
header('Cache-Control: max-age=0');
echo $excelData;

exit;
