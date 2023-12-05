<?php
   $host = '192.168.56.102:4567';
   $user = 'dongjin';
   $pw = 'cdj696812~';
   $db_name = 'dbproject';
   $mysqli = new mysqli($host, $user, $pw, $db_name); //db 연결

// 로그인 여부 확인
if (!isset($_SESSION['userid'])) {
    header('Location: ../index.php');
    exit();
}

// userid를 세션에서 가져오기
$userid = $_SESSION['userid'];

$sql = $mysqli->prepare("SELECT * FROM user WHERE userid = ?");
$sql->bind_param("s", $userid);
$sql->execute();
$result = $sql->get_result(); // 결과 가져오기
$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>마이페이지</title>
    <link href="../default.css" rel="stylesheet" />
</head>
<body>
<div id="full">
        <div id="banner">
        <div id="main"><a href='../main.php'><p>메인 화면</p></div>
            <div id="infor"><a href='../movie/reserinfo.php'><p>예매 확인</p></div>
            <div id="reser"><a href='../movie/process.php'>영화 예매</a></div>
            <div id="mypage"><a href=''>마이 페이지</a></div>         
			<?php
			if(isset($_SESSION['userid'])){
				echo "<div id='login'>{$_SESSION['userid']} 님 환영합니다.<a href='/user/logout.php'><input type='button' value='로그아웃' /></a></div>";
			?>
			<?php 
				}else{
				echo "<div id='login'><a href='index.php'>로그인</a></div>";
			} 
			?>
        </div>
        <div id="content">
    <form action="member_process.php?mode=update" method="post">
        <input type="hidden" name="userid" value="<?= $row['userid'] ?? '' ?>">
        <table class="updateTable">
            <tr>
                <td>아이디</td>
                <td><?php echo isset($row['userid']) ? $row['userid'] : ''; ?></td>
            </tr>
            <tr>
                <td>비밀번호</td>
                <td><input type="password" name="pw1"></td>
            </tr>
            <tr>
                <td>비밀번호 확인</td>
                <td><input type="password" name="pw2"></td>
            </tr>
            <tr>
                <td>이름</td>
                <td><?php echo isset($row['username']) ? $row['username'] : ''; ?></td>
            </tr>
            <tr>
                <td>성별</td>
                <td><?php echo isset($row['usersex']) ? $row['usersex'] : ''; ?></td>
            </tr>
            <tr>
                <td>주소</td>
                <td><?php echo isset($row['useradress']) ? $row['useradress'] : ''; ?></td>
            </tr>
            <tr>
                <td>이메일</td>
                <td><?php echo isset($row['useremail']) ? $row['useremail'] : ''; ?></td>
            </tr>
        </table>
        <div class="updateBtn">
            <input type="submit" value="수정">
            <input type="button" value="취소" onclick="history.back(1)">
        </div>
    </form>
        </div>
    </div>
</body>
</html>
