<html>
<head>
  <title>Home</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">-->
  <link href="css/style.css" rel="stylesheet">

</head>

<body>
<?php 
session_start();
include('connect.php');
include('navbarCustomer.html');
echo '<div class="container">';
$input=mysqli_real_escape_string($conn,$_POST['searchFor']);
$searchFlag=false;
$searchresult=array();

$strLength=strlen($input);
$str[1]=substr($input,0,floor($strLength/3));
$str[2]=substr($input,floor($strLength/3),floor($strLength)/3);
$str[3]=substr($input,floor(2*$strLength)/3);

	
	if(empty($input))
{
	echo"<h1>Please enter something to search</h2>";
}
else{
	echo '<h1>Search Results for <u>'.$input.'</u>:</h1>';
	$sql = "select * from itemlist where itemName like '%$input%'";
	$result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result) > 0) 
	{

		$searchFlag=true;
		while($row = $result->fetch_assoc())
		{ 
			echo '<a  class="list-group-item list-group-item-action list-group-item-info justify-content-between" href="itemBookCustomer.php?id='.$row["itemId"].'">'. $row["itemName"]. '--- '.$row["quantity"].'';
			}
}


}
if(!$searchFlag && !empty($input))
{
	echo "<h2>No Results for ".$input. " </h2>
	</div>";
}
?>