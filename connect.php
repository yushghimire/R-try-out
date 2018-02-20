
<!--database connection page-->
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname= "ims";

// Create connection, mysql_connect is not used as it is erased
$conn = mysqli_connect($servername, $username, $password,$dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>