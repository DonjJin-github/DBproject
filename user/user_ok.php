<?php
// 데이터베이스 연결
$host = 'localhost:3306';
$user = 'root';
$pw = '1234';
$db_name = 'dbproject';
$mysqli = new mysqli($host, $user, $pw, $db_name);

// 사용자 입력
$userid = $_POST['userid'];
$userpw = password_hash($_POST['userpw'], PASSWORD_DEFAULT);
$username = $_POST['name'];
$adress = $_POST['adress'];
$sex = $_POST['sex'];
$email = $_POST['email'].'@'.$_POST['emadress'];

// SQL 쿼리
$query = "INSERT INTO user (userid, password, username, useradress, usersex, useremail) VALUES ('$userid', '$userpw', '$username', '$adress', '$sex', '$email')";

$result = mysqli_query($mysqli, $query);

if (!$result) {
    die('MySQL 쿼리 오류: ' . mysqli_error($mysqli));
}

?>

<meta charset="utf-8" />
<script type="text/javascript">alert('회원가입이 완료되었습니다.');</script>
<meta http-equiv="refresh" content="0 url=/">
