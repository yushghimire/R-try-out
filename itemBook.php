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
    include 'navbar.html';
    include 'connect.php';

    $id = @$_GET['id'];   
    if($id>=1 && $id <=40){
        $listId=1;
      }
      else if ($id>=41 && $id <=80){
        $listId=2;
      }
      else if ($id>=81 && $id <=120){
        $listId=3;
      }
      else if ($id>=121 && $id <=160){
        $listId=4;
      }
      else if ($id>=161 && $id <=200){
        $listId=5;
      }
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
            <h2 style="color:#598de0" > Item Name: </h2> <h3 style="color:#2454a0">'.$name. '<a href="editItem.php?id='.$id.'"> <button type="submit" class="btn btn-default">Edit this item</button></a>
             <button type="submit" class="btn btn-default" data-toggle="modal" data-target="#myModal">Order</button>
            </h3> <h3>Quantity Remaining: ['.$row["quantity"].']</h3>
            ';
        }
        ?>
        <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><?php echo $id.'. ' .$name.' [List='.$listId.']'; ?></h4>
        </div>
        <div class="modal-body">
            <p>Quantity: </p>
          <input type="number" class="form-control" name="quantityModal" />
        </div>
        <div class="modal-footer">
        <?php 
        $sqlEmail="SELECT * from vendor where itemCategory='$listId'";
      $resultEmail=$conn->query($sqlEmail);
       while($row = $resultEmail->fetch_assoc()){
        $nameOfVendor=$row["vendorName"];
        $emailOfVendor=$row["vendorEmail"];
        echo '<center>Confirm email to '.$emailOfVendor.'. Owned by '. $nameOfVendor.'</center>';
       }
        ?>
      <form action="#" method="post">
        <button type="submit" name="orderSubmit" class="btn btn-primary">Order via Email</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
</form>
      <?php
      
      
      if(isset($_POST['orderSubmit'])){
            $msg = 'HELLO '.$nameOfVendor.
            'Order details: 
            Item Name= '.$name.' 
            Quantity='.$_POST["quantityModal"].'
            Please contact us ASAP.
            Thank You. 
            Show Shopper.
            showshopper@gmail.com';

// send email using PHP's built in 
// command, mail()
            mail($emailOfVendor, 
                'Order from Show Shopper', $msg);


            echo '<script>alert("Email Sent Succesfully to '.$emailOfVendor.'"); </script>';
        }
      ?>
      
    </div>
  </div>
        

        <?php
        if (isset($_POST['cartSubmit'])) {
            if (!empty($_POST['amount'])){
                //validating if the posted amount is empty or not

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
                   echo 'Items added to cart';
               }

           }
           else{
            echo 'We dont have that much !!! ';
        }
    }
    else {
        echo 'Empty Field !!!!';
    }
}



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
                <a  class="list-group-item list-group-item-action justify-content-between" href="itemBook.php?id='.$row["itemId"]. '">'.$cons.'

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

