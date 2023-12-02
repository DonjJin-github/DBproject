<?php
session_start(); // 세션을 시작합니다.

// Check if $_GET['result'] is set, otherwise use default value 1
$phpVariable = isset($_GET['result']) ? $_GET['result'] : 1;

$_SESSION['storedValue'] = $phpVariable;

// 예시로 값을 출력할 수도 있습니다.
echo "$phpVariable";

// JavaScript를 사용하여 페이지를 reservation.php로 리디렉션
header('Location: reservation.php');
?>
