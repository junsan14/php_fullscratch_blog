<?php

	require('function.php');

		global $error_msg;
		require('study_time_cal.php');

		

		db_connect();
		$_SESSION['category'] = 100;
		$article_num = $dbh->prepare('SELECT COUNT(*) FROM blog WHERE delete_flag = 0 AND edit_flag = 0');
		
		$stmt = $dbh->prepare('SELECT*FROM blog  WHERE delete_flag = 0 AND edit_flag = 0 order by create_date DESC');
		$stmt->execute();
		$article_num->execute();
		$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$count = $article_num -> fetchColumn();
		

		if($count<6){
			$blog_num = $count;
		}else{
			$blog_num= 6;
		}
		



?>




<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="UTF-8">
		<title> HOME </title>
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
				<div id="blog">
					<h2 class="title">BLOG</h2>

					
						
							<?php
								for($i=0; $i < $blog_num; $i++){
		
									
									echo '<div class="blog_col">';
										echo '<h3 class="blog_title">'.$data[$i]['title'].'</h3>';
										echo '<h3 class="blog_date">'.date('Y-m-d',strtotime($data[$i]['create_date'])).'</h3>';
										echo '<p class="blog_summary">'.$data[$i]['summary'].'<p>';
										echo '<a href="blog.php?id='.$data[$i]['id'].'"><botton class="blog_gobotton">続きを読む</botton></a>';
									echo '</div>';
								}
							?>

					


				

				</div>
			</div>

			




		<footer id="footer">

			<p>Copyright junsan14. All Rights Reserved.</p>
		</footer>




	</body>


</html>