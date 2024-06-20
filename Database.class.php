<?php
class Database {
    public static function conn() {
        $servername = "localhost";
        $username = "root";
        $password = "Warrior_07";
        $dbname = "mydb";

        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        return $conn;
    }

    public static function checkUserExists($username, $email, $phone) {
        $conn = self::conn();
        $stmt = $conn->prepare("SELECT * FROM `auth` WHERE username = ? OR email = ? OR phone = ?");
        $stmt->bind_param("sss", $username, $email, $phone);
        $stmt->execute();
        $result = $stmt->get_result();
        $userExists = $result->num_rows > 0;
        $stmt->close();
        $conn->close();
        return $userExists;
    }

    public static function addUser($username, $password, $email, $phone) {
        $conn = self::conn();
        $stmt = $conn->prepare("INSERT INTO `auth` (`username`, `password`, `email`, `phone`, `active`) VALUES (?, ?, ?, ?, 1)");
        $stmt->bind_param("ssss", $username, $password, $email, $phone);
        $success = $stmt->execute();
        $stmt->close();
        $conn->close();
        return $success;
    }

    public static function login($user, $pass){
        $conn = self::conn();
        $stmt = $conn->prepare("SELECT * from `auth` where username == '$user' and password='$pass'");

    }

    public static function validateSession(){

    }

    public static function addSession(){

    }
}
?>
