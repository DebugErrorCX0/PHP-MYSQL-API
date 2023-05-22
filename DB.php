<?php

class DB {
    private static $servername = "host";
    private static $username = "user";
    private static $password = "password";
    private static $dbname = "database";

    public static function getConnection() {
        $conn = new mysqli(self::$servername, self::$username, self::$password, self::$dbname);

        if ($conn->connect_error) {
            die("Connection Error: " . $conn->connect_error);
        }

        return $conn;
    }

    public static function addDbValue($table, $row) {
        $conn = self::getConnection();

        $stmt = $conn->prepare("INSERT INTO $table (column_name) VALUES (?)");
        $stmt->bind_param("s", $row);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }

        $stmt->close();
        $conn->close();
    }
}

// Example for Usage:
$table = "users";
$row = "values";

$result = DB::addDbValue($table, $row);

if ($result) {
    echo "Done.";
} else {
    echo "Error.";
}

?>