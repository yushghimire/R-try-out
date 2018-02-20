<?php
session_start();
?>
<html>
<head>
  <title>Book Item</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="css/style.css" rel="stylesheet">
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body>
  <?php
  include 'navbarCustomer.html';
  include 'connect.php';

  $id = @$_GET['id'];   
  
?>
  <div class="container">
   <?php
   $sql2 = "SELECT * FROM itemlist where itemId='$id'";
   $result2=$conn->query($sql2);
   while($row = $result2->fetch_assoc()){
    $name = $row["itemName"];
    echo '
    <div class="row">
     <div class="col-md-8"> 
      <h2 style="color:#598de0" > Item Name: </h2> <h3 style="color:#2454a0">'.$name.'
    </h3><h3>Quantity Remaining: ['.$row["quantity"].']</h3>
    ';
  }
  ?>

  <form method="POST" action="#">
    <input type="number" name="amount">
    <?php 
    $amount= @$_POST['amount']; ?>
    <input type="submit" class="btn btn-info" name="cartSubmit" value="Add To Cart">
  </form>  

  <?php

  if (isset($_POST['cartSubmit'])) {
    if (!empty($_POST['amount'])){
      if($amount<0){
       echo '<script>alert("Error");</script> ';
     }
                //validating if the posted amount is empty or not
     else{
       $orderAmount=$_POST['amount'];
       /*selecting clicked item from itemList Table*/
       $sql2 = "SELECT * FROM itemlist where itemId='$id'";
       $result2=$conn->query($sql2);
       while($row = $result2->fetch_assoc()){

          $itemName = $row["itemName"];
          $itemCost=$row["costPrice"];
          $itemQuantity = $row['quantity'];
        } 

      if ($itemQuantity > $orderAmount){

        $tableName=$_SESSION['username'];
        $totalCost=$itemCost*$orderAmount;

        $sql5="SELECT * FROM $tableName WHERE itemName='$itemName' ";
        $result5=$conn->query($sql5);

        if ($result5->num_rows >0) {           

         $sql6="UPDATE $tableName SET quantity=quantity+$orderAmount,total=total+$totalCost WHERE itemName='$itemName'";
         $conn->query($sql6);
         echo 'Items added to cart';
       }

       else{
         $sql4="INSERT into $tableName (itemName,quantity,percost,total) VALUES ('$itemName','$orderAmount','$itemCost','$totalCost')";
         $conn->query($sql4);
         echo '<script>alert("Items added to cart");</script> ';
       }

     }
   
   else{
    echo '<script>alert("We dont have that much!!!");</script> ';
  }
}
}


else {
  echo '<script>alert("Empty Field");</script> ';
}
}

echo' <div class="viewCartButton">
<a href="viewCart.php"> <button class="btn btn-default"> View Cart</button></a>

</div>';

echo ' 
</div>
<div class="col-md-4"> 
  ';
//Frequently Bought Items
  $sqlSelectedItem = "SELECT * FROM itemlist where itemId='$id'";
  $resultSelectedItem=$conn->query($sqlSelectedItem);
  while($row = $resultSelectedItem->fetch_assoc()){
    $name = $row["itemName"];
    echo '<h2> Frequently bought items with <i style="color: red;">'.$name.' </i></h2>';

        //$sqlCompareItem="SELECT * FROM (SELECT * from for_related where  ant1='$name') for_related INNER JOIN itemlist ON for_related.cons = itemlist.itemName " ;
    $sqlCompareItem = "SELECT * FROM (SELECT * from for_related where  ant1='$name') for_related INNER JOIN itemlist ON for_related.cons = itemlist.itemName ORDER BY lift DESC LIMIT 7";

    $resultCompareItem=$conn->query($sqlCompareItem);

    if ($resultCompareItem->num_rows > 0) {

      while($row = $resultCompareItem->fetch_assoc()){

        $cons=$row["cons"];

        echo '
        <a  class="list-group-item list-group-item-action justify-content-between" href="itemBookCustomer.php?id='.$row["itemId"]. '">'.$cons.'

        </a>';
      }

    }


  }
  ?>


</div><!--end of container-->

</body>
</html>
<!--data dictionary
$bookItem: variable for item to be booked
$orderAmount: amount of item to be ordered
$sql1:
$sql2:select from itemList
$sql3:selecting related items
$sql4: sql query for inserting in cart
-->

