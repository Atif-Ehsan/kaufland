<?php
class Database{
    public $conn;
    public function __construct(){
        $this->conn = mysqli_connect("localhost","root","","kaufland");
        if (!$this->conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
    }
    public function insert($data,$table){
        $coloumns = implode(',',array_keys($data));
        $values = implode("', '",array_values($data));
        if(!mysqli_query($this->conn,"INSERT INTO $table ($coloumns) VALUES ('$values')")){
            $this->conn->error;
        }
    }
}




// CREATE TABLE feeds (
//     id INT AUTO_INCREMENT PRIMARY KEY,
//     entity_id INT(255),
//     category_name TEXT,
//     sku INT(255),
//     name VARCHAR(255),
//     description TEXT DEFAULT NULL,
//     short_description VARCHAR(255) DEFAULT NULL,
//     price INT(255),
//     link VARCHAR(255),
//     image VARCHAR(255)
// );