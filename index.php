<?php
header("Content-type: text/html; charset=utf8");
ini_set('memory_limit', '1024M');
set_time_limit(0);
$dir = dirname(__FILE__).'/';
$row = 1;
$file = fopen($dir.'a.csv', "r");
# 结果
$res = array();
# 计数标示
$header = [];
$flag = false;
$i = 0;
while ($data = fgetcsv($file)) {
    if (!$flag) {
        $header = $data;
        $flag = true;
    } else {
        $temp = array_slice($data, 0,11);
        foreach ($temp as $key => $value) {
            $index = $header[$key];
            $res[$i][$index] = trim(htmlspecialchars(strip_tags($value)));
        }
        $i++;
    }
}
//echo "<pre>";
$fp = fopen('need.csv', 'w');
//$file = fopen("J.json", "w") or die("Unable to open file!");

foreach ($res as $rows) {
    fputcsv($fp, $rows);
}
fclose($file);

