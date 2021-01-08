<?php


namespace boot;


class pic extends ablum
{
    public $pic;

    public function Pic($type){
        $sql = [
            'create'=>"insert into pci (user, pic, ablum, date) values ('$this->user', '$this->pic', '$this->ablumName', '$this->date')",
            'delete'=>"delete from pci where pic='$this->pic'",
        ];
        $result = $this->connection()->query($sql[$type]);
        if($result) return true;
        else return false;
    }
}