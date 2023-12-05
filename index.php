<?php 
   $host = '192.168.56.102:4567';
   $user = 'dongjin';
   $pw = 'cdj696812~';
   $db_name = 'dbproject';
   $mysqli = new mysqli($host, $user, $pw, $db_name); //db 연결
?>
<!DOCTYPE html>
<head>
	<meta charset="utf-8" />
	<title>회원가입 및 로그인 사이트</title>
	<link href="default.css" rel="stylesheet" />
</head>
<body>
    <div id="full">
        <div id="banner">
            <div id="main"><a href='main.php'><p>메인 화면</p></div>
            <div id="infor"><a href='movie/reserinfo.php'><p>예매 확인</p></div>
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
        <div id="content">
            <div id="login_box">
		<h1 style="text-align:center;">로그인</h1>							
			<form method="post" action="/user/login_ok.php">
				<table align="center" border="0" cellspacing="0" width="300">
        			<tr>
						<td><span>ID</span></td>
            			<td width="130" colspan="1"> 
            			<input type="text" name="userid" class="inph">
            			</td>
            		<td rowspan="2" align="center" width="100" > 
                		<button type="submit" id="btn" >로그인</button>
            		</td>
        		</tr>
        		<tr>
					<td><span>PW</span></td>
            		<td width="130" colspan="1"> 
               		<input type="password" name="userpw" class="inph">
            	</td>
        	</tr>
        	<tr>
           		<td colspan="3" align="center" class="mem"> 
              	<a href="/user/user.php">회원가입 하시겠습니까?</a>
           </td>
        </tr>
    </table>
  </form>
</div>
        </div>
    </div>
</body>
</html>