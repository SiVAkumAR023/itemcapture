<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <link rel="stylesheet" href="retrieve.css">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Retrieved Data</title>
</head>
<body>

<?php

$ID = $_POST['ID'];

if(!empty($ID)){
     $host = "localhost";
     $dbusername = "root";
     $dbpassword = "";
     $dbname = "items";

     $conn = new mysqli($host, $dbusername, $dbpassword, $dbname);
     
     if(mysqli_connect_error()){
          die('Connect Error(' . mysqli_connect_errno() . ')' . mysqli_connect_error());
     }

     else{

          $sql = "SELECT * FROM itemsdetails WHERE ID = $ID";
          $result = $conn->query($sql);
          $row = $result -> fetch_array(MYSQLI_ASSOC);
          
          if(mysqli_num_rows($result)==0){
               printf("User doesn't exist!");
          }
          elseif (mysqli_num_rows($result)==1) {

               if(!$row){
                    printf("User no longer exists!");
               }

               else {
                    echo '<table class="data-table">';
                    echo '<tr>';
                    echo '<th><b>ITEM NAME<b></th>';
                    echo '<th><b>ITEM PRICE<b></th>';
                    echo '<th><b>ITEM QUANTITY<b></th>';
                    echo '</tr>';
                    
                    echo '<tr>';
                    echo '<td>' . $row["item_name"] . '</td>';
                    echo '<td>' . $row["item_price"] . '</td>';
                    echo '<td>' . $row["item_quantity"] . '</td>';
                    echo '</tr>';
                    echo '</table>';
                    
                    echo '<a href="index.html"><input type="button" value="Go Back"></a>';

                    
               }
          }
          mysqli_close($conn);
     }
}
else{
     echo "Enter the User ID!";
     die();
}

?>