<?php
	
	require('function.php');
	require('admit.php');

		$user_id = $_SESSION['user_id'];

		db_connect();
		$article_num = $dbh->prepare('SELECT COUNT(*)FROM blog WHERE user_id = :user_id AND delete_flag = 0');
		$stmt = $dbh->prepare('SELECT*FROM blog WHERE user_id = :user_id AND delete_flag = 0');
		$stmt->execute(array(':user_id'=>$_SESSION['user_id']));
		$article_num->execute(array(':user_id'=>$_SESSION['user_id']));

		$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$count = $article_num->fetch(PDO::FETCH_COLUMN);
		


?>


<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="UTF-8">
		<title> BLOG EDIT </title>
		<link rel="preconnect" href="https://fonts.gstatic.com">
		<link href="https://fonts.googleapis.com/css2?family=M+PLUS+Rounded+1c:wght@100&display=swap" rel="stylesheet">
		<link rel="stylesheet" href="style.css">
	</head>

	<body>
		<?php require('mypage_menu.php')?>


			<div class="content_width">
			 <div id="blog">
				<div id="blog_edit">
					<h2 class="title">CHOOSE THE BLOG YOU WANNA EDIT</h2>
						<p style="text-align: center;color:red;"><?php  if(!empty($_SESSION['delete_scc'])) echo $_SESSION['delete_scc'];

						?></p>
						<p>編集する記事を選んでください</p>
						<form method="get" action="<?php echo 'edit_article.php'?>">
							<table>
								<tr> <th>BLOG ID</th> <th>BLOG TITLE</th> <th> CREATED DATE</th> <th> PUBLICATION</th> </tr>
							<?php

								for($i=0; $i<$count; $i++){

									if($data[$i]['edit_flag'] == 0){
										$PUBLICATION = '公開';
									}else if($data[$i]['edit_flag'] == 1){
										$PUBLICATION = '保存';
									}

									echo '<tr><td>'.$data[$i]['id'].'</td><td><a href="edit_article.php?id='.$data[$i]['id'].'">'.$data[$i]['title'].'</td><td>'.$data[$i]['create_date']. '</td><td>'.$PUBLICATION.'</td></a></tr>';
									
								}

							


							?>

							</table>
							

					

					
						

				</div>	
			 </div>
			</div>


		






		<footer id="footer">


		</footer>




	</body>


</html>