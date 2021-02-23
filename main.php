<?php
$affStr = '';
$affStr .= (empty($_GET['aff']) ? (empty($_GET['AFF']) ? '' : $_GET['AFF']) : $_GET['aff']);
var_dump($affStr);