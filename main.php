<?php

$redis = new Redis();

var_dump($redis->connect('127.0.0.1', 6379));
$arList = $redis->keys("*");
$redis->set('demo', 'kkk');
$redis->del('demo');
var_dump($redis->get('peng'));
var_dump($arList);

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

// dmstr\widgets\Menu::widget(
//            [
//                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
//                'items' => [
//                    ['label' => 'Menu Yii2', 'options' => ['class' => 'header']],
//                    ['label' => 'Gii', 'icon' => 'file-code-o', 'url' => ['/gii']],
//                    ['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug']],
//                    ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
//                    [
//                        'label' => 'Some tools',
//                        'icon' => 'share',
//                        'url' => '#',
//                        'items' => [
//                            ['label' => 'Gii', 'icon' => 'file-code-o', 'url' => ['/gii'],],
//                            ['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug'],],
//                            [
//                                'label' => 'Level One',
//                                'icon' => 'circle-o',
//                                'url' => '#',
//                                'items' => [
//                                    ['label' => 'Level Two', 'icon' => 'circle-o', 'url' => '#',],
//                                    [
//                                        'label' => 'Level Two',
//                                        'icon' => 'circle-o',
//                                        'url' => '#',
//                                        'items' => [
//                                            ['label' => 'Level Three', 'icon' => 'circle-o', 'url' => '#',],
//                                            ['label' => 'Level Three', 'icon' => 'circle-o', 'url' => '#',],
//                                        ],
//                                    ],
//                                ],
//                            ],
//                        ],
//                    ],
//                ],
//            ]
//        )
