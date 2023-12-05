<?php
session_start();
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
            <div id="infor"><a href=''><p>예매 확인</p></div>
            <div id="reser"><a href='../movie/process.php'>영화 예매</a></div>
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
        <div id="content" style="font-size : 20px">
            <?php
            $currentUsername = $_SESSION['userid'];

            // Query to fetch user_id based on the current username
            $userQuery = "SELECT Uid FROM user WHERE userid = '$currentUsername'";
            $userResult = $mysqli->query($userQuery);

            if ($userResult->num_rows > 0) {
                $userRow = $userResult->fetch_assoc();
                $currentUserId = $userRow['Uid'];

                // Query to fetch payUid, seat_id, seatname, movie_id, moviename, and movietime based on the current user's ID
                $sql = "SELECT pay.payUid, paylist.seat_id, seat.seatname, seat.movie_id, movie.moviename, movie.movietime
                        FROM pay
                        JOIN paylist ON pay.payUid = paylist.pay_id
                        JOIN seat ON paylist.seat_id = seat.seatUid
                        JOIN movie ON seat.movie_id = movie.movieUid
                        WHERE pay.user_id = $currentUserId";

                $result = $mysqli->query($sql);

                if ($result->num_rows > 0) {
                    $prevPayUid = null; // Variable to store the previous payUid

                    // Iterate over the remaining rows
                    while ($row = $result->fetch_assoc()) {
                        if ($prevPayUid !== $row["payUid"]) {
                            echo "<br><br>";
                            echo " 예매번호 : " . $row["payUid"] . "<br>";
                            echo " 영화제목 : " . $row["moviename"]. "<br>";
                            echo " 상영시간 : " . $row["movietime"]. "<br>";
                            echo " 좌석번호 : " ;
                            $prevPayUid = $row["payUid"];
                        }
                        echo $row["seatname"] . " ";
                    }
                } else {
                    echo "예약 정보 없음";
                }
            } else {
                echo "User not found";
            }

            $mysqli->close();
            ?>

        </div>
    </div>
</body>
</html>


