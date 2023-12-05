<?php
   session_start();
   $host = '192.168.56.102:4567';
   $user = 'dongjin';
   $pw = 'cdj696812~';
   $db_name = 'dbproject';
   $mysqli = new mysqli($host, $user, $pw, $db_name); //db 연결

if (isset($_POST['movieUID'])) {
    $movieUID = $_POST['movieUID'];
    
    // 여기에서 필요한 데이터를 가져오는 쿼리를 작성
    $query = "SELECT * FROM movie WHERE movieUID = $movieUID";
    $query_run = mysqli_query($mysqli, $query);

    $response = array();

    while ($row = mysqli_fetch_array($query_run)) {
        $response['image'] = base64_encode($row['image']);
        $response['moviename'] = $row['moviename'];
        // 필요한 다른 정보들도 추가 가능

        // 예를 들어 영화 UID를 세션에 저장할 경우
        $_SESSION['selected_movie_uid'] = $row['movieUid'];
    }

    // JSON 형식으로 응답
    echo json_encode($response);
} else {
    // movieUID가 전달되지 않았을 경우 처리
    echo "Invalid request";
}
?>
