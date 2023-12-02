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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve values from the form
    $movie_id = isset($_POST['movie_id']) ? $_POST['movie_id'] : '';
    $selectedSeatIds = isset($_POST['selectedSeatIds']) ? json_decode($_POST['selectedSeatIds']) : [];
    $total = isset($_POST['total']) ? $_POST['total'] : 0;

    $sql = "SELECT * FROM user WHERE userid='" . $_SESSION['userid'] . "'";
    $result = mysqli_query($mysqli, $sql); // Fix the variable name here
    $row = mysqli_fetch_assoc($result);
    $Uid = $row['Uid'];
    echo "Uid: " . $Uid;

    echo "<h2>결제 정보</h2>";
    echo "<p>선택된 영화 ID: $movie_id</p>";

    if (!empty($selectedSeatIds)) {
        echo '<p>선택한 좌석 ID:</p>';
        echo '<ul>';
        foreach ($selectedSeatIds as $seatId) {
            $sql1 = "SELECT * FROM seat WHERE seatname = '$seatId' AND movie_id = $movie_id";
            $result1 = mysqli_query($mysqli, $sql1);
            $row1 = mysqli_fetch_assoc($result1);
            $seatstatus = $row1['seatstatus'];
            $seat_id = $row1['seatUid'];

            if($seatstatus == 'N/A'){
                
                $sql2 = "UPDATE seat SET seatstatus = 'occupied' WHERE seatname = '$seatId' AND movie_id = $movie_id";
                //$result2 = mysqli_query($mysqli, $sql2);
                $query = "INSERT INTO pay (totalprice, user_id, seat_id) VALUES ('$total', '$Uid', '$seat_id')";
                $query_run = mysqli_query($mysqli, $query);
            }
        }
        echo '</ul>';
    } else {
        echo '<p>선택한 좌석이 없습니다.</p>';
    }

    echo "<p>Total 값: $total </p>";

} else {
    echo '<p>올바르지 않은 접근입니다.</p>';
}
?>
