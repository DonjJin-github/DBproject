<?php

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve values from the form
    $movie_id = isset($_POST['movie_id']) ? $_POST['movie_id'] : '';
    $selectedSeatIds = isset($_POST['selectedSeatIds']) ? json_decode($_POST['selectedSeatIds']) : [];   
    $total = isset($_POST['total']) ? $_POST['total'] : 0;

    echo "<h2>결제 정보</h2>";
    echo "<p>선택된 영화 ID: $movie_id</p>";

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

    echo "<p>Total 값: $total</p>";

    // Add your payment processing logic here
    // ...

} else {
    echo '<p>올바르지 않은 접근입니다.</p>';
}
?>
