<?php

		if (isset($_POST['submit'])){
	   include('dbconnect.php');
  
    $number= $_POST["id"];
	$namee= $_POST["admin"];
	$phonee=$_POST['num'];
	$emal= $_POST["email"];
	$pas=$_POST['password'];
	

	$sql= "INSERT INTO admin(adminID, adminName, adminEmail, adminPhone, password) VALUES('$number' , '$namee', '$emal','$phonee', '$pas')";

	if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
}
	
?>