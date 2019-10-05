<?php
?>
<!DOCTYPE html>
<html>
	<head>
		<title>SUPA SHOPA</title>
		<link rel="stylesheet" type="text/css" href="shopa.css">
	</head>
	<body>
			<form action="signadmin.php" method="post">
	  
	     		
		<div style="background-color:#A19595 ; color:white;padding:15px;">

			<fieldset>
				<label>Administrator ID </label><br>
				<input type="int" name="id" id="add" required autofocus><br><br>
				<label>Administrator Name </label><br>
				<input type="varchar" name="admin" id="Administrator Name" required autofocus><br><br>
				<label>Phone Number </label><br>
				<input type="int" name="num" id="phone" required autofocus><br><br>
				<label>Administrator Email Address </label><br>
				<input type="email" name="email" id="Administrator Address" required autofocus><br><br>
				<label>Password</label><br>
				<input type="password" name="password" id="Password" required autofocus><br><br>
				<label>Confirm Password</label><br>
				<input type="password" name="confirmpassword" id="Password" required autofocus><br><br>
				<input type="submit" name="submit" value="submit">
			</fieldset>
		</div>
		</form>

		
</html>