<?php  
 
include("dbconnect.php"); 
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
	if (isset($_GET['del'])){
			$delete_id=$_GET['del']; 

	$sql = "SELECT * FROM cashier WHERE cashierID= '$delete_id'";

	$cashier =  mysqli_query($conn,$sql); 

	$cashier1 = mysqli_fetch_assoc($cashier);
	}

	if (isset($_POST["id"])){

echo 'something posted';
$num= $_POST["id"];
	$name= $_POST["cashier"];
	$phone=$_POST['number'];
	$ema= $_POST["address"];
	// $pass=$_POST['password'];
$sql = "UPDATE cashier SET  
 cashierName = '$name',
  cashierPhone = '$phone',
   cashierEmail = '$ema'
   
WHERE cashierID = '$num'
    ";

    if ($conn->query($sql) === TRUE) {
    echo "Record Updated";
    header('location: viewcashiers.php');
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
	}

	
mysqli_close($conn);
?>

<!DOCTYPE html>

<html>
	<head>
		<title>SUPA SHOPA</title>
		<link rel="stylesheet" type="text/css" href="shopa.css">
	</head>
	<body>
			<form action="updatecashiers.php" method="post">
	  
	     		
		<div style="background-color:#A19595 ; color:white;padding:15px;">

			<fieldset>
				

				<input  value="<?php echo $cashier1['cashierID']  ?>" type="hidden" name="id" id="cash" required autofocus><br><br>
				<label>Cashier Name </label><br>
				<input type="varchar" name="cashier"  value="<?php echo $cashier1['cashierName']  ?>" id="Cashier Name" required autofocus><br><br>
				<label>Phone Number </label><br>
				<input type="int" value="<?php echo $cashier1['cashierPhone']  ?>" name="number" id="phone" required autofocus><br><br>
				<label>Cashier Email Address </label><br>
				<input type="email" value="<?php echo $cashier1['cashierEmail']  ?>" name="address" id="Cashier Address" required autofocus><br><br>
				
				
				<input type="submit" name="submit" value="submit">
			</fieldset>
		</div>
		</form>

		
</html>