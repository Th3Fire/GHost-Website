<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<?php
	require_once("connect.php");
	?>

	<div class="wrapper">
		<!-- header -->
		<div class="header"> 	
			<img src="images/cover/cover3.jpg" width="930px">
		</div>
		<!-- menu -->
		<div class="header"> 	
			<div id=main>
				<ul id=nav>
					<li class=home><a href="index.php">หน้าแรก HOME</a></li>
					<li class=guides><a href="#">ไกด์ GUIDES</a></li>
					<li class=heroes><a href="#">ฮีโร่ HEROES</a></li>
					<li class=item><a href="#">ไอเท็ม ITEMS</a></li>
					<li class=stats><a href="stats_player.php">สถิติ STATS</a></li>
					<?php 
					if(!isset($_SESSION['UserID']))
					{
						echo '<li class=logout><a href="login.php">Login</a></li>';

					}else
					echo '<li class=logout><a href="logout.php">LOGOUT</a></li>';

					?>


				</ul>
			</div>

		</div>
	</body>
	</html>