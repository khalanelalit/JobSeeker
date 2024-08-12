<?php
class DbConnection {
    private static $host = 'localhost';
    private static $dbName = 'job';
    private static $username = 'root';
    private static $password = '';
    private static $conn;

    public static function connect() {
        if (self::$conn == null) {
            try {
                self::$conn = new PDO('mysql:host=' . self::$host . ';dbname=' . self::$dbName, self::$username, self::$password);
                self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die('Connection failed: ' . $e->getMessage());
            }
        }
        return self::$conn;
    }
}
?>
