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
    $price = isset($_POST['price']) ? $_POST['price'] : 0;

    $sql = "SELECT * FROM user WHERE userid='" . $_SESSION['userid'] . "'";
    $result = mysqli_query($mysqli, $sql); // Fix the variable name here
    $row = mysqli_fetch_assoc($result);
    $Uid = $row['Uid'];

    $a = "INSERT INTO pay (user_id) VALUES ('$Uid')";
    $b = mysqli_query($mysqli, $a);
    $pay_id = mysqli_insert_id($mysqli);
    



    if (!empty($selectedSeatIds)) {
        foreach ($selectedSeatIds as $seatId) {
            $sql1 = "SELECT * FROM seat WHERE seatname = '$seatId' AND movie_id = $movie_id";
            $result1 = mysqli_query($mysqli, $sql1);
            $row1 = mysqli_fetch_assoc($result1);
            $seatstatus = $row1['seatstatus'];
            $seat_id = $row1['seatUid'];

            if($seatstatus == 'N/A'){
                
                $sql2 = "UPDATE seat SET seatstatus = 'occupied' WHERE seatname = '$seatId' AND movie_id = $movie_id";
                $result2 = mysqli_query($mysqli, $sql2);
                $query = "INSERT INTO paylist (price, seat_id, pay_id) VALUES ('$price', '$seat_id', '$pay_id')";
                $query_run = mysqli_query($mysqli, $query);
                header('Location: reserinfo.php');
            }
            else{
                echo "alt(예약된 좌석입니다.)";
                header('Location: reservation.php');
            }
        }
        echo '</ul>';
    } else {
        echo '<p>선택한 좌석이 없습니다.</p>';
    }


} else {
    echo '<p>올바르지 않은 접근입니다.</p>';
}
?>
