 <?php
 session_start();
 
 include 'connect.php';
 ?>
 <html>
 <head>
  <title>Edit Item Details</title>
  
</head>
<body>

  <div class="container">

    <?php
   
if(isset($_POST["query"]))
{
 $search = mysqli_real_escape_string($conn, $_POST["query"]);
 $query = "SELECT * FROM itemlist WHERE itemName LIKE '%$search%' ";
}


@$result1 = mysqli_query($conn, $query);

$output='';
if ($result1!==FALSE) {
  if(@mysqli_num_rows($result1) > 0)
{

 $output .= '
 <div class="table-responsive">
   <table class="table table bordered">
    <tr>
     <th><center>Item ID</center></th>
     <th><center>Item Name</center></th>
     <th><center>Quantity</center></th>
     <th><center>Cost Price</center></th>
     <th><center>Sell Price</center></th>
     
     
   </tr>
   ';
   while($row = mysqli_fetch_array($result1))
   {

    $output .= '
    <tr>
     <td>'.$row["itemId"].'</td>
     <td><a href="editItem.php?id='.$row["itemId"].'">'.$row["itemName"].'</a></td>

     <td>'.$row["quantity"].'</td>
     <td>'.$row["costPrice"].'</td>
     <td>'.$row["sellPrice"].'</td>

   </tr>
   ';
 }
 
 echo $output;

}
else
{
 echo 'No search results';
}
}








?>
</div>
</body>
</html>
