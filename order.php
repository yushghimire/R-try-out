<?php
session_start();
?>
<html>
<head>
	<title>Add Item</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Latest compiled and minified CSS -->
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/order_style.css" rel="stylesheet">

</head>

<body>
	<?php
	include ('navbar.html');
	include ('connect.php');
	$listId=  @$_GET['listId']; 
	if($listId==1){
		$startId=1;
	}
	else if($listId==2){
		$startId=41;
	}
	else if($listId==3){
		$startId=81;
	}
	else if($listId==4){
		$startId=121;
	}
	else if($listId==5){
		$startId=141;
	}



	echo' <div class= "container">
		<form action="order.php?listId='.$listId.'" method="POST">';

			?>

			<div class="row">
				<div class = "col-md-8">
					<div class="form-group">
						<label for="itemListMultipleSelect">
							<?php $sql2 = "SELECT * FROM vendor where itemCategory='$listId'";
							$result2=$conn->query($sql2);
							while($row = $result2->fetch_assoc()){
								$nameOfVendor=$row["vendorName"];
								$emailOfVendor=$row["vendorEmail"];
								echo 'Items available at '.$nameOfVendor.'<br>';
							}
							
							?>
						</label>
						<select multiple class="form-control" name= "orderItem" id="itemListMultipleSelect" size="15" >
							<?php 
							

							$sql = "SELECT * FROM itemlist where itemId>='$startId' LIMIT 40"; /* Query to select item from table itemLisst*/
							$result=$conn->query($sql);
							if ($result->num_rows > 0) {
								while($row = $result->fetch_assoc()) {
									
									echo '<option>'.$row["itemName"].'</option>';
								}
							}
							?><!--end of php-->
						</select>
					</div><!--end of form group-->
				</div><!--end of col-md-7-->

				<div class="col-md-4">
					<h4>Product Low in Stock</h4>
					<div class="lowInStock">
						
						<!--php code for retrieving data, to show in product below certain point-->
						<?php
						
						
						
						$sql1 = "SELECT * FROM itemList where quantity>0 and itemId BETWEEN '$startId' and '$startId'+40";
						/* Query to select item from table itemLisst*/
						$result1=$conn->query($sql1);
						echo '<div data-spy="scroll" class="list-group">';
						if ($result1->num_rows > 0) {
                     // output data of each row
							while($row = $result1->fetch_assoc()) {
								$itemNumber = $row["quantity"];
								if ($itemNumber < 100){
									echo '
									<a class="list-group-item list-group-item-action list-group-item-danger justify-content-between">'
										.$row["itemName"].'
										<span class="badge badge-default badge-pill">'.$row["quantity"].'</span>
									</a>';

								}
							} 
						}
						


						echo '</div>';

						?> <!--end of php-->
					</div><!--end of low in stock-->
				</div><!--end of col-md-3-->

			</div><!--end of row-->
			<div class="col-md-7">
				<div class="form-group">
					<label for="itemListQuantity">Quantity</label>
					<input type="text" class="form-control" name="orderQuantity" id="itemListQuantity">

				</div><!--end of form-group-->
			</div><!--end of col-md-12-->

			<div class="row">
				<div class="col-md-2"></div>
				<div class="col-md-10">
					<button type="submit" name="orderSubmit" class="btn btn-primary">Order via Email</button>
				</div>
			</div><!--end of row-->
		</form> <!--end of form-->

		<?php 
		$orderQuantityMail=@$_POST["orderQuantity"];

		if(isset($_POST['orderSubmit'])){
			 if (!empty($orderQuantityMail)){

      if($orderQuantityMail<0){
       echo '<script>alert("Error");</script> ';
     }
                //validating if the posted amount is empty or not
     else{
			$msg = 'HELLO '.$nameOfVendor.
			'Order details: 
			Item Name= '.$_POST["orderItem"].' 
			Quantity='.$_POST["orderQuantity"].'
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
	}
	else{
		echo '<script>alert("Empty Field"); </script>';
	}
}
		?>
	</div><!--end of container-->


	<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</body>

</html>
