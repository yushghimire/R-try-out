<!--employee side-->s
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
		<form method="post" action="#" enctype="multipart/form-data">
			<p> Enter Customer Name<input type="text" name="customerName"></p>
			<input type="submit" name="paymentMade" value="Payement Made">
			<input type="submit" name="cancelOrder" value="Cancel Order">
		</form>		 
		<?php
			include('connect.php');
			if(isset($_POST['cancelOrder'])){

				$customerName=$_POST['customerName'];
				$sql1="SELECT itemName FROM itemList";
				$result=$conn->query($sql1);

				$sql2="SELECT itemName,quantity FROM $customerName";
				$result2=$conn->query($sql2);



				while($row1=$result->fetch_assoc()){
					while($row2=$result2->fetch_assoc()){

						if($row1['itemName']=$row2['itemName']){
							$addedQuantity=$row2['quantity'];
							$itemName=$row2['itemName'];

							/*update itemList with cancelled Item*/
							$sql3="UPDATE itemList SET quantity=quantity+$addedQuantity where itemName='$itemName'";
							$conn->query($sql3);
						}
					}
				}
				$sql4="DROP TABLE $customerName";
				$conn->query($sql4);

			}
		?>
</body>
</html>


<!--data dictionary
sql1,result1,$row1- for selecting data from itemList
sql2,result2,$row2- for selecting data from selected customer table
$sql3- update itemList with cancelled Item*
$sql4-drop table after transaction

-->