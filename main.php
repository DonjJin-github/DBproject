<?php 
session_start();
$host = '192.168.56.102:4567';
$user = 'dongjin';
$pw = 'cdj696812~';
$db_name = 'dbproject';
$mysqli = new mysqli($host, $user, $pw, $db_name); //db 연결
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Insert title here</title>
<link href="default.css" rel="stylesheet" />
</head>
<body>
    <div id="full">
        <div id="banner">
            <div id="main"><a href=''><p>메인 화면</p></div>
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
        <p style="font-size:25px">상영중인 영화</p>
        <div id="content">
            <div id="movie1">
            <?php
                    $movie_id = 1;
                    $query = "SELECT * FROM movie WHERE movieUID = $movie_id";
                    $query_run = mysqli_query($mysqli, $query);
                    $row = mysqli_fetch_array($query_run);
                    echo '<img width:"289px" height="414px" src="data:image;base64,'.base64_encode($row['image']).'" alt="Image">';
                ?>
            </div>
            <div id="movie2">
            <?php
                    $movie_id = 2;
                    $query = "SELECT * FROM movie WHERE movieUID = $movie_id";
                    $query_run = mysqli_query($mysqli, $query);
                    $row = mysqli_fetch_array($query_run);
                    echo '<img width:"289px" height="414px" src="data:image;base64,'.base64_encode($row['image']).'" alt="Image">';
                ?>
            </div>
            <div id="movie3">
            <?php
                    $movie_id = 3;
                    $query = "SELECT * FROM movie WHERE movieUID = $movie_id";
                    $query_run = mysqli_query($mysqli, $query);
                    $row = mysqli_fetch_array($query_run);
                    echo '<img width:"289px" height="414px" src="data:image;base64,'.base64_encode($row['image']).'" alt="Image">';
                ?>
            </div>
            <div id="movie4">
            <?php
                    $movie_id = 4;
                    $query = "SELECT * FROM movie WHERE movieUID = $movie_id";
                    $query_run = mysqli_query($mysqli, $query);
                    $row = mysqli_fetch_array($query_run);
                    echo '<img width:"289px" height="414px" src="data:image;base64,'.base64_encode($row['image']).'" alt="Image">';
                ?>
            </div>
            <div id="movie5">
            <?php
                    $movie_id = 5;
                    $query = "SELECT * FROM movie WHERE movieUID = $movie_id";
                    $query_run = mysqli_query($mysqli, $query);
                    $row = mysqli_fetch_array($query_run);
                    echo '<img width:"289px" height="414px" src="data:image;base64,'.base64_encode($row['image']).'" alt="Image">';
                ?>
            </div>
            <div id="movie1">
            <?php
                    $movie_id = 1;
                    $query = "SELECT * FROM movie WHERE movieUID = $movie_id";
                    $query_run = mysqli_query($mysqli, $query);
                    $row = mysqli_fetch_array($query_run);

                    echo '<span>'. $row['moviename'] . '<br>상영시간 : ' . $row['movietime'] .'</span>';
                ?>
            </div>
            <div id="movie2">
            <?php
                    $movie_id = 2;
                    $query = "SELECT * FROM movie WHERE movieUID = $movie_id";
                    $query_run = mysqli_query($mysqli, $query);
                    $row = mysqli_fetch_array($query_run);

                    echo '<span>'. $row['moviename'] . '<br>상영시간 : ' . $row['movietime'] .'</span>';
                ?>
            </div>
            <div id="movie3">
            <?php
                    $movie_id = 3;
                    $query = "SELECT * FROM movie WHERE movieUID = $movie_id";
                    $query_run = mysqli_query($mysqli, $query);
                    $row = mysqli_fetch_array($query_run);

                    echo '<span>'. $row['moviename'] . '<br>상영시간 : ' . $row['movietime'] .'</span>';
                ?>
            </div>
            <div id="movie4">
            <?php
                    $movie_id = 4;
                    $query = "SELECT * FROM movie WHERE movieUID = $movie_id";
                    $query_run = mysqli_query($mysqli, $query);
                    $row = mysqli_fetch_array($query_run);

                    echo '<span>'. $row['moviename'] . '<br>상영시간 : ' . $row['movietime'] .'</span>';
                ?>
            </div>
            <div id="movie5">
            <?php
                    $movie_id = 5;
                    $query = "SELECT * FROM movie WHERE movieUID = $movie_id";
                    $query_run = mysqli_query($mysqli, $query);
                    $row = mysqli_fetch_array($query_run);

                    echo '<span>'. $row['moviename'] . '<br>상영시간 : ' . $row['movietime'] .'</span>';
                ?>
            </div>
        </div>
    </div>
</body>
</html>
