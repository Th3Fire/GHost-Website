<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="css/layout.css">
	<link rel="stylesheet" href="css/mycss/mystyle.css">
	<link rel="stylesheet" href="css/header/menu.css">
	<link rel="stylesheet" href="css/Mytable.css">
	<link rel="stylesheet" href="css/mycss/mystyle2.css">
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
 {}else
{
	$name = "Not found player name";

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
			<div class="box sidebar">Left-sidebar</div>

			<div class="box"><!-- Main Content -->

				<div class="myDiv">   	
					<div class="topleft">
					<?php 
					
					
					
						echo 
							'<section style="margin: 10px;">
							<fieldset style="min-height:100px;">
								<legend> <font face="Candal" size="4"><b>'.$name.'</b></font> </legend>';
							
								?>
<label> <br/>

<?php 

	echo "<img class='frame4' src='imgProfile/".$pathImg."'". " alt='NAKA' width='100' height='100'> ";
	?> </label>
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
	echo '<abbr title="'.$lastTimePlay.'" ></abbr>';
	echo '<div class="onlinkcolor">เล่นล่าสุด <span data-livestamp="'.$lastTimePlay.'"></span></b></div>';
	
	?></label>
</fieldset>

</section>
</div>
</div>
<!--
<table style=width:100% border="0" class="topcenter">
<tr><th width='50%' class="topcenter" colspan="2"><div class="topright">Profile <?php echo $_SESSION['UserID']; ?></div></th><th width='50%' class="topcenter"></th></tr>

<td class="topright" width="50%">
	<div class="topright">
    
    
   	</div>
</td>


</table>
-->

<br>

<div class="tbDiv">


	<br>

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

	$checkCount = 0;
	$_countAll = 0;
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
		$winner;
		if($row['winner'] == 1)
		{
			$winner = "<font style='color:#009900'>ชนะ</font>";
		} 
		else if($row['winner'] == 2)
		{
			$winner = "<font style='color:red'>แพ้</font>";
		}else if($row['winner'] == 0)
		{
			$winner = "---";
		}

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
		echo "</td>";
		echo "<td>&nbsp&nbsp&nbspKills: ".$row['SUM(kills)']." Deaths:".$row['SUM(deaths)']." Assists: ".$row['SUM(assists)']."</td>";

		echo "<td>&nbsp&nbsp&nbspKills: ".$row['SUM(creepkills)']." Denies: ".$row['SUM(creepdenies)']." 
		Neutral: ".$row['SUM(neutralkills)']."</td>";
		$checkCount++;
		$_count -= 20;

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
	$winner;
	if($row['winner'] == 1)
	{
		$winner = "<font style='color:#009900'>ชนะ</font>";
	} 
	else if($row['winner'] == 2)
	{
		$winner = "<font style='color:red'>แพ้</font>";
	}else if($row['winner'] == 0)
	{
		$winner = "---";
	}

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
	echo "</td>";
	echo "<td>&nbsp&nbsp&nbspKills: ".$row['SUM(kills)']." Deaths:".$row['SUM(deaths)']." Assists: ".$row['SUM(assists)']."</td>";

	echo "<td>&nbsp&nbsp&nbspKills: ".$row['SUM(creepkills)']." Denies: ".$row['SUM(creepdenies)']." 
	Neutral: ".$row['SUM(neutralkills)']."</td>";
	$checkCount++;
	$_count -= 20;
}


echo "</tr> ";

}
echo "</table>"

?>

<br>
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

			
			<div style="float:left;width:80%;" name="game_id"> <b>'.$_heroName.'</b><br><a href="gamematch.php?id='.$row['gameid'].'"><i>เกม ID:'.$row['gameid'].'</i></a></div>
			
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

	echo '<abbr title="'.$time.'" ></abbr>';
	echo '<span data-livestamp="'.$time.'"></span><br>';




	echo "</td>";
	echo "<td class='text-center'>".$row['min']." นาที ".$row['sec']." วินาที</td>";
	echo "<td>&nbsp&nbsp&nbspKills: ".$row['kills']." Deaths:".$row['deaths']." Assists: ".$row['assists']."</td>";

	echo "<td>&nbsp&nbsp&nbspKills: ".$row['creepkills']." Denies: ".$row['creepdenies']." 
	Neutral: ".$row['neutralkills']."</td>";
	echo "</tr>";

}
}

echo "</table>"
?>

<br>



<!--  All heroes ever play  -->

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
echo "<td>&nbsp&nbsp&nbspKills: ".$row['SUM(kills)']." Deaths:".$row['SUM(deaths)']." Assists: ".$row['SUM(assists)']."</td>";

echo "<td>&nbsp&nbsp&nbspKills: ".$row['SUM(creepkills)']." Denies: ".$row['SUM(creepdenies)']." 
Neutral: ".$row['SUM(neutralkills)']."</td>";

   					//$heroTop_Array[$count] = "Kills:".$row['SUM(kills)']." Deaths:".$row['SUM(deaths)']."";

   					 //echo $heroTop_Array[$count];

}else
echo "</tr> ";

}
echo "</table>"

?>
<br>

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

			
			<div style="float:left;width:80%;" name="game_id"> <b>'.$_heroName.'</b><br><a href="gamematch.php?id='.$row['gameid'].'"><i>เกม ID:'.$row['gameid'].'</i></a></div>
			
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

	echo '<abbr title="'.$time.'" ></abbr>';
	echo '<span data-livestamp="'.$time.'"></span><br>';




	echo "</td>";
	echo "<td class='text-center'>".$row['min']." นาที ".$row['sec']." วินาที</td>";
	echo "<td>&nbsp&nbsp&nbspKills: ".$row['kills']." Deaths:".$row['deaths']." Assists: ".$row['assists']."</td>";

	echo "<td>&nbsp&nbsp&nbspKills: ".$row['creepkills']." Denies: ".$row['creepdenies']." 
	Neutral: ".$row['neutralkills']."</td>";
	echo "</tr>";

}
}

echo "</table>"
?>


</div>


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