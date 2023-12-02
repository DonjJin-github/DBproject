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
        <!-- ... (Your existing code for banner) ... -->
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
                echo '<span>' . '선택된 영화 : ' . $row['moviename'] . '<br>상영시간 : ' . $row['movietime'] . '</span>';
            } else {
                echo '<span>선택된 영화를 찾을 수 없습니다.</span>';
            }
        } else {
            echo '<span>쿼리 실행 중 오류가 발생했습니다.</span>';
        }

        // Initialize $selectedSeatIds before the if block
        $selectedSeatIds = [];

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
        <div id="payment">
            <form action="checkreser.php" method="post">
                <button type="submit">결제하기</button>
            </form>
        </div>
    </div>
</div>
</body>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        var submitButton = document.querySelector("#payment button");

        submitButton.addEventListener("click", function (event) {
            event.preventDefault(); // 기본 폼 제출 동작 막기

            var selectedSeatIds = <?php echo json_encode($selectedSeatIds); ?>;
            var jsonData = JSON.stringify(selectedSeatIds);

            var form = document.createElement("form");
            form.setAttribute("method", "post");
            form.setAttribute("action", "checkreser.php");

            // Create hidden input for selectedSeatIds
            var input1 = document.createElement("input");
            input1.setAttribute("type", "hidden");
            input1.setAttribute("name", "selectedSeatIds");
            input1.setAttribute("value", jsonData);
            form.appendChild(input1);

            // Create hidden input for movie_id
            var input2 = document.createElement("input");
            input2.setAttribute("type", "hidden");
            input2.setAttribute("name", "movie_id");
            input2.setAttribute("value", "<?php echo $movie_id; ?>");
            form.appendChild(input2);

            // Create hidden input for total
            var input3 = document.createElement("input");
            input3.setAttribute("type", "hidden");
            input3.setAttribute("name", "price");
            input3.setAttribute("value", "12000");
            form.appendChild(input3);

            document.body.appendChild(form);

            form.submit();
        });
    });
</script>

</html>
