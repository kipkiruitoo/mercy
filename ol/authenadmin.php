<?php
    session_start();
    $dbconfig = mysqli_connect('localhost', 'root', '', 'shopa');
    
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $num = mysqli_real_escape_string($dbconfig, $_POST['customer']);
        $pass = mysqli_real_escape_string($dbconfig, $_POST['Password']);
        
        $sql_query = "SELECT adminName FROM admin WHERE adminEmail = '$num' and password = '$pass'";
        $result=mysqli_query($dbconfig, $sql_query);
        if ($result == false) {
            die (mysqli_error($dbconfig));
        }
        
        $count=mysqli_num_rows($result);
        if($count == 1){
            $_SESSION['admin'] = $pass;
            header('location: adminpage.php');
        } else {
          echo"Retry to log in";
        }
    }
?>