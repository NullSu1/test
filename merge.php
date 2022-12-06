<?php
$word = "a";
//$a = preg_replace("/\s(?=\s)/","\\1",$a);
$word = trim(preg_replace("|[a-zA-Z/]+|",' ',$word));
//var_dump($word);
if(!strlen($word)) echo 0;
$word_arr = explode(' ',$word);
$needle = [];
for($i = 0; $i < count($word_arr); $i++){
    if(in_array($word_arr[$i], array_keys($needle))){
        continue;
    }
    $needle[$word_arr[$i]] = $i;
}
echo count($needle);