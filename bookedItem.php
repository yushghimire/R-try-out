<?php
session_start();
?>
<!--view cart-->
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Booked Item</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="css/bootstrap.min.css" rel="stylesheet">

</head>
<body>
	<?php
	include('connect.php');
	include('navbar.html');
	echo'<div class="container">';
	?>
	<form method="post" action="bookedItem.php">
		<?php 
		$sql1="SELECT * FROM bookedItemTable";
		$conn->query($sql1);

		$result1=$conn->query($sql1);

		if(mysqli_num_rows($result1) > 0)
		{
			echo'<table class="table">
			<tr>
				<th>Username</th>
				<th>Item Name</th>
				<th>Quantity</th>
				<th>Confirm?</th>
				<th>Delete</th>


			</tr>';

			while($row1 = $result1->fetch_assoc()) {
				$quantityBooked=$row1["quantity"];
				$quantityName=$row1["itemName"];
				echo'<tr>
				<td>'.$row1["userName"].'</td>
				<td>'.$row1["itemName"].'</td>
				<td>'.$row1["quantity"].'</td>

				';
				?>
				<td> <input type="checkbox" name="num[]" value=" <?php echo $row1["sno"];  ?>" /> </td>
				<td>
					<input type="checkbox" name="numDelete[]" value=" <?php echo $row1["sno"]; ?>" /></td>

				</tr>

				


				<?php } } 
				else { echo '<script>alert("No items right now. Check again later");</script>';
				echo "<script>window.location.assign('itemList.php')</script>";
			} ?>

		</table>
		<input type="submit" name="confirmSelected" value="Confirm Selected">
		<input type="submit" name="confirmTransaction" value="Confirm all">
		<input type="submit" name="deleteSelected" value="Cancel Selected">
	</table>


</form>
<?php
if(isset($_POST['confirmTransaction'])){
	$sqlJOIN= "SELECT t.memberNumber, b.userName,b.itemName
	FROM tbl_users t
	INNER JOIN bookedItemTable b ON t.userName = b.userName";
	$resultJOIN=$conn->query($sqlJOIN);

	while($row = $resultJOIN->fetch_assoc()){
		$num = $row["memberNumber"];
		$name= $row["userName"];
		$itemName=$row["itemName"];
		$date=date('Y-m-d');

		$sqlT="INSERT INTO transaction VALUES ('$num','$date','$itemName')";
		$resultT=$conn->query($sqlT);
		if($resultT){
			echo '<script>alert("All items are Confirmed");</script>';
			echo "<script>window.location.assign('bookedItem.php')</script>";
		}

	}



	$sql4="TRUNCATE table bookeditemtable ";

	$conn->query($sql4);
}

if(isset($_POST['confirmSelected'])){

	$box=$_POST['num'];
	while(list ($key,$val)=@each ($box)){
		$sqlJOIN= "SELECT t.memberNumber, b.userName,b.itemName
		FROM tbl_users t
		INNER JOIN bookedItemTable b ON t.userName = b.userName";
		$resultJOIN=$conn->query($sqlJOIN);

		while($row = $resultJOIN->fetch_assoc()){
			$num = $row["memberNumber"];
			$name= $row["userName"];
			$itemName=$row["itemName"];
			$date=date('Y-m-d');
			$sqlT="INSERT INTO transaction VALUES ('$num','$date','$itemName')";
			$resultT=$conn->query($sqlT);
			$sqlClear="DELETE from bookedItemTable where sno='$val'";
			$resultClear=$conn->query($sqlClear);
			if($resultClear){
				echo '<script>alert("Selected items are Confirmed");</script>';
				echo "<script>window.location.assign('bookedItem.php')</script>";
			}
		}
	}
}
if(isset($_POST['deleteSelected'])){
	$box=$_POST['numDelete'];
	while(list ($key,$val)=@each ($box)){
		$sqlClear="DELETE from bookedItemTable where sno='$val'";
		$resultClear=$conn->query($sqlClear);
		
		$sqlAddBack="UPDATE itemlist set quantity=quantity+$quantityBooked where itemName='$quantityName'";
		$resultAddBack=$conn->query($sqlAddBack);
		if($resultAddBack && $resultClear){
			echo '<script>alert("Selected items are deleted from the table and quantity is added back");</script>';
			echo "<script>window.location.assign('bookedItem.php')</script>";
		}
		
	}
}	?>


		<script href="js/jquery.min.js"></script>
		<script href="js/bootstrap.min.js"></script>
</body>
</html>