<?php


namespace boot;
require_once "db.php";


class ablum extends db
{

    public $date;

    public function __construct()
    {
        $this->date = date("Y-m-d H:i:s");
    }

    public function Ablum($type, $user = null, $ablumName = null, $comment = null){
        $sql = [
            'create'=>"insert into ablum (user, ablum, comment, date) values ('$user', '$ablumName', '$comment', '$this->date')",
            'delete' => "delete from ablum where ablum.user='$user' and ablum.ablum='$ablumName'",
            'update' => "update ablum set ablum='$ablumName', comment='$comment'",
            'select' => "select * from ablum where ablum.user='$user'"
        ];
        switch ($type){
            case 'select':
                $num = 0;
                $list = [];
                $result = $this->connection()->query($sql[$type]);
                if($result->num_rows > 0){
                    while($row = $result->fetch_assoc()){
                        $list[$num] = $row;
                        $num++;
                    }
                }
                return $list;
                break;
            default:
                $result = $this->connection()->query($sql[$type]);
                if($result) return true;
                else return false;
                break;
        }
    }
}