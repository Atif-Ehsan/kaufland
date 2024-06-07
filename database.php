<?php
/*
    This file creates a database class and implements basic functions to add data into the table.
*/
class Database
{
    public $conn;
    public function __construct()
    {
        $this->conn = mysqli_connect(HOST_NAME, USER_NAME, PASSWORD);

        if (!$this->conn) {
            file_put_contents(ERROR_FILE, mysqli_connect_error() . "\n", FILE_APPEND);
            die();
        }

        $this->createDatabase();

        mysqli_select_db($this->conn, DATABASE_NAME);

        $this->createTable();

    }
    public function createDatabase()
    {
        $query = "CREATE DATABASE if not exists " . DATABASE_NAME;
        if (!mysqli_query($this->conn, $query)) {
            file_put_contents(ERROR_FILE, mysqli_error($this->conn) . "\n", FILE_APPEND);
            die();
        }
    }
    public function createTable()
    {
        $query = "CREATE TABLE if not exists " . TABLE_NAME . " (
            `id` int(11) NOT NULL,
            `entity_id` int(255) DEFAULT NULL,
            `category_name` text DEFAULT NULL,
            `sku` int(255) DEFAULT NULL,
            `name` varchar(255) DEFAULT NULL,
            `description` text DEFAULT NULL,
            `short_description` varchar(255) DEFAULT NULL,
            `price` int(255) DEFAULT NULL,
            `link` varchar(255) DEFAULT NULL,
            `image` varchar(255) DEFAULT NULL,
            `brand` varchar(255) DEFAULT NULL,
            `rating` int(255) DEFAULT NULL,
            `caffeine_type` varchar(255) DEFAULT NULL,
            `count` int(255) DEFAULT NULL,
            `flavored` varchar(255) DEFAULT NULL,
            `seasonal` varchar(255) DEFAULT NULL,
            `in_stock` varchar(255) DEFAULT NULL,
            `facebook` varchar(255) DEFAULT NULL,
            `is_k_cup` int(255) DEFAULT NULL
          )";
        if (!mysqli_query($this->conn, $query)) {
            file_put_contents(ERROR_FILE, mysqli_error($this->conn) . "\n", FILE_APPEND);
            die();
        }
    }
    public function insert($data, $table) 
    { 
        $coloumns = implode(',', array_keys($data));

        $values = implode("', '", array_values($data));

        $query = "INSERT INTO $table ($coloumns) VALUES ('$values')";

        if (!mysqli_query($this->conn, $query)) { 
            file_put_contents(ERROR_FILE, mysqli_error($this->conn) . "\n", FILE_APPEND);
            die();
        }
    }
}