<?php
class Database {
    private static $conn = null;

    public static function connect() {
        if (self::$conn === null) {
            try {
                self::$conn = new PDO('mysql:host=localhost;dbname=lab_7', 'username', 'password'); // Replace with your actual credentials
                self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die('Connection failed: ' . $e->getMessage());
            }
        }
        return self::$conn;
    }

    public static function selectData() {
        $conn = self::connect();
        $stmt = $conn->prepare('SELECT * FROM users');
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function delete($matric) {
        $conn = self::connect();
        $stmt = $conn->prepare('DELETE FROM users WHERE matric = :matric');
        $stmt->bindParam(':matric', $matric);
        return $stmt->execute();
    }

    public static function update($matric, $name, $password, $role) {
        $conn = self::connect();
        $stmt = $conn->prepare('UPDATE users SET name = :name, password = :password, role = :role WHERE matric = :matric');
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':role', $role);
        $stmt->bindParam(':matric', $matric);
        return $stmt->execute();
    }
}
?>