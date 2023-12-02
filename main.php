<?php 
session_start();
   $host = 'localhost:3306';
   $user = 'root';
   $pw = '1234';
   $db_name = 'dbproject';
      $mysqli = new mysqli($host, $user, $pw, $db_name); //db 연결
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Insert title here</title>
<link href="default.css" rel="stylesheet" type="text/css" />
</head>
<body>
    <div id="full">
        <div id="banner">
            <div id="main"><p>메인 화면</p></div>
            <div id="infor"><p>예매 확인</p></div>
            <div id="reser"><a href='movie/process.php'>영화 예매</a></div>
            <div id="mypage"><a href='user/mypage.php'>마이 페이지</a></div>         
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
        <p>무비 차트</p>
        <div id="content">
            <div id="movie1">movie1</div>
            <div id="movie2">movie2</div>
            <div id="movie3">movie3</div>
            <div id="movie4">movie4</div>
            <div id="movie5">movie5</div>
            <div id="movie1">예매율1</div>
            <div id="movie2">예매율2</div>
            <div id="movie3">예매율3</div>
            <div id="movie4">예매율4</div>
            <div id="movie5">예매율5</div>
        </div>
    </div>
</body>
</html>
