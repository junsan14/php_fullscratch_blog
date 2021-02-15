<?php
	
	require('function.php');
	require('admit.php');
	$time=date('Y-m-d H:i:s');
	$today = date('Y-m-d\TH:i', strtotime($time));	

	$_SESSION['save_path'] = basename($_SERVER['PHP_SELF']);

	

	if(!empty($_POST)){
		$title = $_POST['article_title'];
		$date = $_POST['article_date'];
		$category = $_POST['category'];
		$summary = $_POST['article_summary'];
		$content = $_POST['article_content'];
		$user_id = $_SESSION['user_id'];


		db_connect();
		$stmt = $dbh->prepare('INSERT INTO blog (user_id,title,category,summary,content,create_date,update_date) VALUES (:user_id,:title,:category,:summary,:content,:create_date,:update_date)');
		$stmt->execute(array(':user_id'=>$user_id,':title'=>$title,':category'=>$category,':summary'=>$summary,':content'=>$content,':create_date'=>$date,':update_date'=>date('Y-m-d H:i:s')));

	}




?>


<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="UTF-8">
		<title> ARTICLE WRITE </title>
		<link rel="preconnect" href="https://fonts.gstatic.com">
		<link href="https://fonts.googleapis.com/css2?family=M+PLUS+Rounded+1c:wght@100&display=swap" rel="stylesheet">
		<link rel="stylesheet" href="style.css">
	</head>

	<body>
		<?php require('mypage_menu.php')?>


			<div class="content_width">
			<div id="blog">
				<h2 class="title">WRITE AN ARTICLE</h2>
				<div class="main_form">
					<form method="post">
						<table>
							<tr>
								<label>
									<td><p>TITLE</p></td>
									<td><input type="text" name="article_title" required></td>
								</label>
							</tr>
							<tr>
								<label>
									<td><p>日付</p></td></td>
									<td><input type="datetime-local" name="article_date" value="<?php echo $today ?>"></td>
								</label>
							</tr>
							<tr>
								<label>
									<td><p>カテゴリー</p></td></td>
									<td>
										<select name="category">
											<option value="0">日常</option>
											<option value="1">プログラミング</option>
											<option value="2">ホテル</option>
										</select>

									</td>
								</label>
							</tr>
							<tr>
								<label>
									<td><p>記事の要約</p></td></td>
									<td>
										<textarea name="article_summary" cols="50px" rows="5px"></textarea>

									</td>
								</label>
							</tr>
						
							
							<tr>
								<label>
									<td><p>記事内容</p></td>

									<td><textarea name="article_content" cols="50px" rows="20px">
<div class="allcontent">									
<div class="content">
皆さん、こんにちは、日々コロナウイルスの影響で低い稼働率をホテルマンとして奮闘しホテルに勤務している一方プログラミング学習をしているjunsan14です

</div>
<br>

<div class="summary">
【この記事を読めばわかること】<br>

<br>
</div>


<div class="blog_menu">
【この記事の目次】
<ol style="margin-top:-10px;">
<a href="#p1"><li></li></a>
<a href="#p2"><li></li></a>
<a href="#p3"><li></li></a>
<a href="#p4"><li></li></a>
</ol>
</div>

<div class="ad" id="p1"></div>
<div class="sub_title">

<br>
	
</div>
<div class="content">

</div>

<div class="ad" id="p2"></div>
<div class="sub_title">

<br>
</div>
<div class="content">

</div>

<div class="ad" id="p3"></div>
<div class="sub_title">
<br>
</div>
<div class="content">

</div>
<div class="ad" id="p4"></div>
<div class="sub_title">

<br>
</div>
<div class="content">
		
</div>
</div>

									</textarea></td>
								</label>
							</tr>
						
							
							<tr><td><input type="submit" value="保存する" formaction="blog_save.php"></td>
								<td><input type="submit" value="公開する"></td>
							</tr>
							
						</table>
				</div>
			</div>	

					</form>



				

			</div>


		






		<footer id="footer">


		</footer>




	</body>


</html>