<?php

require_once('sql_config.php');

Class Database{

    public $connection;

    public function __construct(){
        $this->open_db_connection();
    }

    public function open_db_connection(){
        $this->connection = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
        if(mysqli_connect_errno()){
            die('database failure'.mysqli_error());
        }
    }
    public function query($sql){
        $result = mysql_query($this->connection, $sql);
        if(!$result){
            die('Query Failed');
        }else{
            return $result;
        }
    }
}

$database = New Database();
?>