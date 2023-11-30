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

        </div>
    </div>
</body>
</html>
