<?php
	require('function.php');
	debug_log_start();
	debug('----ユーザー登録スタート----');
	$msg ='';


	if(!empty($_POST)){
		debug('ポスト送信があります');
		$username = $_POST['username'];
		$password = $_POST['password'];
		$re_password = $_POST['re_password'];

		validRequired($username,'username');
		validRequired($password,'password');
		validHalfNum($password,'password');
		validMinletters($password,'password','4');
		validPassmatch($password,$re_password,'password');

		if(empty($error_msg)){
			debug('バリデーション認証OK');
			try{
				db_connect();

				$stmt = $dbh->prepare('INSERT INTO users (username,password,login_time,update_time) VALUES (:username,:password,:login_time,:update_time)');
				$stmt->execute(array(':username'=>$username,':password'=>password_hash($password, PASSWORD_DEFAULT),':login_time'=>date('Y-m-d H:i:s'),':update_time'=>date('Y-m-d H:i:s')));
				debug('ユーザー登録完了');
				$msg = "ユーザー登録が完了しました";

			}catch(Exception $e){
				debug('エラー発生:'.$e->getMessage());
				$error_msg['common'] = ERROR00;
			}

			

		}

	}

?>


<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="UTF-8">
		<title> LOGIN </title>
		<link rel="preconnect" href="https://fonts.gstatic.com">
		<link href="https://fonts.googleapis.com/css2?family=M+PLUS+Rounded+1c:wght@100&display=swap" rel="stylesheet">
		<link rel="stylesheet" href="style.css">
	</head>

	<body>
		<header id="header">

			<div id="site_menu">
				<ul>
					<li><a href="index.php">HOME</a></li>
					<li><a href="#blog">LOGOUT</a></li>
					<li><a href="signup.php">SIGHUP</a></li>

				</ul>

			</div>
		</header>

			<div class="content_width">
				<span style="text-align:center;"><?php if(!empty($msg)) echo $msg?></span>
				<h2 class="title">SIGN UP</h2>
				<span><?php if(!empty($error_msg['common'])) echo $error_msg['common']?></span>
			<div class="main_form">
				<form method="post">
					<table>
						<tr>
							<label>
								<p class="error_msg"><?php if(!empty($error_msg['username'])) echo $error_msg['username']?></p>
								<td><p>USERNAME</p></td>
								<td><input type="text" name="username"></td>
							</label>
						</tr>
						<tr>
							<label>
								<p class="error_msg"><?php if(!empty($error_msg['password'])) echo $error_msg['password']?></p>			
								<td><p>パスワード</p></td></td>
								<td><input type="password" name="password"></td>
							</label>
						</tr>
						<tr>
							<label>
								<p class="error_msg"><?php if(!empty($error_msg['re_password'])) echo $error_msg['re_password'] ?></p>
								<td><p>パスワード(再入力)</p></td></td>
								<td><input type="password" name="re_password"></td>
							</label>
						</tr>
						
						<tr><td></td>
							<td><input type="submit" value="送信"></td>
						</tr>
					</table>
			</div>

					</form>

				

			</div>


		






		<footer id="footer">


		</footer>




	</body>


</html>