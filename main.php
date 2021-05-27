<?php
$redis = new Redis();

var_dump($redis->connect('127.0.0.1', 6379));
$arList = $redis->keys("*");
$redis->set('demo', 'kkk','3');
$redis->incr('demo');
//sleep('10');
//$redis->del('demo');
//var_dump($redis->get('peng'));
echo microtime();
$num = 0;
while ($redis->get('demo')){
	$num ++;
}
var_dump($num);
echo microtime();

die();

$mysql_conf = array(

	'host'  => '127.0.0.1:3306',

	'db'   => 'test',

	'db_user' => 'root',

	'db_pwd' => '',

);

$mysqli = @new mysqli($mysql_conf['host'], $mysql_conf['db_user'], $mysql_conf['db_pwd']);

if ($mysqli->connect_errno) {

	die("could not connect to the database:\n" . $mysqli->connect_error);//诊断连接错误

}

$mysqli->query("set names 'utf8';");

$select_db = $mysqli->select_db($mysql_conf['db']);

if ($result = $mysqli->query("SELECT * from rank")) {
	var_dump($result->num_rows);
	$row = $result->fetch_row();
	printf("Default database is %s.\n", $row[0]);
	$result->close();
}

echo strtotime("2020-10-13 23:59:59");
