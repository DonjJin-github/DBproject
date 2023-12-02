<?php
	   $host = 'localhost:3306';
	   $user = 'root';
	   $pw = '1234';
	   $db_name = 'dbproject';
	   $mysqli = new mysqli($host, $user, $pw, $db_name); 
	   session_start(); 

	   $_SESSION = array(); 
	   
	   session_destroy();
	   
?>
<meta charset="utf-8">
<script>alert("로그아웃되었습니다."); location.href="../main.php"; </script>