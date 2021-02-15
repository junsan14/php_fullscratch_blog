<?php
	
	require('function.php');
	require('admit.php');

	$blog_id = $_SESSION['blog_id'];
	

	db_connect();

	$msg='';
	debug($blog_id);

	if(!empty($_POST)){
			$title = $_POST['article_title'];
			$article_date = $_POST['article_date'];
			$content = $_POST['article_content'];
			$user_id = $_SESSION['user_id'];

			db_connect();

			$stmt1 = $dbh->prepare('UPDATE blog SET delete_flag = 1 WHERE id = :blog_id');
			$stmt1->execute(array(':blog_id'=>$blog_id));
			debug('削除完了しました');
			header("Location:blog_edit.php");
			$_SESSION['delete_scc'] = '削除完了しました';
			

	}



?>