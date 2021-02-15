<?php

	require('function.php');
		

	if(!empty($_POST)){
		$name = $_POST['name'];
		$to = $_POST['email'];
		$content =$_POST['content'];

		validEmail($to,'email');
		$from ='junsanjunsan14@gmail.com';
		$subject ='問い合わせ内容';
		sendEmail($from,$to,$subject,$content);

		$error_msg['name'] = 'メールの送信に成功しました';
	}



?>



<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="UTF-8">
		<title> CONTACT </title>
		<link rel="preconnect" href="https://fonts.gstatic.com">
		<link href="https://fonts.googleapis.com/css2?family=M+PLUS+Rounded+1c:wght@100&display=swap" rel="stylesheet">
		<link rel="stylesheet" href="style.css">
		<script type="text/javascript">
			 var $ftr = $('#footer');
    			if( window.innerHeight > $ftr.offset().top + $ftr.outerHeight() ){
     			 $ftr.attr({'style': 'position:fixed; top:' + (window.innerHeight - $ftr.outerHeight()) +'px;' });
    		}

		</script>
		<script data-ad-client="ca-pub-8534851946321815" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
	</head>

	<body>
		<?php require('menu.php')?>


			<div class="content_width">
				<div id="contact">
					<h2 class="title">CONTACT</h2>

					<form method="post">
				<div class="main_form">
					<table>
						<tr>
							<label>
								<p class="error_msg"><?php if(!empty($error_msg['name'])) echo $error_msg['name']?></p>
								<td><p>名前</p></td>
								<td><input type="text" name="name" required></td>
							</label>
						</tr>
						<tr>
							<label>
								<p class="error_msg"><?php if(!empty($error_msg['email'])) echo $error_msg['email']?></p>
								<td><p>メールアドレス</p></td></td>
								<td><input type="text" name="email" required></td>
							</label>
						</tr>
						<tr>
							<label>
								<p class="error_msg"><?php if(!empty($error_msg['content'])) echo $error_msg['content']?></p>
								<td><p>問い合わせ内容</p></td>
								<td><textarea name="content" cols="39px" rows="15px" required></textarea></td>
							</label>
						</tr>
						<br>
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