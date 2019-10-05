<?php


?>
<!DOCTYPE html>

<html>
	<head>
		<title>SUPA SHOPA</title>
		<link rel="stylesheet" type="text/css" href="shopa.css">
	</head>
	<body>
			<form action="signcashier.php" method="post">
	  
	     		
		<div style="background-color:#A19595 ; color:white;padding:15px;">

			<fieldset>
				<label>Cashier ID </label><br>
				<input type="int" name="id" id="cash" required autofocus><br><br>
				<label>Cashier Name </label><br>
				<input type="varchar" name="cashier" id="Cashier Name" required autofocus><br><br>
				<label>Phone Number </label><br>
				<input type="int" name="number" id="phone" required autofocus><br><br>
				<label>Cashier Email Address </label><br>
				<input type="email" name="address" id="Cashier Address" required autofocus><br><br>
				<label>Password</label><br>
				<input type="password" name="password" id="Password" required autofocus><br><br>
				<label>Confirm Password</label><br>
				<input type="password" name="confirmpassword" id="Password" required autofocus><br><br>
				<input type="submit" name="submit" value="submit">
			</fieldset>
		</div>
		</form>

		
</html>