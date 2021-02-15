<?php
	require('function.php');
	
	if(!empty($_SESSION)){
		debug('ログアウト成功');
		session_destroy();
		$_SESSION='';

		
	}else{
		debug('ログアウト失敗');
	}
	header("Location:login.php");




?>