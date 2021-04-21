<?php
error_reporting(0);
mysqli_report(MYSQLI_REPORT_ALL);

require_once "main/db.php";
require_once "main/db_config.php";
require_once "main/getList.php";
include_once "main/MysqlQuery.php";

$page = empty($_GET['page']) ? 1 : $_GET['page'];

$MysqlQuery = new MysqlQuery($db_book);

$classlists = $MysqlQuery->getLists('class', '', 'td_demo02');

$date = date('Y-m-d H:i:s');

include_once "site/view.php";