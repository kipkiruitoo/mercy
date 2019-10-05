<?php
?>
<!DOCTYPE html>

<html>
	<head>
		<title>AMEKEN TRANSPORT SYSTEM</title>
		<link rel="stylesheet" type="text/css" href="ameken.css">
	</head>
	<body>
				<button> <div class="link""><a href="feedback.php">GIVE YOUR FEEDBACK</a></div></button>
				<button> <div class="link" id="current-page"><a href="payform.php"> PAYMENT DETAILS</a></div></button>
			<form action="getpayform.php" method="get">
		
				<div style="background-color: #A19595 ; color:white;padding:15px;">

					<fieldset>
						<label>Shopper ID </label><br>
						<input type="int" name="shop" id="code" required ><br><br>
						<label>Shopper First Name </label><br>
						<input type="varchar" name="shop" id="code" required ><br><br>
						<label>Shopper Last Name </label><br>
						<input type="varchar" name="shop" id="code" required ><br><br>
						<label>Shopper Phone Number </label><br>
						<input type="int" name="shop" id="code" required ><br><br>
						<label>Shopper Email </label><br>
						<input type="varchar" name="shop" id="code" required ><br><br>
						<label>Delivery Place </label><br>
						<input type="varchar" name="code" id="code" required ><br><br>
						<label>Delivery date </label><br>
						<input type="date" name="bus" id="buss" required ><br><br>

						<label>Time of Delivery </label><br>
						<select name="mode" required >
   							 <option value="nine">9:00 am</option>
    						 <option value="ten">10:00 am</option>
    						 <option value="eleven">11:00 am</option>
    						 <option value="twelve">12:00 noon</option>
    						 <option value="one">1:00 pm</option>
    						 <option value="two">2:00 pm</option>
    						 <option value="three">3:00 pm</option>
    						 <option value="four">4:00 pm</option>
    						 <option value="five">5:00 pm</option>
    						 <option value="six">6:00 pm</option>
    						 <option value="seven">7:00 pm</option>
    						 <option value="eight">8:00 pm</option>
    						 <option value="nine">9:00 pm</option>
    						 <option value="ten">10:00 pm</option>
    					</select><br><br>
						
						
						<input type="submit" name="submit" value="SUBMT" >

					</fieldset>
				</div>
			</form>
		</body>
</html>