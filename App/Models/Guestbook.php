<?php
namespace App\Models;

use Core\Model;
use PDO;
use PDOException;

class Guestbook extends \Core\Model {
    public static function getAll() {
        try {
            //use static to reuse database connection after the first connection
            $db = Model::getDB();

            $stmt = $db->query('SELECT * FROM messages');
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $results;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public static function storeAll() {
        try {
            //use static to reuse database connection after the first connection
            if (filter_var($_REQUEST["email"], FILTER_VALIDATE_EMAIL))
            $db = Model::getDB();
            //insert a piece of news
            $username = htmlspecialchars((string)$_REQUEST["username"]);
            $email = filter_var($_REQUEST["email"], FILTER_VALIDATE_EMAIL) ?: null;
            $message = htmlspecialchars((string)$_REQUEST["message"]);

            $stmt = $db->prepare("INSERT INTO messages (username, email, message)
            VALUES (:username, :email, :message);");
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':message', $message);

            $stmt->execute();

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
?>