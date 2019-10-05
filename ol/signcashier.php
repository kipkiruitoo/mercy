<?php

		if (isset($_POST['submit'])){
	   include('dbconnect.php');
  
    $num= $_POST["id"];
	$name= $_POST["cashier"];
	$phone=$_POST['number'];
	$ema= $_POST["address"];
	$pass=$_POST['password'];
	

	$sql= "INSERT INTO cashier(cashierID, cashierName, cashierPhone, cashierEmail, password) VALUES('$num' , '$name', '$phone','$ema', '$pass')";

	if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
    header('location: viewcashiers.php');
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
}
	
?>