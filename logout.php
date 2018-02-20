<?php
session_start();
include('connect.php');
$tableName=$_SESSION['username'];
$sql="SELECT * from $tableName";
$conn->query($sql);
$result = $conn->query($sql);

$sql2="DROP table $tableName";
$conn->query($sql2);
echo "<script>window.location.assign('index.php')</script>";	

$conn->close();
session_destroy();


?>


<script>
	window.location.hash="no-back-button";
window.location.hash="Again-No-back-button";//again because google chrome don't insert first hash into history
window.onhashchange=function(){window.location.hash="no-back-button";}
</script> 
<!-- /* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */ -->

