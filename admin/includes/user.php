<?php


Class User {

    public $id;
    public $username;
    public $password;
    public $first_name;
    public $last_name;

    public static function find_all_users(){
        return self::run_query_fetch_data("SELECT * FROM users;");
    }

    public static function find_user_by_id($id) {
        $result_array = self::run_query_fetch_data("SELECT * from users WHERE id=$id LIMIT 1");
        return !empty($result_array) ? array_shift($result_array) : false;
    }

    public static function verify_user($username, $password){
        global $database;
        $username = $database->escape_string($username);
        $password = $database->escape_string($password);
        $sql =  "SELECT * FROM users WHERE username = '{$username}' AND password = '{$password}' LIMIT 1";
        $result_array = self::run_query_fetch_data($sql);
        return !empty($result_array) ? array_shift($result_array) : false;
    }

    protected static function run_query_fetch_data($sql){
        global $database;
        $result_set = $database->query($sql);
        $the_object_array = Array();
        while($row = mysqli_fetch_array($result_set)){
            $the_object_array[] = self::instantiate($row);
        }
        return $the_object_array;
    }

    public static function instantiate($record){
        $the_object = New self;

        foreach($record as $attribute => $value){
            if($the_object->has_the_attribute($attribute)){
                $the_object->$attribute = $value;
            }
        }
        return $the_object;
    }

    protected function has_the_attribute($attribute){
        $object_properties = get_object_vars($this);
        return array_key_exists($attribute, $object_properties);
    }

}



?>
