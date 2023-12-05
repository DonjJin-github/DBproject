<?php
   $host = '192.168.56.102:4567';
   $user = 'dongjin';
   $pw = 'cdj696812~';
   $db_name = 'dbproject';
   $mysqli = new mysqli($host, $user, $pw, $db_name); //db 연결
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<link href="../default.css" rel="stylesheet" />
<title>회원가입 폼</title>
<script>
function checkid(){
	var userid = document.getElementById("uid").value;
	if(userid)
	{
		url = "check.php?userid="+userid;
			window.open(url,"chkid","width=300,height=100");
		}else{
			alert("아이디를 입력하세요");
		}
	}

</script>
</head>
<body style="display: flex; align-items: center; justify-content: center;">

<div id="full">
        <div id="banner">
            <div id="main"><a href='../main.php'><p>메인 화면</p></div>
            <div id="infor"><a href='../movie/reserinfo.php'><p>예매 확인</p></div>
            <div id="reser"><a href='../movie/process.php'>영화 예매</a></div>
            <div id="mypage"><a href='mypage.php'>마이 페이지</a></div>         
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
	<form method="post" action="user_ok.php" name="memform">
		<h1>회원가입</h1>
			<fieldset>
				<legend>입력사항</legend>
					<table>
						<tr>
							<td>아이디</td>
							<td><input type="text" size="35" name="userid" id="uid" placeholder="아이디" required>
								<input type="button" value="중복검사" onclick="checkid();" />
							</td>
						</tr>
						<tr>
							<td>비밀번호</td>
							<td><input type="password" size="35" name="userpw" placeholder="비밀번호" required></td>
						</tr>
						<tr>
							<td>이름</td>
							<td><input type="text" size="35" name="name" placeholder="이름" required></td>
						</tr>
						<tr>
							<td>주소</td>
							<td><input type="text" size="35" name="adress" placeholder="주소" required></td>
						</tr>
						<tr>
							<td>성별</td>
							<td>남<input type="radio" name="sex" value="남"> 여<input type="radio" name="sex" value="여"></td>
						</tr>
						<tr>
							<td>이메일</td>
							<td><input type="text" name="email" required>@<select name="emadress"><option value="naver.com">naver.com</option><option value="nate.com">nate.com</option>
							<option value="hanmail.com">hanmail.com</option></select></td>
						</tr>
					</table>
				<input type="submit" value="가입하기" /><input type="reset" value="다시쓰기" />
		</fieldset>
	</form>
        </div>
    </div>
</body>
</html>