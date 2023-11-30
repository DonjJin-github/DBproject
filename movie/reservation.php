<?php 
   session_start();
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
<link href="res.css" rel="stylesheet"  />
<title>Insert title here</title>
<style>
    body, html {
        margin: 0;
        padding: 0;
        overflow-y: hidden; /* 세로 스크롤 비활성화 */
    }

    #full {
        width: 100vw; 
        height: 100vh;  
    }

    #banner {
        width: 100%;
        height: 10%;
        padding: 5px 5px 5px 5px;  
    }
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
                <p style = "font-size : 20px" id="Pick"></p>
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
                <div class="seat" id="A1">A1</div>
                <div class="seat" id="A2">A2</div>
                <div class="seat" id="A3">A3</div>
                <div class="seat" id="A4">A4</div>
                <div class="seat" id="A5">A5</div>
                <div class="seat" id="A6">A6</div>
                <div class="seat" id="A7">A7</div>
                <div class="seat" id="A8">A8</div>
            </div>
            <div class="row">
                <div class="seat"></div>
                <div class="seat"></div>
                <div class="seat"></div>
                <div class="seat"></div>
                <div class="seat"></div>
                <div class="seat"></div>
                <div class="seat"></div>
                <div class="seat"></div>
            </div>
            <div class="row">
                <div class="seat"></div>
                <div class="seat"></div>
                <div class="seat"></div>
                <div class="seat"></div>
                <div class="seat"></div>
                <div class="seat"></div>
                <div class="seat"></div>
                <div class="seat"></div>
            </div>
            <div class="row">
                <div class="seat"></div>
                <div class="seat"></div>
                <div class="seat"></div>
                <div class="seat"></div>
                <div class="seat"></div>
                <div class="seat"></div>
                <div class="seat"></div>
                <div class="seat"></div>
            </div>
            <div class="row">
                <div class="seat"></div>
                <div class="seat"></div>
                <div class="seat"></div>
                <div class="seat"></div>
                <div class="seat"></div>
                <div class="seat"></div>
                <div class="seat"></div>
                <div class="seat"></div>
            </div>
            <div class="row">
                <div class="seat"></div>
                <div class="seat"></div>
                <div class="seat"></div>
                <div class="seat"></div>
                <div class="seat"></div>
                <div class="seat"></div>
                <div class="seat"></div>
                <div class="seat"></div>
            </div>
            </div>

            <p class="text">
            You have selected <span id="count">0</span> seats for a price of \<span id="total">0</span>
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

    document.querySelectorAll('.row .selected').forEach((seat) => {
      seat.classList.remove('selected');
    });
    localStorage.removeItem('selectedSeats');
    updateSelectedCount();

    // Update the UI with the selected movie name
    document.getElementById("Pick").innerHTML = "선택된 영화: " + movieOption.querySelector('span').textContent;

    // Update total value in the hidden input field
    const selectedSeatCount = document.querySelectorAll('.row .selected').length;
    const totalValue = selectedSeatCount * ticketPrice;
    total.textContent = totalValue;

    // Use AJAX or fetch to send movieUID to the server if needed
    // ...

    // Update total value in the hidden input field
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
