<!DOCTYPE html>
<html>
<head>
	<link rel="shortcut icon" href="favicon2.ico" type="image/x-icon" />
	<link rel="stylesheet" href="css/layout.css">
	<link rel="stylesheet" href="css/mycss/mystyle.css">
	<link rel="stylesheet" href="css/header/menu.css">
	<link rel="stylesheet" href="css/mycss/tabstyle.css">
	<link rel="stylesheet" href="css/Mytable.css">
	<link rel="stylesheet" href="css/mycss/mystyle2.css">
	<link rel="stylesheet" href="css/footer/footer-basic-centered.css">
	<link rel="stylesheet" href="css/frame/frame.css">
	<link rel="stylesheet" href="css/animate.css">

	<link href="css/upload/style.css" rel="stylesheet">
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/jquery.form.js"></script>

	<script type="text/javascript" src="js/moment-2.13.0.min.js"></script>
	<script type="text/javascript" src="js/livestamp.js"></script>



	<link href='https://fonts.googleapis.com/css?family=Itim&subset=thai,latin' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Permanent+Marker' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Candal' rel='stylesheet' type='text/css'>



	<script>
		$(function() {
			$(".meter > span").each(function() {
				$(this)
				.data("origWidth", $(this).width())
				.width(0)
				.animate({
					width: $(this).data("origWidth")
				}, 1200);
			});
		});
	</script>
	
	<style>

		body { color:#EEE; font:13px Tahoma, Arial, sans-serif; background:#000000 url(images/bg01.jpg) center top no-repeat;}

		
	</style>

	<script>
		$(document).on('change', '#image_upload_file', function () {
			var progressBar = $('.progressBar'), bar = $('.progressBar .bar'), percent = $('.progressBar .percent');

			$('#image_upload_form').ajaxForm({
				beforeSend: function() {
					progressBar.fadeIn();
					var percentVal = '0%';
					bar.width(percentVal)
					percent.html(percentVal);
				},
				uploadProgress: function(event, position, total, percentComplete) {
					var percentVal = percentComplete + '%';
					bar.width(percentVal)
					percent.html(percentVal);
				},
				success: function(html, statusText, xhr, $form) {		
					obj = $.parseJSON(html);	
					if(obj.status){		
						var percentVal = '100%';
						bar.width(percentVal)
						percent.html(percentVal);
						$("#imgArea>img").prop('src',obj.image_medium);			
					}else{
						alert(obj.error);
					}
				},
				complete: function(xhr) {
					progressBar.fadeOut();			
				}	
			}).submit();		

		});
	</script>


	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" > 

	<meta name="description" content="Camera a free jQuery slideshow with many effects, transitions, adaptive layout, easy to customize, using canvas and mobile ready"> 
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>GHost++ Welcome - Stats Player</title>
	
</head>
<body>
	<?php

	session_start();
	require_once("connect.php");


	$name = $_GET['search'];
	$totalplay;
	$totalwin;
	$totallose;
	$totalkill;
	$totaldeath;
	$totlalassist;
	$totaldeath;
	$rateWin;
	$lastHeroesPlay;
	$topHeroesPlay;

	$sqlNamePlayer = "SELECT name FROM gameplayers WHERE name='".$name."'";
	$resNamePlayer = mysqli_query($con,$sqlNamePlayer);
	$sqlImg =  "SELECT * from member WHERE Username='".$name."'";
	$resImgProfile = mysqli_query($con,$sqlImg);

	if ($resNamePlayer->num_rows > 0)
	{
		$namePro = "<font face='Candal' size='4'><b>".$_GET['search']."</b></font>";


	}else
	{
		if($_GET['search'] == "")
		{
			$namePro = "<div class=blink><font face='Candal' size='4' style='color:#ff0000'><b>Please input player name !!!</b></font></div>";

		}else
		$namePro = "<div class=blink><font face='Candal' size='4' style='color:#ff0000'><b>Not found !!! <br>".$_GET['search']." name</b></font></div>";


	}

	$sql = "SELECT COUNT(dotaplayers.id), SUM(kills), SUM(deaths), SUM(creepkills), SUM(creepdenies), SUM(assists), SUM(neutralkills), SUM(towerkills), SUM(raxkills), SUM(courierkills) FROM gameplayers LEFT JOIN games ON games.id=gameplayers.gameid LEFT JOIN dotaplayers ON dotaplayers.gameid=games.id AND dotaplayers.colour=gameplayers.colour WHERE name='".$name."' AND NOT(hero <=> '') AND NOT(hero <=> NULL) " ;

	$sql2 = "SELECT COUNT(*) FROM gameplayers LEFT JOIN games ON games.id=gameplayers.gameid LEFT JOIN dotaplayers ON dotaplayers.gameid=games.id AND dotaplayers.colour=gameplayers.colour LEFT JOIN dotagames ON games.id=dotagames.gameid WHERE name= '".$name."' AND ((winner=1 AND dotaplayers.newcolour>=1 AND dotaplayers.newcolour<=5) OR (winner=2 AND dotaplayers.newcolour>=7 AND dotaplayers.newcolour<=11))";

	$sql3 ="SELECT COUNT(*) FROM gameplayers LEFT JOIN games ON games.id=gameplayers.gameid LEFT JOIN dotaplayers ON dotaplayers.gameid=games.id AND dotaplayers.colour=gameplayers.colour LEFT JOIN dotagames ON games.id=dotagames.gameid WHERE name='".$name."' AND ((winner=2 AND dotaplayers.newcolour>=1 AND dotaplayers.newcolour<=5) OR (winner=1 AND dotaplayers.newcolour>=7 AND dotaplayers.newcolour<=11))";
///// Last Heroes play
	$sql5 = "SELECT * FROM gameplayers LEFT JOIN games ON games.id=gameplayers.gameid LEFT JOIN dotaplayers ON dotaplayers.gameid=games.id AND dotaplayers.colour=gameplayers.colour LEFT JOIN dotagames ON games.id=dotagames.gameid WHERE name='".$name."' AND NOT(hero <=> '') AND NOT(hero <=> NULL) order by dotagames.gameid desc limit 0,3";

///Top 3 Heroes
	$sql6 = "SELECT games.id,hero,winner,count(hero), SUM(kills), SUM(deaths), SUM(creepkills), SUM(creepdenies), SUM(assists), SUM(neutralkills), SUM(towerkills), SUM(raxkills), SUM(courierkills) FROM gameplayers LEFT JOIN games ON games.id=gameplayers.gameid LEFT JOIN dotaplayers ON dotaplayers.gameid=games.id AND dotaplayers.colour=gameplayers.colour LEFT JOIN dotagames ON games.id=dotagames.gameid WHERE name='".$name."' AND NOT(hero <=> '') AND NOT(hero <=> NULL) group by hero order by count(hero) desc limit 0,3";
///All Heroes ever play
	$sql7 = "SELECT games.id,hero,winner,count(hero), SUM(kills), SUM(deaths), SUM(creepkills), SUM(creepdenies), SUM(assists), SUM(neutralkills), SUM(towerkills), SUM(raxkills), SUM(courierkills) FROM gameplayers LEFT JOIN games ON games.id=gameplayers.gameid LEFT JOIN dotaplayers ON dotaplayers.gameid=games.id AND dotaplayers.colour=gameplayers.colour LEFT JOIN dotagames ON games.id=dotagames.gameid WHERE name='".$name."' AND NOT(hero <=> '') AND NOT(hero <=> NULL) group by hero order by count(hero) desc ";


	$sqlxx = "SELECT games.id,hero,winner,count(hero), SUM(kills), SUM(deaths), SUM(creepkills), SUM(creepdenies), SUM(assists), SUM(neutralkills), SUM(towerkills), SUM(raxkills), SUM(courierkills) FROM gameplayers LEFT JOIN games ON games.id=gameplayers.gameid LEFT JOIN dotaplayers ON dotaplayers.gameid=games.id AND dotaplayers.colour=gameplayers.colour LEFT JOIN dotagames ON games.id=dotagames.gameid WHERE name='".$name."' group by hero order by count(hero) desc limit 0,3";
/// Last Play
	$sqlDateTime = "SELECT datetime FROM gameplayers LEFT JOIN games ON games.id=gameplayers.gameid LEFT JOIN dotaplayers ON dotaplayers.gameid=games.id AND dotaplayers.colour=gameplayers.colour LEFT JOIN dotagames ON games.id=dotagames.gameid WHERE name='".$name."' AND NOT(hero <=> '') AND NOT(hero <=> NULL) order by dotagames.gameid desc limit 0,1";

	$sqlAllheroesEverPlay = "SELECT * FROM gameplayers LEFT JOIN games ON games.id=gameplayers.gameid LEFT JOIN dotaplayers ON dotaplayers.gameid=games.id AND dotaplayers.colour=gameplayers.colour LEFT JOIN dotagames ON games.id=dotagames.gameid WHERE name='".$name."' AND NOT(hero <=> '') AND NOT(hero <=> NULL) order by dotagames.gameid desc";

/// image profile



	while ($rowNamePlayer = $resNamePlayer->fetch_array(MYSQL_BOTH)) 
	{
		$name = $_GET['search'];
	}

	if ($resImgProfile->num_rows > 0) {
		while ($imgprofile = $resImgProfile->fetch_array(MYSQL_BOTH)) 
		{

			$pathImg = $imgprofile['img'];
			if($pathImg == ""){
				$pathImg = "NoImage.gif";
			}
		}
	}else{$pathImg = "NoImage.gif";}

	$result = mysqli_query($con,$sql);
	$result2 = mysqli_query($con,$sql2);
	$result3 = mysqli_query($con,$sql3);
	$result5 = mysqli_query($con,$sql5);
	$result6 = mysqli_query($con,$sql6);
	$result7 = mysqli_query($con,$sql7);
	$result8 = mysqli_query($con,$sqlDateTime);
	$resAllHeroesPlay = mysqli_query($con,$sqlAllheroesEverPlay);
//}else
//{
//	echo "not found player name";
//	$name = "Not found player name";
//}
	?>

	<div class="wrapper">

		<!-- menu -->
		<?php include 'header.php'; ?>


		<!-- end menu -->
		<!-- end header -->
		<div class="mainCon">
			<div class="box sidebar"><!-- For Left-sidebar --></div>

			<div class="box"><!-- Main Content -->

				<h1><font size="5">สถิติ (Stats)</font></h1>
				<img src="images/separator_great.jpg">

				<div class="maindiv" style="min-height: 636px; background-color: #000; box-shadow: #000 0px 0px 20px; margin-bottom: 30px; background-image:url(.../../images/bg_content.jpg); background-position: 0 70px; background-repeat:no-repeat; border: #212121 solid 1px; background-size: 860px 566px; background-repeat: no-repeat;">
					<div class="animated swing">

						<div class="myDiv">   	
							<div class="topleft">
								<section style="margin: 10px;">
									<fieldset style="min-height:100px;">

										<legend> 

											<?php echo $namePro;


											?>

											<!-- <font face="Candal" size="4"><b><?php echo $_GET['search']; ?></b></font>  -->

										</legend>
										<label> <br/>

											<!-- load image profile -->

											<div id="imgContainer">

											
											<?php 
											$checkNoImg = false;
											$sqlImg =  "SELECT img from member WHERE Username='".$_GET['search']."'";
											$resImgProfile = mysqli_query($con,$sqlImg);

													if ($resImgProfile->num_rows > 0) {
														while ($imgprofile = $resImgProfile->fetch_array(MYSQL_BOTH)) 
														{
															if($imgprofile['img'] == 0)
															{
																$checkImg = false;

															}else
															{
																$checkImg = true;
															}
															
														}
													}else
													{
														$checkNoImg = true;
														echo '<div id="imgArea"><img src="img/default.jpg">';
														echo "No image";

													}
	

													if($checkImg == false && $checkNoImg == false){
														echo '<div id="imgArea"><img src="img/default.jpg">';
													}else if($checkImg == true && $checkNoImg == false){
														echo '<div id="imgArea"><img src="img/uploades/medium/'.$_GET['search'].'.jpg" >';
													}
													

													?> 
													
													
												</div>
									
										</div>

										<!-- End load image profile -->


									</label>
									<label> <br/> 

										<?php

										while ($row = $result->fetch_array(MYSQL_BOTH)) 
										{

											$totalplay = $row['COUNT(dotaplayers.id)'];
											$totalkill = $row['SUM(kills)'];
											$totaldeath = $row['SUM(deaths)'];
											$totlalassist = $row['SUM(assists)'];




										}
										while ($rowTime = $result8->fetch_array(MYSQL_BOTH)) 
										{
											$lastTimePlay = $rowTime['datetime'];
										}


										$lastHeroesPlay = $row['hero'];
										$time = $row['datetime'];


										while ($row = $result2->fetch_array(MYSQL_BOTH)) 
										{

											$totalwin = $row['COUNT(*)'];

										}

										while ($row = $result3->fetch_array(MYSQL_BOTH)) 
										{

											$totallose = $row['COUNT(*)'];

										}


										$rateWin = ($totalwin/($totalwin+$totallose)) * 100;




										echo "<font face='Itim' size='4'color='#FF34B3' class='aa'>";
										echo "เล่นมาแล้ว ".$totalplay." เกม<br>";
										echo "</font>";
										echo "<font face='Itim' size='4'color='yellow' class='a'>";
										echo "Win Rate ";
										echo number_format((float)$rateWin, 2, '.', '')." %<br>";
										echo "</font>";

										?>
										<!-- Progress bar holder -->
										<div id="progress" class="myDiv" style="height: 10px; width:120px;border:1px solid #ccc; background-color: #ff4000;" ></div>
										<!-- Progress information -->
										<div id="information" style="width"></div>
										<?php
// Total processes
										$total = 10;
// Loop through process

  // Calculate the percentation
										$percent = intval(($totalwin/($totalwin+$totallose)) * 100)."%";
  // Javascript for updating the progress bar and information
										echo '<script language="javascript">
										document.getElementById("progress").innerHTML="<div style=\"width:'.$percent.';background-color:#00ff40;height:10px;\">&nbsp;</div>";
									</script>';

									echo "<font face='Itim' size='4'color='#009933'>";
									echo "ชนะ  ".$totalwin."</font><font face='Itim' size='4'color='red'> แพ้ ".$totallose."</font><br>";
									echo "";
									echo "<font face='Itim' size='4'color='white'>";
									echo "Kills  ".$totalkill." Deaths ".$totaldeath." Assists ".$totlalassist."<br>";
									echo "</font>";

									echo '<div class="onlinkcolor">เล่นล่าสุด ';
									echo '<abbr title="'.$lastTimePlay.'" data-livestamp="'.$lastTimePlay.'"></abbr>';
									echo '</div>';

									?></label>
								</fieldset>

							</section>
						</div>
					</div>



				</div><!-- end animated -->


				<br>

				<div class="tbDiv" >


					<!-- My Tab -->
					<script>
						jQuery(document).ready(function() {
							jQuery('.tabs .tab-links a').on('click', function(e)  {
								var currentAttrValue = jQuery(this).attr('href');

        // Show/Hide Tabs
        jQuery('.tabs ' + currentAttrValue).fadeIn(400).siblings().hide();

        // Change/remove current tab to active
        jQuery(this).parent('li').addClass('active').siblings().removeClass('active');

        e.preventDefault();
    });
						});

					</script>

					<div class="tabs">

						<ul class="tab-links">
							<li class="active"><a href="#tab_1">ฮีโร่ที่เล่นมากที่สุด</a></li>
							<li><a href="#tab_2">ฮีโร่ที่เล่นล่าสุด</a></li>
							<li><a href="#tab_3">จัดอันดับฮีโร่ที่เคยเล่น</a></li>
							<li><a href="#tab_4">ฮีโร่ที่เคยเล่นทั้งหมด</a></li>
							<li><a href="#tab_5">เรคคอร์ด (Records) เด่น</a></li>
						</ul>

						<div class="tab-content">

							<div id="tab_1" class="tab active">
								<!--  Top Heroes play  -->
								<?php
								echo "<div class='topleft'><font style='color: white' size='5' face='Itim'>ฮีโร่ (Heroes) ที่ถูกเล่นมากที่สุด</font></div>";
								echo "<table style=width:100%>";
								echo "<tr><th class='text-center'> ฮีโร่</th><th class='text-center'>Win Rate</th><th class='text-center'>จำนวนเกมที่เล่น</th><th class='text-center'>K/D/A ฮีโร่</th><th class='text-center'>K/D/N ครีพ</th></tr>";
								echo "<col width='23%'/>";
								echo "<col width='12%'/>";
								echo "<col width='15%'/>";
								echo "<col width='25%'/>";
								echo "<col width='25%'/>";

	//$checkCount = 0;
	//$_countAll = 0;
								while ($row = $result6->fetch_array(MYSQL_BOTH)) 
								{
									$countWin = 0;
									$countLose = 0;
									$countDraw = 0;

									$topHeroesPlay = $row['hero'];
									$upperNameHeroes = strtoupper($topHeroesPlay);

									$sqlHero = "SELECT games.id,hero,winner FROM gameplayers LEFT JOIN games ON games.id=gameplayers.gameid LEFT JOIN dotaplayers ON dotaplayers.gameid=games.id AND dotaplayers.colour=gameplayers.colour LEFT JOIN dotagames ON games.id=dotagames.gameid WHERE name= '".$name."' AND hero= '".$topHeroesPlay."' group by games.id ";
									$resultCountHero = mysqli_query($con,$sqlHero);

									while ($row2 = $resultCountHero->fetch_array(MYSQL_BOTH)) 

									{
										if($row2['winner'] == 1){
											$countWin++;
										}else if($row2['winner'] == 2){
											$countLose++;
										}else {
											$countDraw++;
										}
									}


//////////////////////Find name of heroo ////////////////////////////////////////////

									$sqlHeroName = "SELECT description from heroes where heroid = '".$topHeroesPlay."'";
									$resHeroName = mysqli_query($con,$sqlHeroName);

									while ($heroName = $resHeroName->fetch_array(MYSQL_BOTH)) 

									{
										$_heroName = $heroName['description'];
									}

//////////////////////////////////////////////////////////////////////////////////////

									echo "<tr>";
									$checkTopHero = flase;

									if($row['count(hero)'] >1 ){
										$checkTopHero = true;



										echo "<td>";

										echo '<div  style="overflow:hidden;width:100%">
										<div id="inner" style="overflow:hidden;width:100%;height:35px" >

											<div style="float:left;width:20%; padding:2px 0;">
												<img src="images/heroes/'.$upperNameHeroes.'.gif"title='.$_heroName.' alt='.$_heroName.' width="30" height="30" >
											</div>


											<div style="float:left;width:80%; padding:8px 0"> <b>'.$_heroName.'</b></div>
										</div>  

									</div>';


									echo "</td>";


									$percentRateWin = ($countWin/($countWin+$countLose))*100;
									echo "<td class='text-center'>" ;

									echo number_format((float)$percentRateWin, 2, '.', '')." %";

									echo " 
									<div class='meter'>
										<span style='width: ".$percentRateWin."%'></span>
									</div>";


									echo "</td>";
		//$_countAll += $row['count(hero)'];
									echo "<td class='text-center'>".$row['count(hero)'];

									echo " 
									";
		//echo "</td>";
		//echo "<td>&nbsp&nbsp&nbsp<font style='color:#99cc00'>".$row['SUM(kills)']."</font> Deaths:".$row['SUM(deaths)']." Assists: ".$row['SUM(assists)']."</td>";

		/// Stats Hero
									echo "<td class='topcenter'>";
									echo "<font style='color:#99cc00'>";
									echo $row['SUM(kills)']."</font> / ";
									echo "<font style='color:#ff6666'>";
									echo $row['SUM(deaths)']."</font> / ";
									echo "<font style='color:#6699ff'>";
									echo $row['SUM(assists)']."</font>";
									echo "</td>";

		/// Stats creep
									echo "<td class='topcenter'>";
									echo "<font style='color:#99cc00'>";
									echo $row['SUM(creepkills)']."</font> / ";
									echo "<font style='color:#ff6666'>";
									echo $row['SUM(creepdenies)']."</font> / ";
									echo "";

		/// Stats Neutralkill

									echo "<font style='color:#cc66ff'>";
									echo $row['SUM(neutralkills)']."</font>";
									echo "</td>";		

		//echo "<td>&nbsp&nbsp&nbspKills: ".$row['SUM(creepkills)']." Denies: ".$row['SUM(creepdenies)']." 
		//Neutral: ".$row['SUM(neutralkills)']."</td>";
		//$checkCount++;
		//$_count -= 20;

   					//$heroTop_Array[$count] = "Kills:".$row['SUM(kills)']." Deaths:".$row['SUM(deaths)']."";

   					 //echo $heroTop_Array[$count];

								}else if($checkTopHero == flase){

									echo "<td>";

									echo '<div  style="overflow:hidden;width:100%">
									<div id="inner" style="overflow:hidden;width:100%;height:35px" >

										<div style="float:left;width:20%; padding:2px 0;">
											<img src="images/heroes/'.$upperNameHeroes.'.gif"title='.$_heroName.' alt='.$_heroName.' width="30" height="30" >
										</div>


										<div style="float:left;width:80%; padding:8px 0"> <b>'.$_heroName.'</b></div>
									</div>  

								</div>';


								echo "</td>";


								$percentRateWin = ($countWin/($countWin+$countLose))*100;
								echo "<td class='text-center'>" ;

								echo number_format((float)$percentRateWin, 2, '.', '')." %";

								echo " 
								<div class='meter'>
									<span style='width: ".$percentRateWin."%'></span>
								</div>";



								echo "</td>";
								$_countAll += $row['count(hero)'];
								echo "<td class='text-center'>".$row['count(hero)'];

								echo " 
								";

	/*
	echo "</td>";
	echo "<td>&nbsp&nbsp&nbspKills: ".$row['SUM(kills)']." Deaths:".$row['SUM(deaths)']." Assists: ".$row['SUM(assists)']."</td>";

	echo "<td>&nbsp&nbsp&nbspKills: ".$row['SUM(creepkills)']." Denies: ".$row['SUM(creepdenies)']." 
	Neutral: ".$row['SUM(neutralkills)']."</td>";

	*/

	//$checkCount++;
	//$_count -= 20;

	/// Stats Hero
	echo "<td class='topcenter'>";
	echo "<font style='color:#99cc00'>";
	echo $row['SUM(kills)']."</font> / ";
	echo "<font style='color:#ff6666'>";
	echo $row['SUM(deaths)']."</font> / ";
	echo "<font style='color:#6699ff'>";
	echo $row['SUM(assists)']."</font>";
	echo "</td>";

		/// Stats creep
	echo "<td class='topcenter'>";
	echo "<font style='color:#99cc00'>";
	echo $row['SUM(creepkills)']."</font> / ";
	echo "<font style='color:#ff6666'>";
	echo $row['SUM(creepdenies)']."</font> / ";

		/// Stats Neutralkill

	echo "<font style='color:#cc66ff'>";
	echo $row['SUM(neutralkills)']."</font>";
	echo "</td>";	
}


echo "</tr> ";

}
echo "</table>"

?>
</div> <!-- end tab 1 -->

<div id="tab_2" class="tab">
	<!--  Last Heroes play  -->

	<?php

	echo "<div class='topleft'><font style='color: white' size='5' face='Itim'>เกม (Matches) ที่เล่นล่าสุด</font></div>";
	echo "<table style=width:100% >";
	echo "<tr><th class='text-center'>ฮีโร่</th><th class='text-center'>ผล</th><th class='text-center'>เวลาการเล่น</th><th class='text-center'>K/D/A ฮีโร่</th><th class='text-center'>K/D/N ครีพ</th></tr>";

	echo "<col width='23%'/>";
	echo "<col width='12%'/>";
	echo "<col width='15%'/>";
	echo "<col width='25%'/>";
	echo "<col width='25%'/>";


	while ($row = $result5->fetch_array(MYSQL_BOTH)) 
	{


		$lastHeroesPlay = $row['hero'];
		$time = $row['datetime'];

//////////////////////Find name of hero ////////////////////////////////////////////

		$sqlHeroName = "SELECT description from heroes where heroid = '".$lastHeroesPlay."'";
		$resHeroName = mysqli_query($con,$sqlHeroName);


		while ($heroName = $resHeroName->fetch_array(MYSQL_BOTH)) 

		{
			$_heroName = $heroName['description'];
		}

//////////////////////////////////////////////////////////////////////////////////////


		$upperNameHeroes = strtoupper($lastHeroesPlay);
		if($_heroName != NULL){
		//echo "<img src='images/heroes/UBAL.gif' alt='Smiley face' height='42' width='42>";
			echo "<td>";

		//echo '<img src="images/heroes/E01A.gif" alt="Smiley face" height="42" width="42">';

		//echo "<img src='images/heroes/".$upperNameHeroes.".gif'>";
			echo '<div  style="overflow:hidden;width:100%">
			<div id="inner" style="overflow:hidden;width: 100%;height:35px">

				<div style="float:left;width:20%; padding:2px 0;">

					<img src=images/heroes/'.$upperNameHeroes.'.gif "title='.$_heroName.' alt='.$_heroName.' width="30" height="30" >
				</div>


				<div style="float:left;width:80%;" name="game_id"> <b>'.$_heroName.'</b><br><a href="gamematch.php?id='.$row['gameid'].'"><div class="onlinkcolor3"><i>เกม ID:#'.$row['gameid'].'</i></div></a></div>

			</div>  

		</div>';
		echo "</td>";	
		$winner;
		if($row['winner'] == 1)
		{
   						//<img src='images/winner5.png' alt='winner' height='42' width='42'>
			$winner = "<font style='color:#009900'><b>ชนะ</b></font><br>";
		} 
		else if($row['winner'] == 2)
		{
   					 	//<img src='images/lose.png' alt='winner' height='35' width='35'><br>
			$winner = "<font style='color:red'><b>แพ้</b></font><br>";
		}else if($row['winner'] == 0)
		{
			$winner = "<div class='blink'><font style='color:#3366ff'><b>LEAVE !!!</b></font></div>";
		}


		echo "<td class='text-center'>".$winner." </div>";

   					//echo "<label id='time'> test </label>";
		echo '<div class="onlinkcolor2">';
		echo '<abbr title="'.$time.'" data-livestamp="'.$time.'"></abbr>';
		echo '</div>';

		echo "</td>";


		echo "<td class='text-center'>".$row['min']." นาที ".$row['sec']." วินาที</td>";


//	echo "<td>&nbsp&nbsp&nbspKills: ".$row['kills']." Deaths:".$row['deaths']." Assists: ".$row['assists']."</td>";


		/// Stats Hero
		echo "<td class='topcenter'>";
		echo "<font style='color:#99cc00'>";
		echo $row['kills']."</font> / ";
		echo "<font style='color:#ff6666'>";
		echo $row['deaths']."</font> / ";
		echo "<font style='color:#6699ff'>";
		echo $row['assists']."</font>";
		echo "</td>";

		/// Stats creep
		echo "<td class='topcenter'>";
		echo "<font style='color:#99cc00'>";
		echo $row['creepkills']."</font> / ";
		echo "<font style='color:#ff6666'>";
		echo $row['creepdenies']."</font> / ";
		echo "";

		/// Stats Neutralkill
		
		echo "<font style='color:#cc66ff'>";
		echo $row['neutralkills']."</font>";
		echo "</td>";


//	echo "<td>&nbsp&nbsp&nbspKills: ".$row['creepkills']." Denies: ".$row['creepdenies']." 
//	Neutral: ".$row['neutralkills']."</td>";


		echo "</tr>";

	}
}

echo "</table>"
?>
</div> <!-- end tab 2 -->

<div id="tab_3" class="tab">
	<!--  Top  heroes ever play  -->

	<?php
	echo "<div class='topleft'><font style='color: white' size='5' face='Itim'>ฮีโร่ (Heroes) ที่เคยเล่น</font></div>";
	echo "<table style=width:100%>";
	echo "<tr><th class='text-center'> ฮีโร่</th><th class='text-center'>Win Rate</th><th class='text-center'>จำนวนเกมที่เล่น</th><th class='text-center'>K/D/A ฮีโร่</th><th class='text-center'>K/D/N ครีพ</th></tr>";
	echo "<col width='23%'/>";
	echo "<col width='12%'/>";
	echo "<col width='15%'/>";
	echo "<col width='25%'/>";
	echo "<col width='25%'/>";
	$count = 0;
	while ($row = $result7->fetch_array(MYSQL_BOTH)) 
	{
		$count++;
		$countWinAll = 0;
		$countLoseAll = 0;
		$topHeroesPlay = $row['hero'];
		$upperNameHeroes = strtoupper($topHeroesPlay);

		$sqlHeroAll = "SELECT games.id,hero,winner FROM gameplayers LEFT JOIN games ON games.id=gameplayers.gameid LEFT JOIN dotaplayers ON dotaplayers.gameid=games.id AND dotaplayers.colour=gameplayers.colour LEFT JOIN dotagames ON games.id=dotagames.gameid WHERE name= '".$name."' AND hero= '".$topHeroesPlay."' group by games.id ";
		$resultCountHeroAll = mysqli_query($con,$sqlHeroAll);

		while ($row2 = $resultCountHeroAll->fetch_array(MYSQL_BOTH)) 

		{
			if($row2['winner'] == 1){
				$countWinAll++;
			}else if($row2['winner'] == 2){
				$countLoseAll++;
			}
		}
//////////////////////Find name of heroo ////////////////////////////////////////////

		$sqlHeroName = "SELECT description from heroes where heroid = '".$topHeroesPlay."'";
		$resHeroName = mysqli_query($con,$sqlHeroName);

		while ($heroName = $resHeroName->fetch_array(MYSQL_BOTH)) 

		{
			$_heroName = $heroName['description'];
		}

//////////////////////////////////////////////////////////////////////////////////////

		echo "<tr>";

		if($row['count(hero)'] >=1 ){

			echo "<td>";

			echo '<div  style="overflow:hidden;width:100%">
			<div id="inner" style="overflow:hidden;width:100%;height:35px" >

				<div style="float:left;width:20%; padding:2px 0;">
					<img src="images/heroes/'.$upperNameHeroes.'.gif "title='.$_heroName.' alt='.$_heroName.' width="30" height="30" >
				</div>


				<div style="float:left;width:80%; padding:8px 0"> <b>'.$_heroName.'</b></div>
			</div>  

		</div>';


		echo "</td>";

		$percentRateWinAll = ($countWinAll/($countWinAll+$countLoseAll))*100;
		echo "<td class='text-center'>";

		echo number_format((float)$percentRateWinAll, 2, '.', '') ."%";
		echo "
		<div class='meter'>
			<span style='width: ".$percentRateWinAll."%'></span>
		</div>
		<!--
		<div id='myProgress'>
			<div id='myBar' style='width:".$percentRateWinAll."%'></div>
		</div>  -->
	</td>";

	echo "<td class='text-center'>".$row['count(hero)']."</td>";


//echo "<td>&nbsp&nbsp&nbspKills: ".$row['SUM(kills)']." Deaths:".$row['SUM(deaths)']." Assists: ".$row['SUM(assists)']."</td>";

//echo "<td>&nbsp&nbsp&nbspKills: ".$row['SUM(creepkills)']." Denies: ".$row['SUM(creepdenies)']." Neutral: ".$row['SUM(neutralkills)']."</td>";

	/// Stats Hero
	echo "<td class='topcenter'>";
	echo "<font style='color:#99cc00'>";
	echo $row['SUM(kills)']."</font> / ";
	echo "<font style='color:#ff6666'>";
	echo $row['SUM(deaths)']."</font> / ";
	echo "<font style='color:#6699ff'>";
	echo $row['SUM(assists)']."</font>";
	echo "</td>";

		/// Stats creep
	echo "<td class='topcenter'>";
	echo "<font style='color:#99cc00'>";
	echo $row['SUM(creepkills)']."</font> / ";
	echo "<font style='color:#ff6666'>";
	echo $row['SUM(creepdenies)']."</font> / ";

		/// Stats Neutralkill

	echo "<font style='color:#cc66ff'>";
	echo $row['SUM(neutralkills)']."</font>";
	echo "</td>";
   					//$heroTop_Array[$count] = "Kills:".$row['SUM(kills)']." Deaths:".$row['SUM(deaths)']."";

   					 //echo $heroTop_Array[$count];

}else
echo "</tr> ";

}
echo "</table>"

?>
</div> <!-- end tab 3 -->

<div id="tab_4" class="tab">
	<!--  All ever Heroes play  -->

	<?php

	echo "<div class='topleft'><font style='color: white' size='5' face='Itim'>เกม (Matches) ที่เคยเล่นทั้งหมด</font></div>";
	echo "<table style=width:100% >";
	echo "<tr><th class='text-center'>ฮีโร่</th><th class='text-center'>ผล</th><th class='text-center'>เวลาการเล่น</th><th class='text-center'>K/D/A ฮีโร่</th><th class='text-center'>K/D/N ครีพ</th></tr>";

	echo "<col width='23%'/>";
	echo "<col width='12%'/>";
	echo "<col width='15%'/>";
	echo "<col width='25%'/>";
	echo "<col width='25%'/>";


	while ($row = $resAllHeroesPlay->fetch_array(MYSQL_BOTH)) 
	{


		$lastHeroesPlay = $row['hero'];
		$time = $row['datetime'];

//////////////////////Find name of hero ////////////////////////////////////////////

		$sqlHeroName = "SELECT description from heroes where heroid = '".$lastHeroesPlay."'";
		$resHeroName = mysqli_query($con,$sqlHeroName);


		while ($heroName = $resHeroName->fetch_array(MYSQL_BOTH)) 

		{
			$_heroName = $heroName['description'];
		}

//////////////////////////////////////////////////////////////////////////////////////


		$upperNameHeroes = strtoupper($lastHeroesPlay);
		if($_heroName != NULL){
		//echo "<img src='images/heroes/UBAL.gif' alt='Smiley face' height='42' width='42>";
			echo "<td>";

		//echo '<img src="images/heroes/E01A.gif" alt="Smiley face" height="42" width="42">';

		//echo "<img src='images/heroes/".$upperNameHeroes.".gif'>";
			echo '<div  style="overflow:hidden;width:100%">
			<div id="inner" style="overflow:hidden;width: 100%;height:35px">

				<div style="float:left;width:20%; padding:2px 0;">

					<img src=images/heroes/'.$upperNameHeroes.'.gif "title='.$_heroName.' alt='.$_heroName.' width="30" height="30" >
				</div>


				<div style="float:left;width:80%;" name="game_id"> <b>'.$_heroName.'</b><br><a href="gamematch.php?id='.$row['gameid'].'"><div class="onlinkcolor3"><i>เกม ID:#'.$row['gameid'].'</i></div></a></div>

			</div>  

		</div>';
		echo "</td>";	
		$winner;
		if($row['winner'] == 1)
		{
   						//<img src='images/winner5.png' alt='winner' height='42' width='42'>
			$winner = "<font style='color:#009900'><b>ชนะ</b></font><br>";
		} 
		else if($row['winner'] == 2)
		{
   					 	//<img src='images/lose.png' alt='winner' height='35' width='35'><br>
			$winner = "<font style='color:red'><b>แพ้</b></font><br>";
		}else if($row['winner'] == 0)
		{
			$winner = "<div class='blink'><font style='color:#3366ff'><b>LEAVE !!!</b></font></div>";
		}


		echo "<td class='text-center'>".$winner." </div>";

   					//echo "<label id='time'> test </label>";

		echo '<div class="onlinkcolor2">';
		echo '<abbr title="'.$time.'" data-livestamp="'.$time.'"></abbr>';
		echo '</div>';




		echo "</td>";
		echo "<td class='text-center'>".$row['min']." นาที ".$row['sec']." วินาที</td>";
//	echo "<td>&nbsp&nbsp&nbspKills: ".$row['kills']." Deaths:".$row['deaths']." Assists: ".$row['assists']."</td>";

//	echo "<td>&nbsp&nbsp&nbspKills: ".$row['creepkills']." Denies: ".$row['creepdenies']." Neutral: ".$row['neutralkills']."</td>";

			/// Stats Hero
		echo "<td class='topcenter'>";
		echo "<font style='color:#99cc00'>";
		echo $row['kills']."</font> / ";
		echo "<font style='color:#ff6666'>";
		echo $row['deaths']."</font> / ";
		echo "<font style='color:#6699ff'>";
		echo $row['assists']."</font>";
		echo "</td>";

		/// Stats creep
		echo "<td class='topcenter'>";
		echo "<font style='color:#99cc00'>";
		echo $row['creepkills']."</font> / ";
		echo "<font style='color:#ff6666'>";
		echo $row['creepdenies']."</font> / ";
		echo "";

		/// Stats Neutralkill
		
		echo "<font style='color:#cc66ff'>";
		echo $row['neutralkills']."</font>";
		echo "</td>";


		echo "</tr>";

	}
}

echo "</table>"
?>
</div> <!-- end tab 4-->

<div id="tab_5" class="tab"></div>


</div>


</div><!-- End Tab -->

</div><!-- end tbDiv -->



</div><!-- end Main Content -->
</div><!--  end main div -->
<div class="box sidebar"><!--Right-sidebar --></div> <!-- end right sidebar -->
</div>
<div class="maindiv">
<div class="footer"><img src="images/bg03_2.png" alt="Smiley face" align="middle" width="100%" height="100%"></div>
</div>
</div>
<?php include 'footer.php'; ?>


<!-- content  -->

<!-- side bar -->

<!--end side bar -->

<!--footer -->

<!--end footer -->

</body>



</html>