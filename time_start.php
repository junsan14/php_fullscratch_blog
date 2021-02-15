<?php
	require('function.php');
		$start_time = date('Y-m-d H:i:s');
		


	if(empty($_SESSION['timer'])){
		db_connect();
		$stmt = $dbh->prepare('INSERT INTO study_time (start_time) VALUES (:start_time)');
		$stmt->execute(array(':start_time'=>$start_time));
		
		$stmt2 = $dbh->prepare('SELECT*FROM study_time ORDER by id desc');
		$stmt2->execute();
		$timedata = $stmt2->fetch(PDO::FETCH_ASSOC);

		$_SESSION['timer'] = new DateTime($start_time);		
		$_SESSION['time_id'] = $timedata['id'];
		$_SESSION['msg'] ='タイマーを開始しました';

	}else{
		$_SESSION['msg'] ='タイマーは既に作動しています';
		

	}


		header("Location:timer.php");






?>