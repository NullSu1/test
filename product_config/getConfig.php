<?php

use Config\Magento\Product\db;

define('ADMIN_USERNAME', 'admin');     // Admin Username
define('ADMIN_PASSWORD', 'x7HRwgLOTbZl');      // Admin Password

if (!isset($_SERVER['PHP_AUTH_USER']) || !isset($_SERVER['PHP_AUTH_PW']) ||
    $_SERVER['PHP_AUTH_USER'] != ADMIN_USERNAME || $_SERVER['PHP_AUTH_PW'] != ADMIN_PASSWORD) {
    Header("WWW-Authenticate: Basic realm=''");
    Header("HTTP/1.0 401 Unauthorized");
    exit('Unauthorized');
}

include "demo.php";
