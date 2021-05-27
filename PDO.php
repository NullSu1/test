<?php

//error_reporting(0);
$d = new mysqli_driver();
//$d->report_mode = MYSQLI_REPORT_ALL;

$PDO_conf = array(

	'host'  => '127.0.0.1:3306',

	'db'   => 'test',

	'db2'   => 'iobit',

	'db_user' => 'root',

	'db_pwd' => '',

);

$sql = "INSERT INTO `order`(`id`, `user`, `book_id`, `order`, `date`, `time`, `stats`) VALUES ('','','','','','','') ON DUPLICATE KEY UPDATE `stats`=`stats`+1";
try {
	$conn1 = new mysqli($PDO_conf['host'], $PDO_conf['db_user'], $PDO_conf['db_pwd'], $PDO_conf['db']);

	$conn2 = new mysqli($PDO_conf['host'], $PDO_conf['db_user'], $PDO_conf['db_pwd'], $PDO_conf['db2']);

	$conn1->query("set names 'utf8';");

    $conn2->query("set names 'utf8';");

    $sql = "SELECT insur, count(*) as num FROM `active_gather_class` WHERE 1 group by insur";

    var_dump(microtime());

    $re = $conn1->query($sql, MYSQLI_ASSOC);
    foreach ($re as $item){
        $rows[] = $item;
    }
    var_dump($rows);

    var_dump(microtime());

    $re = $conn2->query($sql, MYSQLI_ASSOC);
    foreach ($re as $item){
        $row[] = $item;
    }
    var_dump($row);

    var_dump(microtime());

} catch (mysqli_sql_exception $e) {
	die('Line '.__LINE__.' : '.$e->getMessage());
}

die();

try{
	$pdo = new pdo("mysql:host=$PDO_conf[host];dbname=$PDO_conf[db]", "$PDO_conf[db_user]", "$PDO_conf[db_pwd]", array(PDO::ATTR_AUTOCOMMIT => 0));
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$re = $pdo->query("SELECT * FROM `rank` WHERE 1", PDO::FETCH_ASSOC);
	foreach ($re as $row){
		var_dump($row);
	}
}catch(PDOException $e) {
	exit('Line '.__LINE__.' : '.$e->getMessage());
}