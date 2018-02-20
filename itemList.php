<?php
session_start();
?>
<html>
<head>
    <title>Home</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Latest compiled and minified CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/itemlist_style.css" rel="stylesheet">
    <script>
        window.location.hash="no-back-button";
            window.location.hash="Again-No-back-button";//again because google chrome don't insert first hash into history
            window.onhashchange=function(){window.location.hash="no-back-button";}
        </script> 
    </head>
    <body>
        <?php
        include 'navbar.html';
        include 'connect.php';
        ?>

        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h1>Itemlist</h1>
                    <!-- Split button -->
                    <select id="ddlOption" onchange="showdiv()">
                        <option value="All Item" data-div="allItem">All Item</option>
                        <option value="Low in stock" data-div="lowInStock">Low In Stock</option>
                        <option value="Available" data-div="availableItem">Available</option>
                        <option value="Unavailable" data-div="unavailable">Unavailable</option>
                        <option value="Recently added" data-div="recentlyAdded">Recently Added</option>


                    </select>
                </div><!--end of col-md-4-->
            </div><!--end of row-->
            <br>
            <div class="row">
                <div class="col-md-12">
                    <div class="collection">
                        <div id="allItem">
                            <?php
                            $sql = "SELECT * FROM itemList"; /* Query to select item from table itemLisst*/
                            $result=$conn->query($sql);
                            echo '<div data-spy="scroll" class="list-group">';
                            if ($result->num_rows > 0) {
                     // output data of each row
                                while($row = $result->fetch_assoc()) {
                                    $itemNumber = $row["quantity"];
                                    if ($itemNumber == 0){
                                        echo '
                                        <div class="itemStyle">
                                            <a  class="list-group-item list-group-item-action list-group-item-danger justify-content-between " href="itemBook.php?id='.$row["itemId"]. '">'
                                                .$row["itemName"]. '
                                                <span class="badge badge-default badge-pill"> '.$row["quantity"].'</span>
                                            </a></div>';
                                        }
                                        else{
                                            echo '
                                            <div class="itemStyle">
                                                <a class="list-group-item list-group-item-action justify-content-between " href="itemBook.php?id='.$row["itemId"]. '">'
                                                    .$row["itemName"].'
                                                    <span class="badge badge-default badge-pill"> '.$row["quantity"].'</span>
                                                </a></div>';
                                            }
                                        }
                                    } else {
                                        echo "0 results";
                                    }


                                    echo '</div>';


                                    ?> <!--end of php-->
                                </div><!--end of #allItem-->

                                <div id="lowInStock" class="divCollectionLow">
                                    <?php
                                    $sql = "SELECT * FROM itemList where quantity <60 and quantity!=0"; /* Query to select item from table itemLisst*/
                                    $result=$conn->query($sql);
                                    echo '<div data-spy="scroll" class="list-group">';
                                    if ($result->num_rows > 0) {
                     // output data of each row
                                        while($row = $result->fetch_assoc()) {
                                            $itemNumber = $row["quantity"];
                                            if ($itemNumber == 0){
                                                echo '
                                                <a  class="list-group-item list-group-item-action list-group-item-danger justify-content-between" href="itemBook.php?id='.$row["itemId"]. '">'
                                                    .$row["itemName"]. '
                                                    <span class="badge badge-default badge-pill"> '.$row["quantity"].'</span>
                                                </a>';
                                            }
                                            else{
                                             echo '
                                             <a class="list-group-item list-group-item-action justify-content-between" href="itemBook.php?id='.$row["itemId"]. '">'
                                                .$row["itemName"].'
                                                <span class="badge badge-default badge-pill"> '.$row["quantity"].'</span>
                                            </a>';
                                        }
                                    }
                                } else {
                                    echo "0 results";
                                }


                                echo '</div>';


                                ?> <!--end of php-->
                            </div><!--end of #lowInStock-->

                            <div id="availableItem"  class="divCollectionAvailable">
                                <?php
                                $sql = "SELECT * FROM itemList where quantity>0"; /* Query to select item from table itemLisst*/
                                $result=$conn->query($sql);
                                echo '<div data-spy="scroll" class="list-group">';
                                if ($result->num_rows > 0) {
                     // output data of each row
                                    while($row = $result->fetch_assoc()) {
                                        $itemNumber = $row["quantity"];


                                        echo '
                                        <a class="list-group-item list-group-item-action justify-content-between" href="itemBook.php?id='.$row["itemId"]. '">'
                                            .$row["itemName"].'
                                            <span class="badge badge-default badge-pill"> '.$row["quantity"].'</span>
                                        </a>';

                                    }
                                } else {
                                    echo "0 results";
                                }


                                echo '</div>';


                                ?> <!--end of php-->
                            </div><!--end of #available-->

                            <div id="unavailable"  class="divCollectionUnavailable">
                                <?php
                                $sql = "SELECT * FROM itemList where quantity=0"; /* Query to select item from table itemLisst*/
                                $result=$conn->query($sql);
                                echo '<div data-spy="scroll" class="list-group">';
                                if ($result->num_rows > 0) {
                     // output data of each row
                                    while($row = $result->fetch_assoc()) {
                                        $itemNumber = $row["quantity"];
                                        if ($itemNumber == 0){
                                            echo '
                                            <a class="list-group-item list-group-item-action list-group-item-danger justify-content-between">'
                                                .$row["itemName"].'
                                                <span class="badge badge-default badge-pill">'.$row["quantity"].'</span>
                                            </a>';
                                        }
                                        else{
                                            echo '
                                            <a class="list-group-item list-group-item-action justify-content-between">'
                                                .$row["itemName"].'
                                                <span class="badge badge-default badge-pill">'.$row["quantity"].'</span>
                                            </a>';
                                        }
                                    }
                                } else {
                                    echo "0 results";
                                }


                                echo '</div>';


                                ?> <!--end of php-->
                            </div><!--end of #unavailable-->

                            <div id="recentlyAdded" class="divCollectionRecentlyAdded">
                                <?php
                                $sql = "SELECT * FROM itemList where quantity!=0 and itemId>167 ORDER BY itemId DESC LIMIT 10"; /* Query to select item from table itemLisst*/
                                $result=$conn->query($sql);
                                echo '<div data-spy="scroll" class="list-group">';
                                if ($result->num_rows > 0) {
                     // output data of each row
                                    while($row = $result->fetch_assoc()) {
                                        $itemNumber = $row["quantity"];
                                        if ($itemNumber == 0){
                                            echo '
                                            <a  class="list-group-item list-group-item-action list-group-item-danger justify-content-between" href="itemBook.php?id='.$row["itemId"]. '">'
                                                .$row["itemName"]. '
                                                <span class="badge badge-default badge-pill"> '.$row["quantity"].'</span>
                                            </a>';
                                        }
                                        else{
                                         echo '
                                         <a class="list-group-item list-group-item-action justify-content-between" href="itemBook.php?id='.$row["itemId"]. '">'
                                            .$row["itemName"].'
                                            <span class="badge badge-default badge-pill"> '.$row["quantity"].'</span>
                                        </a>';
                                    }
                                }
                            } else {
                                echo "0 results";
                            }


                            echo '</div>';


                            ?> <!--end of php-->
                        </div><!--end of #lowInStock-->
                    </div><!-- end of collection -->
                </div>   <!--end of col-md-12-->
            </div><!--end of row-->



        </div> <!--end of container-->             

        <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <script src="js/itemlist_javaScript.js"></script>
    </body>

    </html>
