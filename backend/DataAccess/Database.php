<?php
class Database{

    public static function getConnection(){
		$host = "localhost";
		$db_name = "ekiplab_nasa";
		$username = "ekiplab_nasa";
		$password = "ekiplab_nasa";
        $conn = null;
 
        try{
            $conn = new PDO("mysql:host=" . $host . ";dbname=" . $db_name, $username, $password);
            $conn->exec("set names utf8");
        }catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }
 
        return $conn;
    }
}
?>