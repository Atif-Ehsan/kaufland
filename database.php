<?php
class Database{
    public $conn;
    public function __construct(){
        $this->conn = mysqli_connect(HOST_NAME,USER_NAME,PASSWORD,DATABASE_NAME); // Crating a connection with the database.
        if (!$this->conn) { // to check if the connection with the database is successfull
            file_put_contents(ERROR_FILE,mysqli_connect_error()."\n",FILE_APPEND); // if connection is not successfull then write the errors in the log file. 
        }
    }
    public function insert($data,$table){ // function to insert the data into the table.
        $coloumns = implode(',',array_keys($data));
        $values = implode("', '",array_values($data));
        $query = "INSERT INTO $table ($coloumns) VALUES ('$values')";
        if(!mysqli_query($this->conn,$query)) { // condition to check if the query is successfull.
            file_put_contents(ERROR_FILE,mysqli_connect_error()."\n",FILE_APPEND); // if query is not successfull then writing the error to the log file.
        }
    }
}