<?php
   $host = 'localhost:3306';
   $user = 'root';
   $pw = '1234';
   $db_name = 'dbproject';
   $mysqli = new mysqli($host, $user, $pw, $db_name); //db 연결

	$userid = $_POST['userid'];
	$userpw = password_hash($_POST['userpw'], PASSWORD_DEFAULT);
	$username = $_POST['name'];
	$adress = $_POST['adress'];
	$sex = $_POST['sex'];
	$email = $_POST['email'].'@'.$_POST['emadress'];

$sql = mq("insert into member (id,pw,name,adress,sex,email) values('".$userid."','".$userpw."','".$username."','".$adress."','".$sex."','".$email."')");

?>
<meta charset="utf-8" />
<script type="text/javascript">alert('회원가입이 완료되었습니다.');</script>
<meta http-equiv="refresh" content="0 url=/">