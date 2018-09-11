<?php

require_once('sql_config.php');

Class Database{

    public $connection;

    public function __construct(){
        $this->open_db_connection();
    }

    public function open_db_connection(){
        $this->connection = New mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
        if($this->connection->connect_errno){
            die('database failure: '.$this->connection->connect_error);
        }
    }

    public function query($sql){
        $result = $this->connection->query($sql);
        $this->confirm_query($result);
        return $result;

    }
    
    public function the_insert_id(){
        return $this->connection->insert_id;
    }
    
    private function confirm_query($result) {
        if(!$result){
            die('Query Failed: '.$this->connection->connect_error);
        }
    }

    public function escape_string($string) {
        return $this->connection->real_escape_string($string);
    }
}

$database = New Database();
?>