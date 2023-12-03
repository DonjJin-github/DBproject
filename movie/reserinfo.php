<?php
session_start();
$host = 'localhost:3306';
$user = 'root';
$pw = '1234';
$db_name = 'dbproject';
$conn = new mysqli($host, $user, $pw, $db_name); //db 연결

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the current username from the session
$currentUsername = $_SESSION['userid'];

// Query to fetch user_id based on the current username
$userQuery = "SELECT Uid FROM user WHERE userid = '$currentUsername'";
$userResult = $conn->query($userQuery);

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

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $prevPayUid = null; // Variable to store the previous payUid

        // Iterate over the remaining rows
        while ($row = $result->fetch_assoc()) {
            if ($prevPayUid !== $row["payUid"]) {
                echo "<br>";
                echo "예약번호" . $row["payUid"] . "<br>";
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

$conn->close();
?>
