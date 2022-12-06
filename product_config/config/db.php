<?php
namespace Config\Magento\Product;

use Exception;
use mysqli;
use mysqli_result;

class db
{
    /**
     * connection database config
     * @param array $host
     */
    protected $host;
    /**
     * @var mysqli
     */
    protected $conn;
    /**
     * @var string
     */
    public $error;
    /**
     * @var string
     */
    private $sql;

    function __construct($host){
        try{
            $this->conn = new mysqli($host['host'], $host['user'], $host['passwd'], $host['db']);

            $this->conn->query("set names 'utf8';");

            return $this->conn;

        }catch (exception $e){

            die('Line '.__LINE__.' : '.$e->getMessage());
        }
    }

    /**
     * @param $sql
     */
    public function setSql($sql)
    {
        $this->sql = $sql;
    }

    /**
     * 执行sql语句
     *
     * @param string $sql
     *
     * @return bool|mysqli_result
     */
    public function MysqlQuery(string $sql = ''){
        if(empty($sql))

            $sql = $this->sql;

        $result = $this->conn->query($sql);

        return $result;
    }

    /**
     * 查询数据
     *
     * @param $sql
     * @param int $is_multi
     *
     * @return array|false|null
     */
    public function fetchRows(int $is_multi = 0)
    {
        $result = $this->mysqlQuery($this->sql);
        if (!$result) {
            $this->error = $this->conn->error;
            return false;
        }

        $arr = array();
        if ($is_multi == 0) {
            //单条返回
            $arr = $result->fetch_assoc();
        } else {
            //返回多条
            while ($row = $result->fetch_assoc()) {
                $arr[] = $row;
            }
        }

        return $arr;
    }

    /**
     * @param $sql
     * @param $where
     * @return string
     */
    public function setWhere($sql, $where): string
    {

        return $sql.$where;
    }
}
