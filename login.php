<?php
	require('function.php');
	require('admit.php');
	debug_log_start();
	debug('----ログインスタート----');

	if(!empty($_POST)){
		$username = $_POST['username'];
		$password = $_POST['password'];
		$keep_login = (!empty($_POST['keep_login']))? true:false;
		debug(print_r($_SESSION,true));

		validRequired($username,'username');
		validRequired($password,'password');
		validHalfNum($password,'password');

		if(empty($error_msg)){
			debug('バリデーション認証OK');
			try{
				db_connect();
				$stmt = $dbh->prepare('SELECT*FROM users WHERE username = :username');
				$stmt ->execute(array(':username'=>$username));
				$data = $stmt->fetch(PDO::FETCH_ASSOC);

				if(password_verify($password, $data['password'])){
					debug('パスワードが一致しました');
					
					$_SESSION['user_id'] = $data['id'];

					$_SESSION['login_time'] = time();
					$_SESSION['login_limit'] = $_SESSION['login_time'] + 60*60;

					if($keep_login){
						$_SESSION['login_limit'] = $_SESSION['login_time'] + 60*60*24;
					}
					
					debug('セッション変数の中身：'.print_r($_SESSION,true));
					
					header("Location:blog_write.php");
					
	
					

				}else{
					$error_msg['username'] = ERROR05;
				}

			}catch(Exception $e){
				debug('エラー発生：'.$e->getMessage());
				$error_msg['username'] = ERROR00;
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
		<?php require('menu.php')?>

			<div class="content_width">
			 <div id="blog">
				<h2 class="title">LOGIN</h2>

			<div class="main_form">
				<form method="post">
					<table>
						<tr>
							<label>
								<p class="error_msg"><?php if(!empty($error_msg['username'])) echo $error_msg['username']?></p>
								<td><p>ユーザーネーム</p></td>
								<td><input type="text" name="username"></td>
							</label>
						</tr>
						<tr>
							<label>
								<td><p>パスワード</p></td></td>
								<td><input type="password" name="password"></td>
							</label>
						</tr>
						<tr><td></td>
							<td><input type="checkbox" name="keep_login" style="transform:scale(1.5)";><span>ログイン状態を維持する</span></td>
						</tr>
						<tr><td></td>
							<td><input type="submit" value="送信"></td>
						</tr>
					</table>

			</div>

					</form>

			</div>

			</div>


		






			<footer id="footer">

				<p>Copyright junsan14. All Rights Reserved.</p>
			</footer>



	</body>


</html>