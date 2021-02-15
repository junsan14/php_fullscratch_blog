<?php
	
	require('function.php');
	require('admit.php');
	$time=date('Y-m-d H:i:s');
	$today = date('Y-m-d\TH:i', strtotime($time));	

	debug($_SESSION['blog_id']);



	if(	$_SESSION['save_path'] === 'blog_write.php'){

		if(!empty($_POST)){
			$title = $_POST['article_title'];
			$date = $_POST['article_date'];
			$category = $_POST['category'];
			
			$content = $_POST['article_content'];
			$user_id = $_SESSION['user_id'];


			db_connect();
			$stmt = $dbh->prepare('INSERT INTO blog (user_id,title,category,content,create_date,update_date,edit_flag) VALUES (:user_id,:title,:category,:content,:create_date,:update_date,:edit_flag)');
			$stmt->execute(array(':user_id'=>$user_id,':title'=>$title,':category'=>$category,':content'=>$content,':create_date'=>$date,':update_date'=>date('Y-m-d H:i:s'),':edit_flag'=>1));

		}
	}else if($_SESSION['save_path'] === 'edit_article.php'){

		if(!empty($_POST)){
			$title = $_POST['article_title'];
			$article_date = $_POST['article_date'];
			$category = $_POST['category'];
			$content = $_POST['article_content'];
			$user_id = $_SESSION['user_id'];
			

			db_connect();

			$stmt1 = $dbh->prepare('UPDATE blog SET title = :title, category = :category, content = :content, create_date = :create_date, update_date = :update_date, edit_flag = 1 WHERE id = :blog_id AND delete_flag = 0');
			$stmt1->execute(array(':blog_id'=>$_SESSION['blog_id'],':title'=>$title,':category'=>$category,':content'=>$content,':create_date'=>$article_date,':update_date'=>date('Y-m-d H:i')));
			$msg ='変更完了しました';

		}

	}

	header("Location:blog_edit.php");


?>
