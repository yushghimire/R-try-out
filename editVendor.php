<?php
session_start();
include 'connect.php';

?>
<html>
<head>
    <title>Edit Vendor Details</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body>
    <?php
    include 'navbar.html';
    

    $id = @$_GET['id'];
    $listId=  @$_GET['listId']; 
  
    ?> 
    <div class="container">
    <?php
                $sql2 = "SELECT * FROM vendor where vendorId='$id'";
                $result2=$conn->query($sql2);
                while($row = $result2->fetch_assoc()){
                    $name = $row["vendorName"];
                    echo '<h2> <center>Edit '.$name.'</center></h2>';
                    echo ' 
                    

                    <form method="post" action="#">
                        <h2>Vendor Name:  </h2><textarea class="form-control" rows="1" name="editedName">'.$name.'</textarea>
                        <h2>Vendor Email:</h2><textarea class="form-control" rows="1" name="editedEmail">'.$row["vendorEmail"].'</textarea>
                        <h2>Vendor Location:</h2><textarea class="form-control" rows="1" name="editedLocation">'.$row["vendorLocation"].'</textarea>
                        
                        <br>
                        <a href="editVendor.php?id='.$id.'"> <button name="editVendorName" class="btn btn-default"> Update Vendor Details</button></a>

                    </form>
                    ';
                    $editedName=@$_POST['editedName'];
                    $editedEmail=@$_POST['editedEmail'];
                    $editedLocation=@$_POST['editedLocation'];
                    if (isset($_POST['editVendorName'])){
                    
                        $sql="UPDATE vendor Set vendorName='$editedName',vendorEmail='$editedEmail',vendorLocation='$editedLocation' WHERE vendorId='$id'";
                        $result=$conn->query($sql);
                        if($result){
                            echo ' <script>alert("Edited Successfully"); </script>';
                          
                            echo "<script>window.location.assign('editVendor.php?id='".$id.")</script>";
                            

                        }
                    }
                }

               
            
        ?>





        </div>
    </body>
    </html>