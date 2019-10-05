<?php
include ("dbconnect.php");
$sql="SELECT * FROM cashier";

$record=$conn->query($sql);

?>

<body>
    
    <link rel="stylesheet" type="text/css" href="shopa.css">
    <style>
    body{
        background-color:#A19595;
    }
    table{
        border: 1px solid black;
        width: 100%;
        padding: 0;
        height: 10%;
        


    }
    th{
        border: 1px solid black; 
          height: 100%;
          text-align: center;
         padding: 15px;
        
        

    }
    tr{
        border: 1px solid black;
        padding: 15px;
        border-bottom: 1px solid #ddd;
    }
    td{
        height: 50px;
        vertical-align: bottom;
        border: 1px solid black;


    }
</style>


<table>
    <caption style="font-size: 40px;">Cashiers</caption>
    

    <thead>

        <tr> 
             
            <th style="font-size: 15px;">Cashier ID</th>   
            <th style="font-size: 15px;">Cashier Name</th>    
            <th style="font-size: 15px;">Cashier Email </th>       
            <th style="font-size: 15px;">Cashier Phone </th> 
            <th style="font-size: 15px">Delete</th>
            <th style="font-size: 15px">Update</th>
            
        </tr>
    </thead>

    <?php
    if($record ->num_rows >0){
    while($row=$record->fetch_assoc()){
        
        $ID =  $row['cashierID'];
        $name=$row['cashierName'];
        $email=$row['cashierEmail'];
        $phone=$row['cashierPhone'];
       
        ?>

        <tbody  style="background-color:#A19595;">
            <tr>
                
                <td><?php echo $ID ?></td>
                <td><?php echo $name ?></td>
                <td><?php echo $email ?></td>
                <td><?php echo $phone ?></td>

                 <td><a href="deletecashier.php?del=<?php echo $ID ?>"><button style="background-color: #A19595;" class="btn btn-danger">Delete</button></a></td>
                 <td><a href="updatecashiers.php?del=<?php echo $ID ?>"><button style="background-color: #A19595;" class="btn btn-danger">Update</button></a></td>
                 <td><a href="cashiersignup.php">Add</a></td>
                
            </tr>
        </tbody>
        <?php
    }
    }else{
        echo "0 records";
}
?>
</table>   
   </body>
   </html>