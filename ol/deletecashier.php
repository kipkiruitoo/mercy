<?php  
 
include("dbconnect.php"); 
$delete_id=$_GET['del'];  
$delete_query="delete  from cashier WHERE cashierID='$delete_id'";//delete query  
$run=mysqli_query($conn,$delete_query);  
if($run)  
{  
header('location:viewcashiers.php');
}  
  
?>  