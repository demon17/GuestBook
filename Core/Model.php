<?php
namespace Core;

use App\Config;
use PDO;

abstract class Model {
    protected static function getDB() {
        //it is static to be reusable after the first mysql connection
        static $db = null;

        try {
            $dsn = 'mysql:host=' . Config::DB_HOST . ';dbname=' . Config::DB_NAME . ";charset=utf8";

            $db = new PDO($dsn,Config::DB_USER,Config::DB_PASSWORD);

            //Throw an Exception when an error occurs
            $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

            return $db;

        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }
}
?>