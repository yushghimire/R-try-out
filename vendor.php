<?php
session_start();
include 'connect.php';
include 'navbar.html';
?>
<html>
<head>
	<title>Vendor Details</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="css/style.css" rel="stylesheet">
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script> 
		$(document).ready(function(){
			$("#flip").click(function(){
				$("#panel").slideToggle("slow");
			});
		});
		$(document).ready(function(){
			$("#flip1").click(function(){
				$("#panel1").slideToggle("slow");
			});
		});

		$(document).ready(function(){
			$("#flip2").click(function(){
				$("#panel2").slideToggle("slow");
			});
		});
		$(document).ready(function(){
			$("#flip3").click(function(){
				$("#panel3").slideToggle("slow");
			});
		});
		$(document).ready(function(){
			$("#flip4").click(function(){
				$("#panel4").slideToggle("slow");
			});
		});
		$(document).ready(function(){
			$("#flip5").click(function(){
				$("#panel5").slideToggle("slow");
			});
		});
	</script>

	<style> 
		#panel1,#flip1,#panel2,#flip2,#panel3,#flip3,#panel4,#flip4,#panel5,#flip5{
			padding: 5px;
			text-align: center;
			background-color: #80b7b7;
			border: solid 1px #e6ecf7;
			color:#af1a29;
			height:40px;
			font-size: 20px;
		}

		#panel1,#panel2,#panel3,#panel4,#panel5{
			padding: 15px;
			display: none;
			text-align: left;
			background-color: #f2f4f7;
			font-size: 25px;
			height: 110px;
		}
		
		a:link {
			text-decoration: none;
			
		}

		a:visited {
			text-decoration: none;
		}
		a{
			color:#1d1e1c;
		}
		.buttonVendor{
			background-color:#d7f2ba;
			border: solid 1px #e6ecf7;
			border-radius: 10px;
			padding:20px;
			width:350px;
			box-shadow: 7px 14px 13px -5px rgba(0,0,0,0.75);
			margin-left: 125px;
			height:70px;
		}
		

		.buttonVendor:hover{
			background-color: #879e70;
		}
		
	</style>
</head>

<body>
<div class="container">
	<?php
	$sql = "SELECT * FROM vendor";
	$result=$conn->query($sql);

	while($row = $result->fetch_assoc()){
		echo '<div id="flip'.$row["vendorId"].'"><a href="#" >'.$row["vendorId"].'. '.$row["vendorName"].'</a></div>
			
			
			  <div id="panel'.$row["vendorId"].'">
			  		 <a href="order.php?listId='.$row["itemCategory"].'"> <button class="buttonVendor " >Item List</button></a>
			 		 
					 <a href="editVendor.php?id='.$row["vendorId"].'"> <button class="buttonVendor" >Edit</button> </a>
					 </div>
					 <br>
					
			  <br>';
			}
			?>
			</div>
			
		</body>
		</html>