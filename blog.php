<?php
	require('function.php');
	$blog_id = $_GET['id'];

	db_connect();
	$stmt = $dbh->prepare('SELECT*FROM blog WHERE id = :blog_id');
	$stmt->execute(array(':blog_id'=>$blog_id));
	$data = $stmt->fetch(PDO::FETCH_ASSOC);
	$crd_format = new DateTime($data['create_date']);
	$upd_format = new DateTime($data['update_date']);
?>


<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="UTF-8">
		<title> BLOG </title>
		<link rel="preconnect" href="https://fonts.gstatic.com">
		<link href="https://fonts.googleapis.com/css2?family=M+PLUS+Rounded+1c:wght@100&display=swap" rel="stylesheet">
		<link rel="stylesheet" href="style.css">


	</head>

	<body>
		<?php require('menu.php')?>

			<div class="content_width">
				<div id="blog_maincontent">


					<h2><?php echo $data['title']; ?></h2>
					<h3>作成日時:<?php echo $crd_format->format('Y/m/d H:i'); ?></h3>
					<h3>更新日時:<?php echo $upd_format->format('Y/m/d H:i'); ?></h3>
					<p><?php echo $data['content']; ?></p>

					</br><span style="font-size:30px;"> <a href="<?php echo dirname($_SERVER['SERVER_NAME']);?>
					<?php
						switch($_SESSION['category']){
							case 0: 
								echo '/category/daily.php';
								break;
							case 1: 
								echo '/category/programing.php';
								break;
							case 2:
								echo '/category/hotel.php';
								break;
							case 100:
								echo '';
						}	
					?>"> &lt;戻る</a></span>
	




				</div>
			</div>



		





<footer id="footer">

			<p>Copyright junsan14. All Rights Reserved.</p>
		</footer>




	</body>


</html>