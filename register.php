<?php 
    session_start();
?>

<!DOCTYPE html>

<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html >
    <head>
        <meta charset="UTF-8">
         <title> Registration Page </title>
         <link rel="stylesheet" type ="text/css" href="css/style.css"/>
         <link href="css/bootstrap.min.css" rel="stylesheet">
    </head>
    
    <body>       
           <?php
           
            include("connect.php");
             $fnameErr= $lnameErr= $unameErr =$passwordErr=$repasswordErr=$account_typeErr= "";
             $fname= $lname = $uname=$repassword= $Username= $account_type= $paassword="";
            if(isset($_POST['submit']))
            {
            if (empty($_POST["fname"]))
            {
                    $fnameErr="Field Empty";
                 }
                 else{
                     $fname = ($_POST["fname"]);
                 }

                if(empty($_POST["lname"])){
                     $lnameErr="Field Empty";
                 }
                 else{
                     $lname = ($_POST["lname"]);
                 }
                 if(empty($_POST["uname"])){
                     $unameErr="Field Empty";
                 }
                 else{
                     $uname = ($_POST["uname"]);
                 }
                 if(empty($_POST["email"])){
                     $emailErr="Field Empty";
                 }
                 else{
                     $email = ($_POST['email']);
                 }
               
                 if(empty($_POST["Password"])){
                     $passwordErr="Field Empty";
                 }
                 else{
                     $paassword = ($_POST["Password"]);
                 }
                 if(empty($_POST["repassword"])){
                     $repasswordErr="Field Empty";
                 }
                 else{
                     $repassword=$_POST["repassword"];
                 }
                if($repassword != $paassword){
                    $paassword = NULL;
                    echo "Password Does not match";
                }     
                 if(empty($_POST["account_type"])){
                     $account_typeErr="Field Empty";
                 }    
                 else{
                  $account_type=$_POST["account_type"];   
                 }
                 if(($fname && $lname && $paassword && $uname)!= null){
                     
                     include ('connect.php'); 
                    //$encrypted_password=  password_hash($paassword,PASSWORD_DEFAULT); 
                    $sql = "INSERT INTO tbl_users(firstName,lastName,userName,email,accountType,password) VALUES('$fname','$lname','$uname','$email','$account_type',sha1('$paassword'))";    
                    if ($conn->query($sql) === TRUE) {
                    echo "<script> alert('New record created successfully');</script>";
                    } else {
                        echo "Error: "  . "<br>" . $conn->error;
                    }
                     $conn->close(); 
                 }
            }
            
      ?>
        <div class="container" id="register">
            <div id="registerForm">
            <h1> <center> Sign up Page </center></h1>
            <center>
                <p><span class="error">* required field.</span></p>
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">                                
                    <input class= "loginInput" type="text" name="fname" placeholder="First Name"/> <span class="error">* <?php echo $fnameErr;?></span><br/> <br/>
                   
                    <input class= "loginInput" type="text" name="lname"placeholder="Last Name"/> <span class="error">* <?php echo $lnameErr;?></span> <br/> <br/>   
                    
                    <input class= "loginInput" type="text" name="uname" placeholder="Username"/> <span class="error">* <?php echo $unameErr;?></span><br/> <br/>
                    
                    <input class= "loginInput" type="text" name="email" placeholder="Email"/> <span class="error">*

            <br>

                    Select The Type of Account: <span class="error">* <?php echo $account_typeErr;?></span><br/>
                         <input type="radio" name="account_type"
                            <?php if (isset($account_type) && $account_type=="Customer") echo "checked";?>
                            value="customer">Customer
                            <input type="radio" name="account_type"
                            <?php if (isset($account_type) && $account_type=="Employee") echo "checked";?>
                                value="employee">Employee<br/> <br/>
                   
                                   
                    
                    <input class= "loginInput" type="password" name="Password" placeholder="Password"/> <span class="error">* <?php echo $passwordErr;?></span> <br/> <br/>
                 
                    <input class= "loginInput" type="password" name="repassword" placeholder="Retype Password"/> <span class="error">* <?php echo $repasswordErr;?></span> <br/> <br/>
                   
                    <input class="submitButton" type="submit" name="submit" value="Sign UP"/> <br/> </br>
                    <p> Already have ID ?</p>
                    <a class="submitButton" href="index.php" role="button">Login</a>
                </form>
            </div>
        </div>   
        
   
      </center>  
    </body>
</html>



