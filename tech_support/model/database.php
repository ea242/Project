<?php
class Database {
    private static $dsn = 'mysql:host=sql1.njit.edu;dbname=ea242';
    private static $username = 'ea242';
    private static $password = 'genetic26';
    private static $db;

    private function __construct() {}

    public static function getDB () {
        if (!isset(self::$db)) {
            try {
                self::$db = new PDO(self::$dsn,
                                     self::$username,
                                     self::$password);
            } catch (PDOException $e) {
                $error_message = $e->getMessage();
                include('../errors/database_error.php');
                exit();
            }
        }
        return self::$db;
    }

    public static function closeDB () {
        self::$db = null;
    }
}
?>