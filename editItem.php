<?php
session_start();
include 'connect.php';
include 'navbar.html';
?>
<html>
<head>
    <title>Edit Item Details</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body>
    <?php

    

    $id = @$_GET['id'];   

    ?>
    <div class="container">
        <input type="text" name="search_text" id="search_text" placeholder="Search by Item Name" class="form-control" />

        <div id="result"> </div>
        <div class="row">
            
            <div class="col-md-8">
                <?php
                $sql2 = "SELECT * FROM itemlist where itemId='$id'";
                $result2=$conn->query($sql2);
                while($row = $result2->fetch_assoc()){
                    $name = $row["itemName"];
                    echo ' <h2> <center> Edit '.$name.'</center></h2>
                    

                    <form method="post" action="#">
                        <h2>Item Name:  '.$name.'
                        <h2>Quantity:</h2>'.$row["quantity"].'
                        <h2>Cost Price:</h2><textarea name="editedCostPrice" class="form-control" rows="1">'.$row["costPrice"].'</textarea>
                        <h2>Sell Price:</h2><textarea name="editedSellPrice" class="form-control" rows="1">'.$row["sellPrice"].'</textarea>
                        <br>
                        <a href="editItem.php?id='.$id.'"> <button name="editName" class="btn btn-default"> Update Item Details</button></a>

                    </form>
                    ';
                    $editedName=@$_POST['editedName'];
                    $editedQuantity=@$_POST['editedQuantity'];
                    $editedCostPrice=@$_POST['editedCostPrice'];
                    $editedSellPrice=@$_POST['editedSellPrice'];
                    if (isset($_POST['editName'])){
                        $sql="UPDATE itemlist Set itemName='$editedName',quantity='$editedQuantity',costPrice='$editedCostPrice',sellPrice='$editedSellPrice' WHERE itemId='$id'";
                        $result=$conn->query($sql);
                        if($result){
                            header('Location: ' . 'editItem.php?id='.$id);
                            echo ' <script>alert("Edited Successfully"); </script>';

                        }
                    }
                }


                ?>
            </div>
            <div class="col-md-4">
            </div>
        </div>
        

    </div>
</body>
</html>

<script>
    $(document).ready(function(){

        load_data();

        function load_data(query)
        {
            $.ajax({
                url:"test1.php",
                method:"POST",
                data:{query:query},
                success:function(data)
                {
                    $('#result').html(data);
                }
            });
        }
        $('#search_text').keyup(function(){
            var search = $(this).val();
            if(search != '')
            {
                load_data(search);
            }
            else
            {
                load_data();
            }
        });
    });
</script>