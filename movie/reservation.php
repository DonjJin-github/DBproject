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
<html>
<head>
<meta charset="UTF-8">
<link href="res.css" rel="stylesheet"  />
<link href="../default.css" rel="stylesheet" type="text/css" />
<title>Insert title here</title>
<style>
    #content {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        width: 100%;
        height: 90%;
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
</style>
</head>
<body>
    <div id="full">
        <div id="banner">
            <div id="main"><p>메인 화면</p></div>
            <div id="infor"><p>예매 확인</p></div>
            <div id="reser"><p>영화 예매</p></div>
            <div id="mypage"><p>마이 페이지</p></div>
            <?php
			if(isset($_SESSION['userid'])){
				echo "<div id='login'>{$_SESSION['userid']} 님 환영합니다.<a href='../user/logout.php'><input type='button' value='로그아웃' /></a></div>";
			?>
			<?php 
				}else{
				echo "<div id='login'><a href='../index.php'>로그인</a></div>";
			} 
			?>
        </div>
        <div id="content">
          <div class="movie-container">
                <p style = "font-size : 20px" id="Pick">
                <?php
                    $movie_id = $_SESSION['storedValue'];
                    $query = "SELECT * FROM movie WHERE movieUID = $movie_id";
                    $query_run = mysqli_query($mysqli, $query);

                    if ($query_run) {
                        // Fetch the data from the result set
                        $row = mysqli_fetch_array($query_run);

                        // Check if the movie was found
                        if ($row) {
                            echo '<span>'.'선택된 영화 : ' . $row['moviename'] . '<br>상영시간' . $row['movietime'] .'</span>';
                        } else {
                            echo '<span>선택된 영화를 찾을 수 없습니다.</span>';
                        }
                    } else {
                        // Handle the query error
                        echo '<span>쿼리 실행 중 오류가 발생했습니다.</span>';
                    }
                ?>
                </p>
                <div class="movie-options" id="movieOptions">
                <?php
                            $query = "SELECT * FROM movie WHERE movieUID = 1";
                            $query_run = mysqli_query($mysqli, $query);

                            while($row = mysqli_fetch_array($query_run))
                            {
                                echo '<div class="movie-option" data-movieuid="' . $row['movieUid'] . '">';
                                echo '<img src="data:image;base64,'.base64_encode($row['image']).'" alt="Image">';
                                echo '<span>' . $row['moviename'] . '</span>';
                                echo '</div>';
                            }
                        ?>
                    <?php
                            $query = "SELECT * FROM movie WHERE movieUID = 2";
                            $query_run = mysqli_query($mysqli, $query);

                            while($row = mysqli_fetch_array($query_run))
                            {
                                echo '<div class="movie-option" data-movieuid="' . $row['movieUid'] . '">';
                                echo '<img src="data:image;base64,'.base64_encode($row['image']).'" alt="Image">';
                                echo '<span>' . $row['moviename'] . '</span>';
                                echo '</div>';
                            }
                        ?>
                    <?php
                            $query = "SELECT * FROM movie WHERE movieUID = 3";
                            $query_run = mysqli_query($mysqli, $query);

                            while($row = mysqli_fetch_array($query_run))
                            {
                                echo '<div class="movie-option" data-movieuid="' . $row['movieUid'] . '">';
                                echo '<img src="data:image;base64,'.base64_encode($row['image']).'" alt="Image">';
                                echo '<span>' . $row['moviename'] . '</span>';
                                echo '</div>';
                            }
                        ?>
                    <?php
                            $query = "SELECT * FROM movie WHERE movieUID = 4";
                            $query_run = mysqli_query($mysqli, $query);

                            while($row = mysqli_fetch_array($query_run))
                            {
                                echo '<div class="movie-option" data-movieuid="' . $row['movieUid'] . '">';
                                echo '<img src="data:image;base64,'.base64_encode($row['image']).'" alt="Image">';
                                echo '<span>' . $row['moviename'] . '</span>';
                                echo '</div>';
                            }
                        ?>
                        <?php
                            $query = "SELECT * FROM movie WHERE movieUID = 5";
                            $query_run = mysqli_query($mysqli, $query);

                            while($row = mysqli_fetch_array($query_run))
                            {
                                echo '<div class="movie-option" data-movieuid="' . $row['movieUid'] . '">';
                                echo '<img src="data:image;base64,'.base64_encode($row['image']).'" alt="Image">';
                                echo '<span>' . $row['moviename'] . '</span>';
                                echo '</div>';
                            }
                        ?>
                </div>
            </div>


            <ul class="showcase">
            <li>
                <div class="seat"></div>
                <small>N/A</small>
            </li>
            <li>
                <div class="seat selected"></div>
                <small>Selected</small>
            </li>
            <li>
                <div class="seat occupied"></div>
                <small>Occupied</small>
            </li>
            </ul>

            <div class="container">
            <div class="screen"></div>

            <form id="reservationForm" action="pay.php" method="POST">
            <div class="row">
            <?php
                 
               $movie_id = $_SESSION['storedValue'];
                // 원하는 좌석 범위 지정
                $start_seat = 1;
                $end_seat = 8;

                // 반복문을 사용하여 여러 좌석을 생성하고 출력
                for ($i = $start_seat; $i <= $end_seat; $i++) {
                    $seatname = 'A' . $i;
                    $query = "SELECT * FROM seat WHERE movie_id = $movie_id AND seatname = '$seatname'";
                    $query_run = mysqli_query($mysqli, $query);

                    // 좌석 정보 조회
                    $row = mysqli_fetch_array($query_run);

                    // 좌석 상태에 따라 다른 스타일의 div 출력
                    if ($row['seatstatus'] == 'N/A') {
                        echo "<div class='seat' id='$seatname'>$seatname</div>";
                    } else {
                        echo "<div class='seat occupied' id='$seatname'>$seatname</div>";
                    }
                }                

            ?>

            </div>
            <div class="row">
            <?php
                 
               $movie_id = $_SESSION['storedValue'];
                
                // 원하는 좌석 범위 지정
                $start_seat = 1;
                $end_seat = 8;

                // 반복문을 사용하여 여러 좌석을 생성하고 출력
                for ($i = $start_seat; $i <= $end_seat; $i++) {
                    $seatname = 'B' . $i;
                    $query = "SELECT * FROM seat WHERE movie_id = $movie_id AND seatname = '$seatname'";
                    $query_run = mysqli_query($mysqli, $query);

                    // 좌석 정보 조회
                    $row = mysqli_fetch_array($query_run);

                    // 좌석 상태에 따라 다른 스타일의 div 출력
                    if ($row['seatstatus'] == 'N/A') {
                        echo "<div class='seat' id='$seatname'>$seatname</div>";
                    } else {
                        echo "<div class='seat occupied' id='$seatname'>$seatname</div>";
                    }
                }                

            ?>
            </div>
            <div class="row">
            <?php
                 
               $movie_id = $_SESSION['storedValue'];
                
                // 원하는 좌석 범위 지정
                $start_seat = 1;
                $end_seat = 8;

                // 반복문을 사용하여 여러 좌석을 생성하고 출력
                for ($i = $start_seat; $i <= $end_seat; $i++) {
                    $seatname = 'C' . $i;
                    $query = "SELECT * FROM seat WHERE movie_id = $movie_id AND seatname = '$seatname'";
                    $query_run = mysqli_query($mysqli, $query);

                    // 좌석 정보 조회
                    $row = mysqli_fetch_array($query_run);

                    // 좌석 상태에 따라 다른 스타일의 div 출력
                    if ($row['seatstatus'] == 'N/A') {
                        echo "<div class='seat' id='$seatname'>$seatname</div>";
                    } else {
                        echo "<div class='seat occupied' id='$seatname'>$seatname</div>";
                    }
                }                

            ?>
            </div>
            <div class="row">
            <?php
                 
                 $movie_id = $_SESSION['storedValue'];
                  
                  // 원하는 좌석 범위 지정
                  $start_seat = 1;
                  $end_seat = 8;
  
                  // 반복문을 사용하여 여러 좌석을 생성하고 출력
                  for ($i = $start_seat; $i <= $end_seat; $i++) {
                      $seatname = 'D' . $i;
                      $query = "SELECT * FROM seat WHERE movie_id = $movie_id AND seatname = '$seatname'";
                      $query_run = mysqli_query($mysqli, $query);
  
                      // 좌석 정보 조회
                      $row = mysqli_fetch_array($query_run);
  
                      // 좌석 상태에 따라 다른 스타일의 div 출력
                      if ($row['seatstatus'] == 'N/A') {
                          echo "<div class='seat' id='$seatname'>$seatname</div>";
                      } else {
                          echo "<div class='seat occupied' id='$seatname'>$seatname</div>";
                      }
                  }                
  
              ?>

            </div>
            <div class="row">
            <?php
                 
               $movie_id = $_SESSION['storedValue'];
                
                // 원하는 좌석 범위 지정
                $start_seat = 1;
                $end_seat = 8;

                // 반복문을 사용하여 여러 좌석을 생성하고 출력
                for ($i = $start_seat; $i <= $end_seat; $i++) {
                    $seatname = 'E' . $i;
                    $query = "SELECT * FROM seat WHERE movie_id = $movie_id AND seatname = '$seatname'";
                    $query_run = mysqli_query($mysqli, $query);

                    // 좌석 정보 조회
                    $row = mysqli_fetch_array($query_run);

                    // 좌석 상태에 따라 다른 스타일의 div 출력
                    if ($row['seatstatus'] == 'N/A') {
                        echo "<div class='seat' id='$seatname'>$seatname</div>";
                    } else {
                        echo "<div class='seat occupied' id='$seatname'>$seatname</div>";
                    }
                }                

            ?>
            </div>
            </div>

            <p class="text">
            You have selected <span id="count">0</span> seats for a price of \<span id="total" ></span>
           <button type="submit" id="reserveButton">예약하기</button>
            </p>
            </form>

            
        </div>
    </div>
