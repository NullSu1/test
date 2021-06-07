<?php


use main\db;

class MysqlQuery extends db
{
    function __construct($host)
    {
        parent::__construct($host);
    }

    function __bookWhere($user){

    }
    function __orderWhere(){

    }

    /**
     * @param $sqlstr
     * @param $pagesize
     * @param bool $type
     * @return array
     */
    function Paging($sqlstr, $pagesize, $type = true){

        $total = $this->selectQuery($sqlstr);

        $pagecount = ceil(count($total) / $pagesize);

        $page = empty($_GET['page']) ? '1' : $_GET['page'];

        $page = ($page <= $pagecount) ? $page : $pagecount;

        $f_pageNum = $pagesize * ($page - 1);

        $sqlstr1 = $sqlstr . " limit " . $f_pageNum . "," . $pagesize;

        if($type){

            return $this->selectQuery($sqlstr1);
        }

        echo "共" . count($total) . "本图书&nbsp;&nbsp;";

        echo "第" . $page . "页/共" . $pagecount . "页&nbsp;&nbsp;";

        if ($page != 1) {

            echo "<a href='?action=". $_GET['action'] ."&book=". $_GET['book'] ."&class=". $_GET['class'] ."&page=1'>首页</a>&nbsp;";

            echo "<a href='?action=". $_GET['action'] ."&book=". $_GET['book'] ."&class=". $_GET['class'] ."&page=" . ($page - 1) . "'>上一页</a>&nbsp;&nbsp;";

        } else {

            echo "首页&nbsp;上一页&nbsp;&nbsp;";
        }

        if ($page != $pagecount) {//如果当前页不是最后一页则输出有链接的下一页和尾页

            echo "<a href='?action=". $_GET['action'] ."&book=". $_GET['book'] ."&class=". $_GET['class'] ."&page=" . ($page + 1) . "'>下一页</a>&nbsp;";

            echo "<a href='?action=". $_GET['action'] ."&book=". $_GET['book'] ."&class=". $_GET['class'] ."&page=" . $pagecount . "'>尾页</a>&nbsp;&nbsp;";

        } else {

            echo "下一页&nbsp;尾页&nbsp;&nbsp;";
        }
    }

    /**
     * @param $sql
     * @return bool
     */
    function changeQuery($sql){

        $this->conn->query($sql);

        if($this->conn->affected_rows > 0){

            return true;
        }
        return false;
    }

    /**
     * @param $sql
     * @return array
     */
    function selectQuery($sql)
    {
        $list = [];

        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {

            while ($row = $result->fetch_assoc()) {

                $list[] = $row;
            }
        }
        return $list;
    }

    /**
     * @param string $item
     * @param string $db
     * @param string $table
     * @return array
     */
    function getLists($item = '', $db = '', $table = ''){

        if(!empty($db))
            $this->conn->select_db($db);

        $sql = "select $item from `$table` where 1 group by $item";

        return $this->selectQuery($sql);
    }
}