<?php session_start(); ?>
<!DOCTYPE html>


<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->

<html>
<head>
    <meta charset="UTF-8">
    <title> Login Page </title>

    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" >
    <link rel="stylesheet" type ="text/css" href="css/style.css">
</head> 
<style>
    

</style>
<body>

    <div class="container" id="login">
    <h1><center>Login Page</center></h1>
        <div id="loginForm">
        <center>

            <form method="post" action="#" enctype="multipart/form-data">

                <span> Username: <input class= "loginInput" type="text" name="uname" placeholder="Username"/><br/> </br>           </span>

                <span>Password: <input class= "loginInput" type="password" name="password" placeholder="Password"/> <br/> <br/></span>

                <input class="submitButton" type="submit" name="submit" value="Login"/> <br/></br>

                <a class="submitButton" href="register.php" role="button">Sign Up</a>
            </form>
            </center>
        </div>

    </div>

    <script>
        window.location.hash="no-back-button";
            window.location.hash="Again-No-back-button";//again because google chrome don't insert first hash into history
            window.onhashchange=function(){window.location.hash="no-back-button";}
        </script> 
    </body>

    
    <?php

    include("connect.php");
    if(isset($_POST['submit'])){

        $uname=$_POST['uname'];
        $paassword=$_POST['password'];
        $check_psw= sha1($paassword);

        $sql = "SELECT * FROM tbl_users WHERE userName='$uname' AND password='$check_psw'";
        $result = $conn->query($sql);
        if(!$row = $result->fetch_assoc()){
            echo "<script>alert('Login Unsucessful');</script>";
        }
        
        else{
          $_SESSION['username']=$row['userName'];
          $_SESSION['account_type']=$row['accountType'];
          
          /*creating CART table, Giving the table the name of the customer*/
          if($_SESSION['account_type']=='customer'){
            $tableName=$row['userName']; 

            $sql2="CREATE TABLE $tableName(

            itemName VARCHAR(50)  ,
            sno INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
            quantity INT(5) UNSIGNED,
            perCost INT(5),
            total INT(5)
            )";

            $conn->query($sql2);
             echo "<script>window.location.assign('itemlistCustomer.php')</script>";
        }
        else {
            echo "<script>window.location.assign('itemlist.php')</script>";
        }
    }	
    	

}

$conn->close();

?> 

