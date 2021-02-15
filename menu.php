	<head>
		<link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
		<link rel="preconnect" href="https://fonts.gstatic.com">
		<link href="https://fonts.googleapis.com/css2?family=Kosugi+Maru&family=Yusei+Magic&display=swap" rel="stylesheet">

	</head>

	<header id="header">
		<div id="icon_menu">

			<ul class="snsbtniti">
				<li><a href="https://twitter.com/junsanjunsan14" class="flowbtn17 fl_tw2"><i class="fab fa-twitter"></i></a></li>
				<!--<li><a href="https://www.instagram.com/junsanjunsan14/?hl=ja" class="flowbtn17 insta_btn2"><i class="fab fa-instagram"></i></a></li>
				<li><a href="https://www.facebook.com/sunajun" class="flowbtn17 fl_fb2"><i class="fab fa-facebook-f"></i></a></li>
			-->
			</ul>
		</div>

		<div id="site_menu">



	 	<?php



	 	if(basename(dirname($_SERVER['PHP_SELF'])) !== 'category'){ ?>

			

				
						<ul>
							<li><a href="index.php">HOME</a></li>
							<li><a href="category/daily.php">DAILY</a></li>
							<li><a href="category/programing.php">PROGRAMING</a></li>
							<li><a href="category/hotel.php">HOTEL</a></li>
							<li><a href="about.php">ABOUT</a></li>					
							<li><a href="contact.php">CONTACT</a></li>
							<li><a href="login.php">LOGIN</a></li>
						</ul>
					
				
		<?php }else{ ?>

		
						<ul>
							<li><a href="../index.php">HOME</a></li>
							<li><a href="daily.php">DAILY</a></li>
							<li><a href="programing.php">PROGRAMING</a></li>
							<li><a href="hotel.php">HOTEL</a></li>
							<li><a href="../about.php">ABOUT</a></li>					
							<li><a href="../contact.php">CONTACT</a></li>
							<li><a href="../login.php">LOGIN</a></li>
						</ul>				
		
		<?php }?>

			</div>
		</header>
