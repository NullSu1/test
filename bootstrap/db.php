<?php

namespace boot;
use mysqli;

class db
{
    const DSN = '127.0.0.1';
    const PASS = '';
    const USER = 'root';
    const DBNAME = 'mypic';

    public function connection()
    {
        $conn = new mysqli(self::DSN, self::USER, self::PASS, self::DBNAME);
        if (!$conn->error) {
            return $conn;
        } else {
            return false;
        }
    }
}