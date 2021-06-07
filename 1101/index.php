<?php
//ini_set("display_errors",-1);
//error_reporting(-1);
error_reporting(0);
//mysqli_report(MYSQLI_REPORT_ALL);
session_start();
require_once "main/db.php";
require_once "main/db_config.php";
require_once "main/functions.php";
require_once "main/MysqlQuery.php";

$MysqlQuery = new MysqlQuery($db_book);

$page = empty($_GET['page']) ? 1 : $_GET['page'];

$classlists = $MysqlQuery->getLists('class', '', 'td_demo02');

$date = date('Y-m-d H:i:s');

if (!checkLog()) $_GET['action'] = 'login';

include_once "site/header.php";
include_once "controller.php";
include_once "site/footer.php";
