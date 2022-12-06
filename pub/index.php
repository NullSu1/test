<?php
$result = '123';
function a(){
    global $result;
    return $result;
}
echo a();