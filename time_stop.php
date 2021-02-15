<?php

	require('function.php');
	
		

		if(!empty($_SESSION['timer'])){
			$study_date = date('Y-m-d');
			$finish_time = new DateTime(date('Y-m-d H:i:s'));	
			$diff = $finish_time->diff($_SESSION['timer']);
			$study_time = $diff->format('%h:%i:%s');
			
			global $msg;
		
			db_connect();
			
			$stmt = $dbh->prepare('UPDATE study_time SET finish_time = :finish_time,study_time = :study_time,study_date = :study_date WHERE id = :id');
			$stmt->execute(array(':finish_time'=>date('H:i:s'),':study_time'=>$study_time,':study_date'=>$study_date,':id'=>$_SESSION['time_id']));
			
			unset($_SESSION['timer']);
			unset($_SESSION['time_id']);
			
			debug(print_r($_SESSION,true));
			$_SESSION['msg']= 'タイマーをストップしました';

		

		}else{
			$_SESSION['msg'] = 'タイマーが作動していません';

		}



		header('Location:timer.php');

		


?>