<?php
use socket\main\Sock;
require_once "sock.php";

error_reporting(E_ALL ^ E_NOTICE);
//ob_implicit_flush();

$sock = new Sock('127.0.0.1', '8000');

$sock->run();