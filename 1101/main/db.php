<?php

namespace main;

use Exception;
use mysqli;

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
		try{
			$conn = new mysqli($this->host['host'], $this->host['user'], $this->host['passwd'], $this->host['db']);

			$conn->query("set names 'utf8';");

			return $conn;

		}catch (exception $e){

			die('Line '.__LINE__.' : '.$e->getMessage());
		}
	}

    /**
     * @param $sql
     * @return array
     */
    function selectQuery($sql)
    {
        $list = [];

        $result = $this->Conn()->query($sql);

        if ($result->num_rows > 0) {

            while ($row = $result->fetch_assoc()) {

                $list[] = $row;
            }
        }
        return $list;
    }
}
