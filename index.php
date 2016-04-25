<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="css/layout.css">
	<link rel="stylesheet" href="css/mycss/mystyle.css">
	<link rel="stylesheet" href="css/header/menu.css">
	<link rel="stylesheet" href="css/Mytable.css">
	<link rel="stylesheet" href="css/footer/footer-basic-centered.css">
	<link rel="stylesheet" href="css/frame/frame.css">
	<link rel="stylesheet" href="css/animate.css">
	<script type="text/javascript" src="js/jquery-2.2.3.min.js"></script>
	<script type="text/javascript" src="js/moment-2.13.0.min.js"></script>
	<script type="text/javascript" src="js/livestamp.js"></script>



	<link href='https://fonts.googleapis.com/css?family=Itim&subset=thai,latin' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Permanent+Marker' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Candal' rel='stylesheet' type='text/css'>


	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.0/jquery.min.js"></script>



</head>
<body>
	


	<!-- menu -->
	<div class="wrapper">
		<!-- header -->
		<div class="header"> 	
			<img src="images/cover/cover3.jpg" width="930px">

			<!-- menu -->

			<div id=main>
				<ul id=nav>
					<li class=home><a href="index.php">หน้าแรก HOME</a></li>
					<li class=guides><a href="#">ไกด์ GUIDES</a></li>
					<li class=heroes><a href="#">ฮีโร่ HEROES</a></li>
					<li class=item><a href="#">ไอเท็ม ITEMS</a></li>
					<li class=stats><a href="stats_player.php">สถิติ STATS</a></li>
					<li class=logout><a href="logout.php">LOGOUT</a></li>


				</ul>
			</div>
		</div>


		<!-- end menu -->
		<!-- end header -->
		<div class="mainCon">
			<div class="box sidebar">Left-sidebar</div>

			<!-- Main Content -->
			<div class="box">
			<form method="get" action="stats_players.php">
			<input name="search" id="search" type="text">
			<input type="submit" value="ค้นหา">
			</form>
				

				<br>



			</div><!-- end Main Content -->

			<div class="box sidebar">Right-sidebar</div>
		</div>
		<div class="footer"></div>
	</div>
	<br>
	<br>
	<br>
	<br>
	<br>
	<?php include 'footer.php'; ?>


	<!-- content  -->

	<!-- side bar -->

	<!--end side bar -->

	<!--footer -->

	<!--end footer -->

</body>

<script>
	
	document.querySelector(".button1").addEventListener("click", function(){
		var element = document.createElement("div");
		element.innerHTML = "<p>Additional Line</p><p>Additional Line</p><p>Additional Line</p>";
		document.querySelector(".content").appendChild(element);
	});


	function time_since($since) {
		$chunks = array(
			array(60 * 60 * 24 * 365 , 'year'),
			array(60 * 60 * 24 * 30 , 'month'),
			array(60 * 60 * 24 * 7, 'week'),
			array(60 * 60 * 24 , 'day'),
			array(60 * 60 , 'hour'),
			array(60 , 'minute'),
			array(1 , 'second')
			);

		for ($i = 0, $j = count($chunks); $i < $j; $i++) {
			$seconds = $chunks[$i][0];
			$name = $chunks[$i][1];
			if (($count = floor($since / $seconds)) != 0) {
				break;
			}
		}

		$print = ($count == 1) ? '1 '.$name : "$count {$name}s";
		return $print;
	}

	function timeAgo($timestamp){
		$datetime1=new DateTime("now");
		$datetime2=date_create($timestamp);
		$diff=date_diff($datetime1, $datetime2);
		$timemsg='';
		if($diff->y > 0){
			$timemsg = $diff->y .' year'. ($diff->y > 1?"'s":'');

		}
		else if($diff->m > 0){
			$timemsg = $diff->m . ' month'. ($diff->m > 1?"'s":'');
		}
		else if($diff->d > 0){
			$timemsg = $diff->d .' day'. ($diff->d > 1?"'s":'');
		}
		else if($diff->h > 0){
			$timemsg = $diff->h .' hour'.($diff->h > 1 ? "'s":'');
		}
		else if($diff->i > 0){
			$timemsg = $diff->i .' minute'. ($diff->i > 1?"'s":'');
		}
		else if($diff->s > 0){
			$timemsg = $diff->s .' second'. ($diff->s > 1?"'s":'');
		}

		$timemsg = $timemsg.' ago';
		return $timemsg;
	}




</script>

</html>