<?php

namespace main;

use Exception;
use mysqli;

class db {

    public $host;
    public $conn;

    function __construct($host)
    {
        try{
            $this->conn = new mysqli($host['host'], $host['user'], $host['passwd'], $host['db']);

            $this->conn->query("set names 'utf8';");

            return $this->conn;

        }catch (exception $e){

            die('Line '.__LINE__.' : '.$e->getMessage());
        }
    }
}
