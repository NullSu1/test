<?php

namespace boot;
require_once "db.php";

class singin extends db
{
    public $user;
    public $pass;

    public function __construct($pass, $user)
    {
        $this->pass = $pass;
        $this->user = $user;
    }

    public function checkUser()
    {
        $sql = "select id from userInfo where user='$this->user'";
        $result = $this->connection()->query($sql)->fetch_assoc();
        if (empty($result['id'])) return false;
        else return true;
    }

    public function checkPass()
    {
        $sql = "select passw from userInfo where user='$this->user'";
        $result = $this->connection()->query($sql)->fetch_assoc();
        if ($result['passw'] != $this->pass) return false;
        else return true;
    }
}