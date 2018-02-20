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
	<link href="css/addItem_style.css" rel="stylesheet">

</head>

<body>
	<?php
	include ('navbar.html');
	include ('connect.php');
	?>

	<?php 

	$orderQuantity = @$_POST['orderQuantity'];
	$orderItem = @$_POST['orderItem'];
	if(isset($_POST['itemSubmit'])){
		$sql_postItem = "UPDATE itemlist SET quantity = quantity + '$orderQuantity' where itemName = '$orderItem'";
		$sql_postOrder = "INSERT into order_transaction(order_date, order_item,order_quantity) values (NOW(),'$orderItem','$orderQuantity') ";

	//entering data into the order_transaction for record keeping

		if ($conn->query($sql_postOrder) == TRUE) {
			
			echo '<script> alert("Item Quantity Added Succesfully"); </script> ';
			
		}	else {
			echo "Error: "  . "<br>" . $conn->error;
		}
		$result_Item= $conn->query($sql_postItem);	

	}

	?>
	<div class= "container">
		<form method="POST">
			<div class = "col-md-12">
				<div class="form-group">
					<label for="itemListMultipleSelect">Item List</label>
					
					<select multiple class="form-control" name= "orderItem" id="itemListMultipleSelect" size="15">

						<?php 

						$sql = "SELECT * FROM itemlist"; /* Query to select item from table itemLisst*/
						$result=$conn->query($sql);
						if ($result->num_rows > 0) {
							
							while($row = $result->fetch_assoc()) {
								$quantityRemaining=$row["quantity"];
								if($quantityRemaining==0){
									echo '<option class="list-group-item list-group-item-action list-group-item-danger justify-content-between ">'. 

									$row["itemName"].

									'</option>';
								}
								else if($quantityRemaining>50){
									echo '<option class="list-group-item list-group-item-action list-group-item-info justify-content-between ">'. 

									$row["itemName"].

									'</option>';
								}
							}
						}
						?><!--end of php-->
					</select>
				</div><!--end of form group-->
			</div><!--end of col-md-12-->


			<div class="col-md-12">
				<div class="form-group">
					<label for="itemListQuantity">Quantity</label>
					<input type="number" class="form-control" name="orderQuantity" id="itemListQuantity" min="1" >
				</div><!--end of form-group-->
			</div><!--end of col-md-12-->



			<button type="submit" name="itemSubmit" class="btn btn-primary">Add Quantity</button>

		</form> <!--end of form-->


		<!-- NEW ITEM ADD -->
		<div id="addNewItem">
			<div class = "col-md-12">
				<div class="form-group">
					<form method="POST">

						<label for="addNewItem"><h2>Add a new item: </h2></label>
						<br>
						<label> Item Name: </label>
						<input type="text" class="form-control" name="newItemName" required/>
						<label> Cost Price (In Rs.): </label>
						<input type="number" class="form-control" name="newCostPrice" min="1" required/>
						<label> Selling Price (In Rs.): </label>
						<input type="number" class="form-control" name="newSellPrice" min="1" required />
						<label> Quantity: </label>
						<input type="number" class="form-control" name="newQuantity" min="1" required/>
						<br>
						<button type="submit" name="itemAdd" class="btn btn-primary">ADD</button>
					</form>
				</div>
			</div>
			<?php 
			$newItemName=@$_POST['newItemName'];
			$newCostPrice=@$_POST['newCostPrice'];
			$newSellPrice=@$_POST['newSellPrice'];
			$newQuantity=@$_POST['newQuantity'];
			if(isset($_POST['itemAdd'])){

				$sqlAddNewItem="INSERT INTO itemlist(itemName,costPrice,sellPrice,quantity) VALUES ('$newItemName','$newCostPrice','$newSellPrice','$newQuantity')";
				$resultAddNewItem=$conn->query($sqlAddNewItem);
				if ($resultAddNewItem) {
					echo '<script> alert("Successfully added New Item");</script>';
				}
				else{
					echo '<script> alert("Error!!!");</script>';
				}
			}
			?>
		</div><!--end of container-->



		<script href="js/jquery.min.js"></script>
		<script href="js/bootstrap.min.js"></script>
	</body>

	</html>
