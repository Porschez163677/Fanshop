<?php
session_start();

include "config.php";

class User {
    public $db;

    public function __construct() {
        $this->db = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);

        if (mysqli_connect_errno()) {
            echo "Error: Could not connect to database. " . mysqli_connect_error();
            exit;
        } else {
            echo "Connected.";
        }
    }

    public function check_login($username, $password) {
        $sql2 = "SELECT custname FROM customer WHERE username='$username' AND password ='$password'";
        $result = mysqli_query($this->db, $sql2);
        $user_data = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $count_row = $result->num_rows;

        if ($count_row == 1) {
            $_SESSION['login'] = true;
            $_SESSION['name'] = $user_data['custname'];
            return true;
        } else {
            return false;
        }
    }

    public function reg_user($custcode, $username, $password, $custname, $mobile, $email, $birthdate) {
        $sql = "INSERT IGNORE INTO customer SET custcode=?, username=?, password=?, custname=?, mobile=?, email=?, birthdate=?";
        
        // ใช้ prepared statement เพื่อป้องกัน SQL injection
        $stmt = $this->db->prepare($sql);
        
        // ตรวจสอบว่า prepared statement สามารถใช้งานได้หรือไม่
        if ($stmt) {
            $stmt->bind_param("sssssss", $custcode, $username, $password, $custname, $mobile, $email, $birthdate);
            $stmt->execute();
            
            $result = $stmt->affected_rows;
            
            $stmt->close();
            return $result;
        } else {
            // การเตรียม statement ล้มเหลว
            return false;
        }
    }
}
?>
