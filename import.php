<?php

$item_name = $_POST['item_name'];
$item_price = $_POST['item_price'];
$item_quantity = $_POST['item_quantity'];

if( !empty($item_name) || !empty($item_price) || !empty($item_quantity)){
     $host = "localhost";
     $dbusername = "root";
     $dbpassword = "";
     $dbname = "items";

     $conn = new mysqli($host, $dbusername, $dbpassword, $dbname);
     
     if(mysqli_connect_error()){
          die('Connect Error(' . mysqli_connect_errno() . ')' . mysqli_connect_error());
     }
     else{
          $INSERT = "INSERT Into itemsdetails (item_name, item_price, item_quantity)values(?,?,?)";

          $stmt = $conn->prepare($INSERT);
          $stmt->bind_param("sss", $item_name, $item_price, $item_quantity);
          $stmt->execute();
          $lastid = $conn->insert_id;
          
          echo "You items added to cart <br/> Your user ID is: \n". $lastid ;
          echo '<br/><br/><br/><a href="index.html"><input type="button" value="Go Back"></a>';
               
          $stmt->close();
          $conn->close();
     }
}
else{
     echo "All fields are required!";
     die();
}
?>
