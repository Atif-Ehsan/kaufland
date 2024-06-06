<?php
class Database{
    public $conn;
    public function __construct(){
        $this->conn = mysqli_connect(HOST_NAME,USER_NAME,PASSWORD,DATABASE_NAME);
        if (!$this->conn) {
            // echo "fkdflfj";
            file_put_contents('errors.log',mysqli_connect_error()."\n",FILE_APPEND);
        }
    }
    public function insert($data,$table){
        $coloumns = implode(',',array_keys($data));
        $values = implode("', '",array_values($data));
        $query = "INSERT INTO $table ($coloumns) VALUES ('$values')";
        if(!mysqli_query($this->conn,$query)) {
            file_put_contents('errors.log',mysqli_connect_error()."\n",FILE_APPEND);
        }
    }
}