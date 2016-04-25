<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="css/layout.css">
	<link rel="stylesheet" href="css/mycss/mystyle.css">
	<link rel="stylesheet" href="css/mycss/mystyle2.css">

	<link rel="stylesheet" href="css/mycss/searchboxstyle.css">
	<link rel="stylesheet" href="css/mycss/searchbox2style.css">
	<link rel="stylesheet" href="css/header/menu.css">
	<link rel="stylesheet" href="css/Mytable.css">
	<link rel="stylesheet" href="css/footer/footer-basic-centered.css">
	<link rel="stylesheet" href="css/frame/frame.css">
	<link rel="stylesheet" href="css/animate.css">
	<script type="text/javascript" src="js/jquery-2.2.3.min.js"></script>
	<script type="text/javascript" src="js/moment-2.13.0.min.js"></script>
	<script type="text/javascript" src="js/livestamp.js"></script>


	<link rel="stylesheet" href="css/mycss/topplayerstyle.css">
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	<!--webfonts-->
	<link href='http://fonts.googleapis.com/css?family=Lato:100,300,400,700,900,100italic,300italic,400italic,700italic' rel='stylesheet' type='text/css'>



	<link href='https://fonts.googleapis.com/css?family=Itim&subset=thai,latin' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Permanent+Marker' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Candal' rel='stylesheet' type='text/css'>


	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.0/jquery.min.js"></script>

	<style>

		body { color:#EEE; font:13px Tahoma, Arial, sans-serif; background:#000000 url(images/bg01.jpg) center top no-repeat;}

		
	</style>

</head>
<body>
	
	<script src="js/jquery.magnific-popup.js" type="text/javascript"></script>
	<script type="text/javascript" src="js/modernizr.custom.53451.js"></script> 

	<script>
		$(document).ready(function() {
			$('.popup-with-zoom-anim').magnificPopup({
				type: 'inline',
				fixedContentPos: false,
				fixedBgPos: true,
				overflowY: 'auto',
				closeBtnInside: true,
				preloader: false,
				midClick: true,
				removalDelay: 300,
				mainClass: 'my-mfp-zoom-in'
			});

		});
	</script>	

	<?php
	session_start();
	require_once("connect.php");

	/// Top play
	$sqlTopPlay = "SELECT name, COUNT(dotaplayers.id)
	FROM gameplayers
	LEFT JOIN games ON games.id = gameplayers.gameid
	LEFT JOIN dotaplayers ON dotaplayers.gameid = games.id
	AND dotaplayers.colour = gameplayers.colour
	LEFT JOIN dotagames ON games.id=dotagames.gameid
	WHERE NOT(hero <=> '') AND NOT(hero <=> NULL)
	GROUP BY name
	ORDER BY COUNT(dotaplayers.id) DESC 
	LIMIT 0,1";

     ///// TOP win
	$sqlTopWin = "SELECT name, COUNT(winner) 
	FROM gameplayers
	LEFT JOIN games ON games.id = gameplayers.gameid
	LEFT JOIN dotaplayers ON dotaplayers.gameid = games.id
	AND dotaplayers.colour = gameplayers.colour
	LEFT JOIN dotagames ON games.id = dotagames.gameid
	AND ((winner =1 AND dotaplayers.newcolour >=1 AND dotaplayers.newcolour <=5)
	OR (winner =2 AND dotaplayers.newcolour >=7 AND dotaplayers.newcolour <=11))
	WHERE NOT (hero <=> '')
	AND NOT (hero <=> NULL)
	AND NOT (winner <=> NULL)
	GROUP BY name
	order by name desc
	LIMIT 0 , 1";

	$sqlTopLongPlay = "SELECT * FROM gameplayers LEFT JOIN games ON games.id=gameplayers.gameid LEFT JOIN dotaplayers ON dotaplayers.gameid=games.id AND dotaplayers.colour=gameplayers.colour LEFT JOIN dotagames ON games.id=dotagames.gameid WHERE  NOT(hero <=> '') AND NOT(hero <=> NULL) AND NOT (min <=> NULL) AND NOT (sec <=> NULL) AND NOT (min <=> '') AND NOT (sec <=> '')  order by min  desc limit 0,1";



	$result = mysqli_query($con,$sqlTopPlay);
	$resultTopWin = mysqli_query($con,$sqlTopWin);
	$resultTLP = mysqli_query($con,$sqlTopLongPlay);


/////////////// Top Play
	if ($result->num_rows > 0) {
		while ($rowTopPlay = $result->fetch_array(MYSQL_BOTH)) 
		{

			$name = $rowTopPlay['name'];
			$totalplay = $rowTopPlay['COUNT(dotaplayers.id)'];

			
		}
	}

/////////////Long Play
	if ($resultTLP->num_rows > 0) {
		while ($rowTLP = $resultTLP->fetch_array(MYSQL_BOTH)) 
		{

			$nameTLP = $rowTLP['name'];
			
			$totalMin = $rowTLP['min'];
			$totalSec = $rowTLP['sec'];


			
		}
	}
/////////////// Top Win
	if ($resultTopWin->num_rows > 0) {
		while ($rowTopWin = $resultTopWin->fetch_array(MYSQL_BOTH)) 
		{

			$nameTOPWin = $rowTopWin['name'];
			$totalWin = $rowTopWin['COUNT(winner)'];
			
			//$totalplay = $rowTopPlay['COUNT(dotaplayers.id)'];

			
		}
	}
	/////////// Top Play
	$sqlImg =  "SELECT img from member WHERE Username='".$name."'";
	$resImgProfile = mysqli_query($con,$sqlImg);
	////////// Top  Win
	$sqlImgTopwin =  "SELECT img from member WHERE Username='".$nameTOPWin."'";
	$resImgTopWin = mysqli_query($con,$sqlImgTopwin);
	////////// Top Long play
	$sqlImgTLP =  "SELECT img from member WHERE Username='".$nameTLP."'";
	$resImgProfileTLP = mysqli_query($con,$sqlImgTLP);


////////// Top Long play
	if ($resImgProfileTLP->num_rows > 0) {
		while ($imgprofileTLP = $resImgProfileTLP->fetch_array(MYSQL_BOTH)) 
		{

			$pathImgTLP = $imgprofileTLP['img'];
			
			if($pathImgTLP == ""){
				$pathImgTLP = "NoImage.gif";
			}
		}
	}else{$pathImgTLP = "NoImage.gif";}

////////// Top  Win
	if ($resImgTopWin->num_rows > 0) {
		while ($imgTopWin = $resImgTopWin->fetch_array(MYSQL_BOTH)) 
		{

			$pathImgTopWin = $imgTopWin['img'];

			
			if($pathImgTopWin == ""){
				$pathImgTopWin = "NoImage.gif";
			}
		}
	}else{$pathImgTopWin = "NoImage.gif";}

////////// Top Play
	if ($resImgProfile->num_rows > 0) {
		while ($imgprofile = $resImgProfile->fetch_array(MYSQL_BOTH)) 
		{

			$pathImg = $imgprofile['img'];
			if($pathImg == ""){
				$pathImg = "NoImage.gif";
			}
		}
	}else{$pathImg = "NoImage.gif";}

	
	?>







	<div class="wrapper">

		<!-- menu -->
		<?php include 'header.php'; ?>

		<!-- end menu -->
		<!-- end header -->
		<div class="mainCon">
			<div class="box sidebar"><!--Left-sidebar --></div>

			<div class="box"><!-- Main Content -->





				<div class="myDivsearch">
					

					<section class="webdesigntuts-workshop">
						<form action="stats_players.php" method="get">		    
							<input type="search" placeholder="ค้นหาชื่อผู้เล่น..." name="search" id="search" required>		    	
							<button>Search</button>
						</form>
					</section>


				</div>

				<div class="myConIndex">  


					<script class="cssdeck" src="//cdnjs.cloudflare.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>

					<div class="pricing-plans">
						<div class="wrap">
							<div class="price-head">

							</div>
							<br><br><br><br>
							<font size="6" color="yellow">อันดับผู้เล่น</font>

							<div class="pricing-grids">
								<div class="animated rubberBand">
									<div class="pricing-grid1">
										<div class="price-value">
											<h2><a href="#">
												<?php
												echo "<img class='frame4' src='imgProfile/".$pathImg."'". " alt=".$name." width='30px' height='30px'> ";
												?>
											</a></h2>
											<h5><span><?php echo $name; ?></span><lable><br>ทั้งหมด: <?php echo $totalplay; ?> เกม</lable></h5>
											<div class="sale-box">
												<span class="on_sale title_shop">"จำนวนเกม" สูงสุด</span>
											</div>

										</div>

										<div class="cart1">
											<?php  echo '<a class="popup-with-zoom-anim" href="stats_players.php?search='.$name.'">ดูโปรไฟล์</a>';  ?>
										</div>

									</div>
								</div><!-- End animated -->
								<div class="animated rubberBand">
									<div class="pricing-grid2">
										<div class="price-value two">
											<h3><a href="#">
												<?php

												echo "<img class='frame4' src='imgProfile/".$pathImgTopWin."'". " alt=".$nameTOPWin." width='30px' height='30px'> ";
												?>
											</a></h3>
											<h5><span><?php echo $nameTOPWin; ?></span><lable><br>ชนะทั้งหมด: <?php echo $totalWin; ?> เกม</lable></h5>
											<div class="sale-box two">
												<span class="on_sale title_shop">"ชนะ" สูงสุด</span>
											</div>

										</div>


										<div class="cart2">
											<?php  echo '<a class="popup-with-zoom-anim" href="stats_players.php?search='.$nameTOPWin.'">ดูโปรไฟล์</a>';  ?>
										</div>

									</div>
								</div><!-- End animated -->
								<div class="animated rubberBand">
									<div class="pricing-grid3">
										<div class="price-value three">
											<h4><a href="#">
												<?php
												echo "<img class='frame4' src='imgProfile/".$pathImgTLP."'". " alt=".$nameTLP." width='30px' height='30px'> ";
												?>
											</a></h4>
											<font style="color: black;"><h5><span><?php echo $nameTLP; ?></span><lable><br><?php echo $totalMin." นาที ".$totalSec." วินาที"; ?></lable></h5></font>
											<div class="sale-box three">
												<span class="on_sale title_shop">"เวลาในการเล่น" นานที่สุด</span>
											</div>

										</div>

										<div class="cart3">
											<?php  echo '<a class="popup-with-zoom-anim" href="stats_players.php?search='.$nameTLP.'">ดูโปรไฟล์</a>';  ?>
										</div>

									</div>
								</div><!-- End animated -->
								<div class="clear"> </div>
								<!--pop-up-grid-->

								<!--pop-up-grid-->
							</div>
							
							<div class="clear"> </div>

						</div>

					</div> 	
					
					


					
				</div>




			</div><!-- end Main Content -->

			<div class="box sidebar"><!-- Right-sidebar --></div>
		</div>
		<div class="footer">
			<img src="images/bg03_2.png" alt="Smiley face" align="middle" width="100%" height="100%">
		</div>
	</div>

</div>



<!-- ////////////////////////////////////////  -->



<?php include 'footer.php'; ?>


<!-- content  -->

<!-- side bar -->

<!--end side bar -->

<!--footer -->

<!--end footer -->

</body>



</html>