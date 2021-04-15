<?php

class db {

    public array $host;

    function __construct($host)
    {
        $this->host = $host;
    }

    /**
     * @return mysqli
     */
    function Conn(){
		mysqli_report(MYSQLI_REPORT_ALL);

		try{
			$conn = new mysqli($this->host['host'], $this->host['user'], $this->host['passwd'], $this->host['db']);

			$conn->query("set names 'utf8';");

			return $conn;

		}catch (exception $e){

			die('Line '.__LINE__.' : '.$e->getMessage());
		}
	}
}
