<?php

session_start();
$host = 'localhost:3306';
$user = 'root';
$pw = '1234';
$db_name = 'dbproject';
$mysqli = new mysqli($host, $user, $pw, $db_name); //db 연결

if (!isset($_SESSION['userid'])) {
    header('Location: ../index.php');
    exit();
}

echo 1;
?>
