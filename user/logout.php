<?php
   $host = '192.168.56.102:4567';
   $user = 'dongjin';
   $pw = 'cdj696812~';
   $db_name = 'dbproject';
   $mysqli = new mysqli($host, $user, $pw, $db_name); //db 연결
	   session_start(); 

	   $_SESSION = array(); 
	   
	   session_destroy();
	   
?>
<meta charset="utf-8">
<script>alert("로그아웃되었습니다."); location.href="../main.php"; </script>