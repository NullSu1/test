<?php
$arr_date = [
    '23' => '02',
];
$arr_onlya = [
    '02' => '20',
    '' => '100'
];
var_dump(date('H'));
$day = date('d');
if(date('H') >= $arr_date[$day]){
    echo $onlya = $arr_onlya[date('H')];
}
if(1){
    exit();
    echo 1;
}