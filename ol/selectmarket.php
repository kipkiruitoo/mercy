<?php 
include('dbconnect.php');

$sql = 'Select * from supermarket';

if (mysqli_query($conn, $sql)) {#


$result = mysqli_query($conn, $sql);

	
	 
}else{

	echo 'There was a problem' . mysqli_error($conn);
}

 ?>


 <!DOCTYPE html>
 <html>
 <head>
 	<title>Select Supermarket</title>
 	<h1> Please select your supermarket of choice</h1>
 	<style>
 body {
  background-color: lightblue;
}

h1 {
  color: black;
  text-align: left;
}

p {
  font-family: verdana;
  font-size: 20px;
}
</style>
 </head>

 <body>

 	<form method="post" action="./selectproducts.php">
 		<select name="super">
 			<?php while($row = mysqli_fetch_array($result)) {?>
 			<option value="<?php echo $row['supermarketID'] ?>"><?php echo $row['name'] ?></option>
 			<?php }?>
 		</select>

 		<button type="submit">Submit</button>
 	</form>
 
 </body>
 </html>