<?php

	if(!empty($_SESSION['login_time'])){
		debug('ログイン済ユーザーです');
		if($_SESSION['login_limit'] < time()){
			debug('ログイン有効期限が切れています');
			session_destroy();
			header("Location:login.php");
		}else{
			debug('ログインの有効期限内です');
			if(basename($_SERVER['PHP_SELF']) === 'login.php'){
				header("Location:blog_write.php");
			}
		}
	}else if(basename($_SERVER['PHP_SELF']) !== 'login.php'){
		debug('ログイン未ユーザーです');
		header("Location:login.php");
	}
?>