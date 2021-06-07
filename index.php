<?php
var_dump(strtotime('2021-05-24 23:59:59'));
var_dump(strtotime('2021-05-31 23:59:59'));
echo base64_encode(json_encode(['os'=>'win10','byte'=>'64','ln'=>'zh-cn','type'=>'free']));
die();
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
