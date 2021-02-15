<?php
	
	require('function.php');
	require('admit.php');

	$blog_id = $_GET['id'];
	$_SESSION['blog_id'] = $blog_id;
	$_SESSION['save_path'] = basename($_SERVER['PHP_SELF']);


	db_connect();
	$stmt = $dbh->prepare('SELECT*FROM blog WHERE id = :blog_id');
	$stmt->execute(array(':blog_id'=>$blog_id));
	$data = $stmt->fetch(PDO::FETCH_ASSOC);

	$blog_title = $data['title'];
	$created_date= date('Y-m-d\TH:i',strtotime($data['create_date']));
	$blog_category = $data['category'];

	$updated_date = date('Y-m-d H:i:s');
	$blog_summary = $data['summary'];
	$blog_content = $data['content'];

	$msg='';


	if(!empty($_POST)){
			$title = $_POST['article_title'];
			$article_date = $_POST['article_date'];
			$category = $_POST['category'];
			$summary = $_POST['article_summary'];
			$content = $_POST['article_content'];
			$user_id = $_SESSION['user_id'];

			db_connect();

			$stmt1 = $dbh->prepare('UPDATE blog SET title = :title, category = :category,summary = :summary, content = :content, create_date = :create_date, update_date = :update_date, edit_flag = 0 WHERE id = :blog_id AND delete_flag = 0');
			$stmt1->execute(array(':blog_id'=>$blog_id,':title'=>$title,':category'=>$category,'summary'=>$summary,':content'=>$content,':create_date'=>$article_date,':update_date'=>date('Y-m-d H:i')));
			$msg ='変更完了しました';
			header("Location:blog_edit.php");
	}




?>


<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="UTF-8">
		<title> ARTICLE EDIT </title>
		<link rel="preconnect" href="https://fonts.gstatic.com">
		<link href="https://fonts.googleapis.com/css2?family=M+PLUS+Rounded+1c:wght@100&display=swap" rel="stylesheet">
		<link rel="stylesheet" href="style.css">

	</head>

	<body>
		<?php require('mypage_menu.php')?>

			<div class="content_width">
			 <div id="blog">
				<div id="edit_article">
					<h2 class="title">EDIT ARTICLES</h2>
					
						
				<div class="main_form">
					<form method="post">
						<table>
							<tr>
								<label>
									<td><p>TITLE</p></td>
									<td><input type="text" name="article_title" value="<?php if(!empty($blog_title)) echo $blog_title?>" required></td>
								</label>
							</tr>
							<tr>
								<label>
									<td><p>作成日付</p></td></td>
									<td><input type="datetime-local" name="article_date" value="<?php if(!empty($created_date)) echo $created_date?>" ></td>
								</label>
							</tr>
							<tr>
								<label>
									<td><p>カテゴリー</p></td></td>
									<td>
										<select name="category">
											<option value="0" <?php if($blog_category ==0) echo 'selected';?>>日常</option>
											<option value="1" <?php if($blog_category ==1) echo 'selected';?>>プログラミング</option>
											<option value="2" <?php if($blog_category ==2) echo 'selected';?>>ホテル</option>
										</select>
									</td>
								</label>
							</tr>
							<tr>
								<label>
									<td><p>記事要約</p></td>
									<td><textarea name="article_summary" cols="50px" rows="5px"><?php if(!empty($blog_summary)) echo $blog_summary ?></textarea></td>
								</label>
							</tr>
							
							<tr>
								<label>
									<td><p>記事内容</p></td>
									<td><textarea name="article_content" cols="50px" rows="20px"><?php if(!empty($blog_content)) echo $blog_content ?></textarea></td>
								</label>
							</tr>
							
							<tr>
								<td><input type="submit" value="削除" formaction="delete.php"></td>
								<td><input type="submit" value="保存" formaction="blog_save.php"></td>
								<td><input type="submit" value="公開"></td>
							</tr>
						</table>
					</form>
				</div>
					
			 </div>
			</div>	

			</div>


		






		<footer id="footer">
			


		</footer>




	</body>


</html>