<?php
include 'config.php';
ob_start();
if (!isset($_SESSION)) {
    session_start();
}

$db = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
if (!$db) {
    die("Database connection failed: " . mysqli_connect_error());
}
?>