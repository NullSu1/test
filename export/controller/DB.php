<?php
namespace export\controller;

use mysqli;

class DB
{
    /**
     * Db config
    */
    private array $db;
    private $query;

    function __construct(
        $db,
        $query = '')
    {
        $this->db = $db;
        $this->query = $query;
    }

    public function getDbConnect(){
        $config = $this->db;
        $connect = new mysqli($config['host'],$config['name'],$config['pasword'],$config['database']);
        if($connect){
            $connect->query('SET NAMES utf8');
            return $connect;
        }
        return false;
    }

    /**
     * @param string $table
     * @param string $field
     * @param string $where
     * @param string $other
     * @return string
     */
    public function getQuery($table='', $field='', $where='', $other=''): string
    {
        return "SELECT $field FROM $table ". ($where ? 'WHERE '.$where : '')." $other";
    }
}