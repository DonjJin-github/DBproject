<meta charset="utf-8" />
<?php	
   
   $host = 'localhost:3306';
   $user = 'root';
   $pw = '1234';
   $db_name = 'dbproject';
   $mysqli = new mysqli($host, $user, $pw, $db_name); //db 연결

	// POST로 받아온 아이디와 비밀번호가 비어있다면 알림창을 띄우고 전 페이지로 돌아갑니다.
	if ($_POST["userid"] == "" || $_POST["userpw"] == "") {
		echo '<script> alert("아이디나 패스워드를 입력하세요."); history.back(); </script>';
	} else {
		// password 변수에 POST로 받아온 값을 저장하고 SQL문으로 POST로 받아온 아이디값을 찾습니다.
		$password = $_POST['userpw'];
		$sql = "select * from user where userid='".$_POST['userid']."'";
		$result = $mysqli->query($sql); // SQL 쿼리 실행

		if ($result) {
			$member = $result->fetch_array(); // 결과를 가져옴
			$hash_pw = $member['password']; // $hash_pw에 POST로 받아온 아이디열의 비밀번호를 저장합니다.

			if (password_verify($password, $hash_pw)) {
				// 만약 password 변수와 hash_pw 변수가 같다면 세션값을 저장하고 알림창을 띄운 후 main.php 파일로 넘어갑니다.
				session_start();
				$_SESSION['userid'] = $member["userid"];
				$_SESSION['userpw'] = $member["password"];

				echo "<script>alert('로그인되었습니다.'); location.href='../main.php';</script>";
			} else {
				// 비밀번호가 같지 않다면 알림창을 띄우고 전 페이지로 돌아갑니다.
				echo "<script>alert('아이디 혹은 비밀번호를 확인하세요.'); history.back();</script>";
			}
		} else {
			// SQL 쿼리가 실패한 경우에 대한 처리
			echo "<script>alert('로그인 중 오류가 발생했습니다.');</script>";
		}
	}
?>
