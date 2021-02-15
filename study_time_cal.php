<?php


	$today = date('Y-m-d');

	db_connect();
	$day_time ='';
	$total_time ='';
	global $today_study_time;
	global $total_study_time;


	//Cal today study time
	
		$stmt =$dbh->prepare('SELECT*FROM study_time WHERE study_date = :today AND study_time IS NOT NULL');

		$stmt->execute(array(':today'=>$today));
		$timedata = $stmt->fetchAll(PDO::FETCH_ASSOC);

		$stmt1 =$dbh->prepare('SELECT COUNT(*) FROM study_time WHERE study_date = :today AND study_time IS NOT NULL');
		$stmt1->execute(array(':today'=>$today));
		$step= $stmt1->fetch(PDO::FETCH_COLUMN);

		for($i=0; $i<$step; $i++){
				global $hour;
				global $min;
				global $sec;

				$sum_time = new DateTime($timedata[$i]['study_time']);
				
				//debug(print_r($timedata[$i],true));				
				$hour += ($sum_time->format('H'))*60*60;
				$min += ($sum_time->format('i'))*60;
				$sec += ($sum_time->format('s'));		
				
				

		$today_study_hour = floor(($hour + $min + $sec)/(60*60));
		$today_study_min = floor(($min + $sec)/60);
		$today_study_time = $today_study_hour.'時間'.$today_study_min.'分';	
	}

	//Cal total study time
	

		$stmt2 = $dbh->prepare('SELECT*FROM study_time WHERE study_time IS NOT NULL');
		$stmt2->execute();
		$timedata_all = $stmt2->fetchAll(PDO::FETCH_ASSOC);

		$stmt3 = $dbh->prepare('SELECT COUNT(*) FROM study_time WHERE study_time IS NOT NULL');
		$stmt3->execute();
		$step2 = $stmt3->fetch(PDO::FETCH_COLUMN);


		for($l=0; $l<$step2; $l++){
			global $all_hour;
			global $all_min;
			global $all_sec;

			$all_sum_time = new DateTime($timedata_all[$l]['study_time']);
			$all_hour += ($all_sum_time->format('H'))*60*60;
			$all_min += ($all_sum_time->format('i'))*60;
			$all_sec += ($all_sum_time->format('s'));

		}
		$all_study_hour = floor(($all_hour + $all_min + $all_sec)/(60*60));
		$all_study_min = floor(($all_min + $all_sec)/60);
		$all_study_time = $all_study_hour.'時間'.$all_study_min.'分';	

	





?>