<?php 
   session_start();
   $host = 'localhost:3306';
   $user = 'root';
   $pw = '1234';
   $db_name = 'dbproject';
      $mysqli = new mysqli($host, $user, $pw, $db_name); //db 연결

      if (!isset($_SESSION['userid'])) {
        header('Location: ../index.php');
        exit();
    }
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>결제 정보</title>
</head>
<body>
    <h1>결제 정보</h1>

    <?php
        $movie_id = $_SESSION['storedValue'];
        $query = "SELECT * FROM movie WHERE movieUID = $movie_id";
        $query_run = mysqli_query($mysqli, $query);

        if ($query_run) {
            // Fetch the data from the result set
               $row = mysqli_fetch_array($query_run);
                 // Check if the movie was found
                 if ($row) {
                 echo '<span>'.'선택된 영화 : ' . $row['moviename'] . '</span>';
                } else {
                         echo '<span>선택된 영화를 찾을 수 없습니다.</span>';
                     }
                 } else {
                     // Handle the query error
                    echo '<span>쿼리 실행 중 오류가 발생했습니다.</span>';
                 }    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // 선택한 좌석 데이터 검색
        $selectedSeatIds = json_decode($_POST['selectedSeatIds']);

        // 선택한 좌석 ID를 출력
        if (!empty($selectedSeatIds)) {
            echo '<p>선택한 좌석 ID:</p>';
            echo '<ul>';
            foreach ($selectedSeatIds as $seatId) {
                echo '<li>' . htmlspecialchars($seatId) . '</li>';
            }
            echo '</ul>';
        } else {
            echo '<p>선택한 좌석이 없습니다.</p>';
        }

        // Total 값 출력
        $total = isset($_POST['total']) ? htmlspecialchars($_POST['total']) : 0;
        echo '<p>Total 값: ' . $total . '</p>';
    } else {
        echo '<p>올바르지 않은 접근입니다.</p>';
    }
    ?>

    <!-- 추가적인 결제 정보 표시 또는 처리 -->

</body>
</html>
