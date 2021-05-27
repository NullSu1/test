<?php
var_dump(strtotime('2021-6-19 23:59:59'));
var_dump(strtotime('2021-05-19 19:17:44'));
var_dump(date('Y-m-d H:i:s',strtotime("-16 hours")));
var_dump(strtotime("-16 hours"));


$db_book = [
    'host' => '127.0.0.1',
    'user' => 'root',
    'passwd' => '',
    'db' => 'book'
];

mysqli_report(MYSQLI_REPORT_ALL);
function Conn($db_book)
{
    try {
        $conn = new mysqli($db_book['host'], $db_book['user'], $db_book['passwd'], $db_book['db']);

        $conn->query("set names 'utf8';");

        return $conn;

    } catch (exception $e) {

        die('Line ' . __LINE__ . ' : ' . $e->getMessage());
    }
}

$new = Conn($db_book);

$sql = "SELECT `td_demo02`.`cover_art`, `td_demo02`.`pri`, `order`.`order` FROM (`order` join `td_demo02` on `order`.`book_id`=`td_demo02`.`id`) WHERE `order`.`user`='张三' and `order`.`book_id`=5";
$new->query($sql);
var_dump($new->query($sql)->fetch_assoc());
