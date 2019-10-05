<?php
?>
<!DOCTYPE html>

<html>
	<head>
		<title>AMEKEN TRANSPORT SYSTEM</title>
		<link rel="stylesheet" type="text/css" href="ameken.css">
	</head>
	<body>
				<div class="link""><a href="feedback.php">GIVE YOUR FEEDBACK</a></div>
				<div class="link" id="current-page"><a href="payform.php"> PAYMENT DETAILS</a></div>
			<form action="getpayform.php" method="get">
		
				<div style="background-color: #A19595 ; color:white;padding:15px;">

					<fieldset>
						<label>Mode Of Payment </label><br>
						<select name="mode" required >
   							 <option value="Mpesa">M-Pesa</option>
    						 <option value="Airtel Money">Airtel Money</option>
    					</select><br><br>

						<label>Code Received after Payment </label><br>
						<input type="varchar" name="code" id="code" required ><br><br>
						<label>BusID </label><br>
						<input type="int" name="bus" id="buss" required ><br><br>

						<label>Payer's Name</label><br>
						<input type="varchar" name="name" id="name" required ><br><br>
						
						
						<input type="submit" name="submit" value="SUBMIT" >

					</fieldset>
				</div>
			</form>
		</body>
</html>