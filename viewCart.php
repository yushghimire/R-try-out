<?php
session_start();
?>
<!--view cart-->
<!DOCTYPE html>
<html lang="en">
<head>
	<title>View Cart</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js">

	</script>
	
</head>
<body>

	<?php
	include('connect.php');
	include('navbarCustomer.html');
	$tableName=$_SESSION['username'];
	$sqlUser="SELECT * from tbl_users where userName='$tableName'";
	$resultUser=$conn->query($sqlUser);
	

	while($row=$resultUser->fetch_assoc()){
		$memberNumberTemp=$row["memberNumber"];

	}


	?>
	<form method="post" action="viewCart.php">
		<?php
		echo'<div class="container">';
		
		
		
		$sql1="SELECT * FROM $tableName";
		$conn->query($sql1);
		$result1=$conn->query($sql1);

		
if(mysqli_num_rows($result1) > 0)
{
		echo '<h2> <center>Cart for <u>'.$tableName.'</center></u></h2>';
		echo'<table class="table">
		<tr>

			<th>Item Name</th>
			<th>Quantity</th>
			<th>Per Cost</th>
			<th>Total</th>
			<th>Delete</th>
		</tr>';
		$grandTotal=0;
		while($row1 = $result1->fetch_assoc()) {
		
			
			
				$grandTotal=$row1["total"]+$grandTotal;
			
			
		
			echo'<tr>

			<td>'.$row1["itemName"].'</td>
			<td>'.$row1["quantity"].'</td>
			<td>'.$row1["perCost"].'</td>
			<td>'.$row1["total"].'</td>
			<td>'; ?>
				<input type="checkbox" name="num[]" value=" <?php echo $row1["sno"]; ?>" /></td>


			</tr>
			<?php
			
			 }
			 echo '<th> </th>';
			 echo '<th> </th>';
			 echo '<th> </th>';
			 echo '<th>G.TOTAL='.$grandTotal.'</th>';
			 echo '<th> </th>';
			
}
			else 
			{
				echo '<script>alert("Cart is Empty");</script>';
				echo "<script>window.location.assign('itemListCustomer.php')</script>";
				} ?>


		</table>









		<input type="submit" name="clearSelected" value="Clear Selected">
		<input type="submit" name="clearCart" value="Clear All">

	</form>
	<br>
	<form method="POST" action="#">
		<br>
		<a data-toggle="modal" data-target="#myModal"><button class="btn btn-info">Book</button>
		</a>
		 
		<button class="btn btn-default" name="continueShopping">Continue Shopping</button>
	</form>
	<div class="modal fade" id="myModal" role="dialog">
		<div class="modal-dialog">

			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Confirm Booking?</h4>
				</div>
				<form action="#" method="post">
					<div class="modal-body">
					<?php 
					$tableName=$_SESSION['username'];
					$sqlFromAdv="SELECT * from adv_schema a INNER JOIN $tableName t ON a.itemName=t.itemName";
					$resultFromAdv=$conn->query($sqlFromAdv);
					if ($resultFromAdv->num_rows > 0){
						echo'<p>Did our advertisement led you to order these items ? </p>
						Yes:<input type="radio"  name="surveyCheck" value="yes" checked="checked"/><br>
						No:<input type="radio"  name="surveyCheck" value="no"/>';
					}

					?>
					</div>
					<div class="modal-footer">
						
						<button type="submit" name="bookItem" class="btn btn-primary">Confirm</button>
						
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
				</div>
			</form>
			<?php
			$surveyCheck=@$_POST['surveyCheck'];
			if(isset($_POST['continueShopping'])){
				echo "<script>window.location.assign('itemListCustomer.php')</script>";
			}
			if(isset($_POST['bookItem'])){
				$tableName=$_SESSION['username'];
				$sql1="SELECT * FROM $tableName";
				$conn->query($sql1);
				$result1=$conn->query($sql1);
				$sql2="SELECT * FROM itemList";
				$result2=$conn->query($sql2);
				while($row2=$result2->fetch_assoc()){
					while($row1=$result1->fetch_assoc()){

						if($row2['itemName']=$row1['itemName']){
							$orderQuantity=$row1['quantity'];
							$itemName=$row2['itemName'];

							$sql3 = "UPDATE itemlist SET quantity=quantity-$orderQuantity WHERE itemName='$itemName'";
							$conn->query($sql3);
							$sql4="INSERT INTO bookedItemTable(userName,itemName,quantity)  VALUES('$tableName','$itemName','$orderQuantity')";
							$resultBook=$conn->query($sql4);
							if($resultBook){
								$sqlBook="TRUNCATE table $tableName";
								$conn->query($sqlBook);
								echo '<script>alert("Successfully Booked");</script>';
								echo "<script>window.location.assign('itemListCustomer.php')</script>";

								$sql="UPDATE customer set response='$surveyCheck' where memberNumber='$memberNumberTemp'";
								$conn->query($sql);	

							}

						}
					}
				}
			}
			?>
		</div> 
	</div>
	


		<?php
				//$sql2="SELECT itemName,quantity FROM itemList";
				//$result2=$conn->query($sql2);




		if(isset($_POST['clearSelected'])){
			$tableName=$_SESSION['username'];
			$box=$_POST['num'];
			while(list ($key,$val)=@each ($box)){

				$sqlClear="DELETE from $tableName where sno='$val'";
				$resultClear=$conn->query($sqlClear);
				if($resultClear){
					echo '<script>alert("Successfully Cleared");</script>';
					echo "<script>window.location.assign('viewCart.php')</script>";
				}
			}
		}

		if(isset($_POST['clearCart'])){
			$tableName=$_SESSION['username'];
			$sql4="TRUNCATE table $tableName ";
			$result4=$conn->query($sql4);
			if($result4){
				echo '<script>alert("Successfully Cleared ALL");</script>';
				echo "<script>window.location.assign('viewCart.php')</script>";
			}
		}
		$conn->close();
		?>

	</div><!--end of container -->
</body>
</html>

<!--Data Dictionary
	sql1,row1,result1:customer table
	sql2,row2,result2: itemlist
	sql3 updating booked item in itemlist
	sql4 truncate cart table
-->