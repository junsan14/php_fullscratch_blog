<?php
	require('function.php');
	require('study_time_cal.php');
	require('admit.php');
	global $msg;
?>


<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="UTF-8">
		<title> TIMER </title>
		<link rel="preconnect" href="https://fonts.gstatic.com">
		<link href="https://fonts.googleapis.com/css2?family=M+PLUS+Rounded+1c:wght@100&display=swap" rel="stylesheet">
		<link rel="stylesheet" href="style.css">
	</head>

	<body>
		<?php require('mypage_menu.php')?>


	
			

				<div class="content_width">
					<div id="study_time_counter">

							<h2 class="title"> STUDY TIME</h2>
							
						<p id="time_error"> 
							<?php
							 if(!empty($_SESSION['msg'])){echo $_SESSION['msg'];}else if(empty($_SESSION)){echo $msg;} 
							 ?>							 
						</p>
						<div id = "time_form">
							<form method="post">
									<input type="submit" value="計測開始" formaction="time_start.php">
									<input type="submit" value="計測終了" formaction="time_stop.php">
							</form>
						</div>
						<p id="totaltime">　TOTAL STUDY TIME :
							<?php if(!empty($all_study_time)){echo $all_study_time;}else{echo '0時間0分';} ?>	

						</p>

						<p id=todaytime>　TODAY STUDY TIME : 
							<?php if(!empty($today_study_time)){echo $today_study_time;}else{echo '0時間0分';} ?>						
						</p>

					</div>
					


				</div>




		






		<footer id="footer">


		</footer>




	</body>


</html>