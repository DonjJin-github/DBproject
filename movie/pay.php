<?php 
   session_start();
   $host = 'localhost:3306';
   $user = 'root';
   $pw = '1234';
   $db_name = 'dbproject';
      $mysqli = new mysqli($host, $user, $pw, $db_name);

      if (!isset($_SESSION['userid'])) {
        header('Location: ../index.php');
        exit();
    }
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <link href="../default.css" rel="stylesheet" />
    <meta charset="UTF-8">
    <title>결제 정보</title>
    <style>
    #content {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        width: 100%;
        height: 90%;
    }
    </style>
</head>
    <body>
        <div id="full">
        <div id="banner">
            <div id="main"><p>메인 화면</p></div>
            <div id="infor"><p>예매 확인</p></div>
            <div id="reser"><a href='process.php'>영화 예매</a></div>
            <div id="mypage"><a href='../user/mypage.php'>마이 페이지</a></div>         
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
        <h1>결제 정보</h1>
        <?php
            $movie_id = $_SESSION['storedValue'];
            $query = "SELECT * FROM movie WHERE movieUID = $movie_id";
            $query_run = mysqli_query($mysqli, $query);

            if ($query_run) {
                $row = mysqli_fetch_array($query_run);
                    if ($row) {
                    echo '<span>'.'선택된 영화 : ' . $row['moviename'] . '<br>상영시간 : ' . $row['movietime'] . '</span>';
                    } else {
                            echo '<span>선택된 영화를 찾을 수 없습니다.</span>';
                        }
            } else {
                echo '<span>쿼리 실행 중 오류가 발생했습니다.</span>';
            }    

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $selectedSeatIds = json_decode($_POST['selectedSeatIds']);

                if (!empty($selectedSeatIds)) {
                    echo '<p>선택한 좌석 ID</p>';
                    echo '<ul>';
                    foreach ($selectedSeatIds as $seatId) {
                        echo '<li>' . htmlspecialchars($seatId) . '</li>';
                    }
                    echo '</ul>';
                } else {
                    echo '<p>선택한 좌석이 없습니다.</p>';
                }

                $total = isset($_POST['total']) ? htmlspecialchars($_POST['total']) : 0;
                echo '<p>Total 값: ' . $total . '</p>';
            } else {
                echo '<p>올바르지 않은 접근입니다.</p>';
            }
        ?>
        </div>
    </div>
    </body>
</html>