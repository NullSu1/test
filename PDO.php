<?php

error_reporting(E_ALL);
$d = new mysqli_driver();
//$d->report_mode = MYSQLI_REPORT_ALL;

$PDO_conf = array(

	'host'  => '127.0.0.1:3306',

	'db'   => 'test',

	'db2'   => 'iobit',

	'db_pwd' => '',

);

$conn1 = new mysqli($PDO_conf['host'], $PDO_conf['db_user'], $PDO_conf['db_pwd'], $PDO_conf['db']);

//	$conn2 = new mysqli($PDO_conf['host'], $PDO_conf['db_user'], $PDO_conf['db_pwd'], $PDO_conf['db2']);

$sql2 = "SELECT a.`SId` FROM (select * from `sc` where `CId`='01') as a, (select* from `sc` where `CId`='02') as b WHERE a.`score` = b.`score` AND a.`SId`=b.`SId`";
$sql = "SELECT `student`.*, sc.`score` from `sc` join `student` on `sc`.`SId` = `student`.`SId` where `sc`.`SId` IN (" . $sql2 . ") group by `SId`";

$sql3 = "SELECT SId FROM sc GROUP BY SId HAVING avg(score)>80";
$sql4 = "SELECT * FROM `sc` GROUP BY CId";
$result = $conn1->query("$sql4");

if ($result->num_rows > 0) {

    while ($row = $result->fetch_assoc()) {

        $list[] = $row;
    }
}
var_dump($list);



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