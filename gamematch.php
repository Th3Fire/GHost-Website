<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="css/layout.css">
	<link rel="stylesheet" href="css/mycss/mystyle.css">
	<link rel="stylesheet" href="css/header/menu.css">
	<link rel="stylesheet" href="css/Mytablegamematch.css">
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
	
	<title>GHost++ Welcome - Stats Player</title>
	<style>
		.topcenter {
			text-align: center;
			border-style: none;
			font-weight: bold;
		}

  .blink {
  animation-duration: 1000ms;
  animation-name: tgle;
  animation-iteration-count: infinite;
  padding: -10px 0;
}

@keyframes tgle {
  0% {
    opacity: 0;
  }

  49.99% {
    opacity: 0;
  }
  50% {
    opacity: 1;
  }

  99.99% {
    opacity: 1;
  }
  100% {
    opacity: 0;
  }
}

	</style>


</head>
<body>
	<?php

	session_start();
	require_once("connect.php");

	if(!isset($_SESSION['UserID']))
	{
		header ("Location: login.php");
		exit();
	}else if($_SESSION['UserID'] == ""){
		header ("Location: login.php");
		exit();
	}

	$name = $_SESSION['UserID'];
	

?>

<div class="wrapper">

	<!-- menu -->
	<?php include 'header.php'; ?>

	<!-- end menu -->
	<!-- end header -->
	<div class="mainCon">
		<div class="box sidebar">Left-sidebar</div>

		<div class="box"><!-- Main Content -->



<?php 

if($_GET["id"] != "" || $_GET["id"] != NULL){
$sql = "SELECT * \n"
    . "FROM gameplayers\n"
    . "LEFT JOIN games ON games.id = gameplayers.gameid\n"
    . "LEFT JOIN dotaplayers ON dotaplayers.gameid = games.id\n"
    . "AND dotaplayers.colour = gameplayers.colour\n"
    . "LEFT JOIN dotagames ON games.id = dotagames.gameid\n"
    . "WHERE games.id =".$_GET["id"]." AND NOT(hero <=> '') AND NOT(hero <=> NULL) order by dotaplayers.colour asc \n";

$res = mysqli_query($con,$sql);

	if ($res->num_rows > 0) {


	echo "<div class='topleft'><font style='color: white' size='5' face='Itim'>รายละเอียดเกม(Detail) Game ID: ".$_GET["id"]."<br><br></font></div>";
	echo "<table style=width:100% >";
	echo "
	<tr><th class='text-center'>ผู้เล่น<br>(Player)</th>
	<th class='text-center'>ฮีโร่<br>(Hero)</th>
	<th class='text-center'>KDAของฮีโร่<br>(Hero KDA)</th>
	<th class='text-center'>สถิติครีพ KD<br>(Creep Stats)</th>
	<th class='text-center'>ฆ่าครีพป่า<br>(Neutral Kills)</th>
	<th class='text-center'>จำนวนการตีป้อม<br>(Tower Destory)</th>
	<th class='text-center'>ออกเกมที่<br>(Left At)</th>
	<th class='text-center'>ผู้ชนะ<br>(Winner)</th></tr>";

	echo "<col width='11%'/>";
	echo "<col width='19%'/>";
	echo "<col width='12%'/>";
	echo "<col width='12%'/>";
	echo "<col width='12%'/>";
	echo "<col width='14%'/>";
	echo "<col width='12%'/>";
	echo "<col width='18%'/>";

while ($row = $res->fetch_array(MYSQL_BOTH)) 
		{
			/// Name Player
			echo "<td><b>";
			echo $row['name'];
			echo "</b></td>";

			/// Name Hero

	$sqlHeroName = "SELECT description from heroes where heroid = '".$row['hero']."'";
	$resHeroName = mysqli_query($con,$sqlHeroName);

	while ($heroName = $resHeroName->fetch_array(MYSQL_BOTH)) 

	{
		$_heroName = $heroName['description'];
	}

			
			$upperNameHeroes = strtoupper($row['hero']);
			echo "<td>";

		echo '<div  style="overflow:hidden;width:100%">
		<div id="inner" style="overflow:hidden;width: 100%;height:35px">

			<div style="float:left;width:20%; padding:2px 0;">

				<img src=images/heroes/'.$upperNameHeroes.'.gif "title='.$_heroName.' alt='.$_heroName.' width="30" height="30" >
			</div>

			<div style="float:left;width:80%;padding:9px 0;" ><b>&nbsp'.$_heroName.'</b></div>

		
			
		</div>  

	</div>';



			echo "</td>";

			/// Stats Hero
			echo "<center>";
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
			echo $row['creepdenies']."</font>";
			echo "</td>";

			/// Stats Neutralkill
			echo "<td class='topcenter'>";
			echo "<font style='color:#cc66ff'>";
			echo $row['neutralkills']."</font>";
			echo "</td>";

			/// Tower Destory
			echo "<td class='topcenter'>";
			echo "<font style='color:#ff9933'>";
			echo $row['towerkills']."</font>";
			echo "</td>";

			/// Left At
			echo "<td class='topcenter'>";
			echo $row['min']." นาที";
			echo "</td>";

			echo "<td class='topcenter'>";
			if($row['winner'] == 1){
				$winner = "<font style='color:#009900'><b>ชนะ</b></font><br>";
			}else if($row['winner'] == 2){
				$winner = "<font style='color:red'><b>แพ้</b></font><br>";
			}else{$winner = "<div class='blink'><font style='color:#3366ff'><b>LEAVE !!!</b></font></div>";}
			echo $winner;
			echo "</td>";

			echo "</center>";
			echo "</tr>";

		}



		echo "</table>";

	}else
		echo "Not Fount Game ID.Please try again !!!";
}else
	echo "Not Found Game ID Please enter Game ID";
?>




</div><!-- end Main Content -->

<div class="box sidebar">Right-sidebar</div>



</div>
<div class="footer"></div>

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


</html>