</body>

<script>
    const movieOptions = document.getElementById('movieOptions');
    const container = document.querySelector('.container');
    const seats = document.querySelectorAll('.row .seat:not(.occupied)');
    const count = document.getElementById('count');
    const total = document.getElementById('total');


    let ticketPrice = 12000;

    populateUI();

    function populateUI() {
    // Check if the page is refreshed
    if (performance.navigation.type === 1) {
        localStorage.clear(); // Clear local storage on refresh
    }

    const selectedSeats = JSON.parse(localStorage.getItem('selectedSeats'));

    if (selectedSeats !== null && selectedSeats.length > 0) {
        selectedSeats.forEach((seatIndex) => {
        seats[seatIndex].classList.add('selected');
        });
    }

    const selectedMovieIndex = localStorage.getItem('selectedMovieIndex');

    if (selectedMovieIndex !== null) {
        movieOptions.selectedIndex = selectedMovieIndex;
    }
    }

    function updateSelectedCount() {
  const selectedSeats = document.querySelectorAll('.row .selected');
  const selectedSeatCount = +selectedSeats.length;

  const selectedSeatsIndex = [...selectedSeats].map((seat) => [...seats].indexOf(seat));

  localStorage.setItem('selectedSeats', JSON.stringify(selectedSeatsIndex));

  count.textContent = selectedSeatCount;
  total.textContent = selectedSeatCount * ticketPrice;
}

