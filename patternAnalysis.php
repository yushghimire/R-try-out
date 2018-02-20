<!-- by ayushghimire  -->
<?php
session_start();

/* Include the `fusioncharts.php` file that contains functions  to embed the charts. */

include 'navbar.html';
include ('connect.php');
?>

<html>
<head>
	<title>Report</title>
    <!-- You need to include the following JS file to render the chart.
    When you make your own charts, make sure that the path to this JS file is correct.
    Else, you will get JavaScript errors. -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/patternAnalysis_style.css" rel="stylesheet">
    
</head>

<body>
	<div class="container">
		<div id="divCollectionPattern" class="customerBuyPattern">
			
			<div class="col-md-6">
				<form  method="POST">
					<button type="submit" name="analyzeSubmit" class="btn btn-primary">Analyze</button>
				</form><!--end of form-->
			</div><!--emnd of col-md-10-->
			<br><br>
			<!--start of php for analyzing the data in mysql for association rule-->
			<?php

			if(isset($_POST['analyzeSubmit'])){ 
            // Execute the R script within PHP code
				shell_exec("associationRules.R");
				//require'rules.php';	
			}

			?> <!--end of php to execute R-->

			<img src="img/graph.svg" alt="Mountain View">;
		</div><!--end of divCollectionPattern-->
	</div><!--end of container -->

	<script src="js/jquery.min.js" crossorigin="anonymous"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="js/bootstrap.min.js" crossorigin="anonymous"></script>
    <!--end of javascript connection code-->
</body>
</html>
