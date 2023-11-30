<?php
$host = 'localhost:3306';
$user = 'root';
$pw = '1234';
$db_name = 'dbproject';
$mysqli = new mysqli($host, $user, $pw, $db_name); // db 연결

$userid = $_GET["userid"];

// SQL 쿼리를 문자열로 작성할 때는 큰따옴표 안에서 작은따옴표로 묶어줍니다.
$sql = "SELECT * FROM user WHERE userid='".$userid."'";
$result = $mysqli->query($sql);

// fetch_array()는 결과가 없을 때 false를 반환합니다.
if($result->num_rows == 0) {
    ?>
    <div style='font-family:"malgun gothic";'><?php echo $userid; ?>는 사용가능한 아이디입니다.</div>
    <?php 
} else {
    $member = $result->fetch_array();
    ?>
    <div style='font-family:"malgun gothic"; color:red;'><?php echo $userid; ?> 중복된 아이디입니다.</div>
    <?php
}
?>
<button value="닫기" onclick="window.close()">닫기</button>
<script>
</script>