movieOptions.addEventListener('click', (event) => {
    const movieOption = event.target.closest('.movie-option');

    if (movieOption) {
        const movieUID = movieOption.getAttribute('data-movieuid');
        console.log('선택된 movieUID:', movieUID);

        
        window.location.href = "process.php?result=" + movieUID;


        document.querySelectorAll('.row .selected').forEach((seat) => {
            seat.classList.remove('selected');
        });
        localStorage.removeItem('selectedSeats');
        updateSelectedCount();


        // 숨겨진 입력 필드에서 총 값 업데이트
        const selectedSeatCount = document.querySelectorAll('.row .selected').length;
        const totalValue = selectedSeatCount * ticketPrice;
        total.textContent = totalValue;

        document.querySelector('input[name="total"]').value = totalValue;

        const movieIndex = Array.from(movieOptions.children).indexOf(movieOption);
        updateSelectedCount();
    }
});





    document.getElementById('reservationForm').addEventListener('submit', function (event) {
  // 기본 폼 제출 방지
  event.preventDefault();

  // 선택한 좌석 데이터 수집
  const selectedSeats = document.querySelectorAll('.row .selected');
  const selectedSeatIds = [...selectedSeats].map((seat) => seat.id);

  // 선택한 좌석 데이터를 숨은 입력 필드에 추가
  const seatIdsInput = document.createElement('input');
  seatIdsInput.type = 'hidden';
  seatIdsInput.name = 'selectedSeatIds';
  seatIdsInput.value = JSON.stringify(selectedSeatIds);
  this.appendChild(seatIdsInput);

  // 기존 total 값 가져오기
  const totalValue = document.getElementById('total').textContent;

  // 기존 total 값을 숨은 입력 필드에 추가
  const totalInput = document.createElement('input');
  totalInput.type = 'hidden';
  totalInput.name = 'total';
  totalInput.value = totalValue;
  this.appendChild(totalInput);

  // 이제 폼 제출
  this.submit();
});

container.addEventListener('click', (event) => {
  if (event.target.classList.contains('seat') && !event.target.classList.contains('occupied')) {
    event.target.classList.toggle('selected');

    updateSelectedCount();
  }
});


    updateSelectedCount();


</script>
</html>
