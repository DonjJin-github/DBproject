<?php 
   $host = 'localhost:3306';
   $user = 'root';
   $pw = '1234';
   $db_name = 'dbproject';
      $mysqli = new mysqli($host, $user, $pw, $db_name); //db 연결
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Insert title here</title>
<style>
    body, html {
        margin: 0;
        padding: 0;
        overflow-y: hidden; /* 세로 스크롤 비활성화 */
    }

    #full {
        width: 100vw; /* 뷰포트 너비를 100%로 설정 */
        height: 100vh; /* 뷰포트 높이를 100%로 설정 */   
    }

    #banner {
        width: 100%;
        height: 10%;
        padding: 5px 5px 5px 5px;  
    }
    #content {
        float: left;
        width: 100%;
        height: 90%;
        display: flex;
        flex-wrap: wrap;
        justify-content: space-around;
    }
    #main, #infor, #reser, #mypage, #login{
        float: left;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 5px 5px 5px 5px;
        height: 100%;
        width: 19%;
    }
    #movie1, #movie2, #movie3, #movie4, #movie5{
        float: left;
        text-align: center;
        margin: 5px 5px 5px 5px;
        height: 40%;
        width: 19%;
    }
    p{
        text-align: center;
    }

    a {
     text-decoration-line: none;
    }
</style>
</head>
<body>
    <div id="full">
        <div id="banner">
            <div id="main"><p>메인 화면</p></div>
            <div id="infor"><p>영화 정보</p></div>
            <div id="reser"><p>영화 예매</p></div>
            <div id="mypage"><p>마이 페이지</p></div>
            <div id="login"><a href="index.php">로그인</a></div>
        </div>
        <p>무비 차트</p>
        <div id="content">
            <div id="movie1">movie1</div>
            <div id="movie2">movie2</div>
            <div id="movie3">movie3</div>
            <div id="movie4">movie4</div>
            <div id="movie5">movie5</div>
            <div id="movie1">예매율1</div>
            <div id="movie2">예매율2</div>
            <div id="movie3">예매율3</div>
            <div id="movie4">예매율4</div>
            <div id="movie5">예매율5</div>
        </div>
    </div>
</body>
</html>
