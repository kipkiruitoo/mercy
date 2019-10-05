<?php
	session_start();
	
	if (!isset($_SESSION['LoggedInUser'])) {
		header("location: home1.php");
	}
?>
<!DOCTYPE html>

<html>
	<head>
		<title>SUPA SHOPA</title>
		<link rel="stylesheet" type="text/css" href="shopa.css">
		<style>

			h1,h2,h3, h4{
				color: black;
			}

			body {
				font-family: "sans-serif", arial;
				text-decoration: color: black;
				background-color: gray;
			}
			#contact {
	   			background-color: #A19595;
	   		}
	   		a {
				color: #FFFFFF;
			}

			
		</style>
	</head>
	<body alink="blue">
		<div id="links">
		  	<div class="link" id="current-page"><a href="home1.php">HOME</a></div> 
	    	<div class="link"><a href="aboutUs.php">ABOUT US</a></div>
			<div class="link"><a href="contactUs.php" >CONTACT US</a></div>
<div>
			<div class="link"><a href="commuterlogout.php"> LOG OUT</a></div>

    	</div>
    	<div id="contact">
			<h1>SUPA SHOPA</h1>
			<h2> Shopping made easy</h2>	
			 <p> Relax!! And let Supa shopa shop for you</p>			     
			</body>
		</div>	
	
</html>	