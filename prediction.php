<?php
session_start();
?>

<!doctype html>
<meta charset="utf-8">

<?php 

include 'navbar.html';
include ('connect.php');

?>

<html>
<head>
  <title>
    Report
  </title>
    <!-- You need to include the following JS file to render the chart.
    When you make your own charts, make sure that the path to this JS file is correct.
    Else, you will get JavaScript errors. -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/prediction_style.css" rel="stylesheet">
    <script src="js/d3.min.js"></script>
  </head>

  <body>
    <div class="container-fluid">
      <div class="showCluster">
        <div class="row">

          <div class="col-md-7">

           <div class="autoAdvContainer">
             <form method="POST">
              <label for="addNewItem"><h2>Automatic Email</h2></label>
              <br>
              <div class="form-group">
                <label for="itemListMultipleSelect">Item List</label>
                <select multiple class="form-control" name= "advItemName" id="itemListMultipleSelect" size="15">

                  <?php 

                  $sql = "SELECT * FROM itemlist"; /* Query to select item from table itemLisst*/
                  $result=$conn->query($sql);
                  if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                      echo '<option>'.$row["itemName"].'</option>';
                    }
                  }
                  ?><!--end of php-->

                </select>
              </div><!--end of form group-->

              <label> Adv Scheme: </label><br>
              <textarea class="advScheme" name="schemeText" rows="5"></textarea>
              <br><br>
              <button type="submit" name="emailAdv" class="btn btn-primary">MAIL</button>
            </form>
          </div><!--end of autoAdvContainer-->
        </div><!--end of col-md-8-->

        <?php 

        if(isset($_POST['emailAdv'])){


          $itemName = @$_POST['advItemName'];
          $schemeText =@$_POST['schemeText'];
          if(!empty($schemeText)){
          $autoMailQuery = "SELECT memberNumber from customer WHERE total_response = 1";
          $resultAutoMail = $conn -> query($autoMailQuery);
          $msg = $schemeText;
          while($row = $resultAutoMail -> fetch_assoc()){

            $memberNo = $row['memberNumber'];
            $checkEmail = "SELECT email from tbl_users WHERE memberNumber='$memberNo'";
            $resultEmail = $conn -> query($checkEmail);

            while($row = $resultEmail -> fetch_assoc()){
              $emailOfVendor = $row['email'];
              //echo $emailOfVendor.'<br>'.'->'.$msg;
            }
            // send email using PHP's built in 
            // command, mail()
            @mail($emailOfVendor, 
              'Order from Show Shopper', $msg);

          }

          

          $sqlInsertInto = 'INSERT INTO adv_schema(itemName,advDescription) VALUES("'.$itemName.'","'.$schemeText.'")';
          $resultInsertInto=$conn->query($sqlInsertInto);
          if($resultInsertInto){
            echo '<script>alert("Email Sent Succesfully!!!!"); </script>';
          }
        }
         else
      {
        echo '<script>alert("Empty Text."); </script>';
      }
      }

     
        ?>

        <div class="col-md-1"></div>


        <div class="col-md-4 clusterLabel">
          <h1>Customer Prediction</h1>
          <div class="row">
            <div class="col-md-6">
              <form  method="POST">
                <button type="submit" name="marketPredict" class="btn btn-primary">Predict</button>
              </form><!--end of form-->
            </div>

            <?php

            if(isset($_POST['marketPredict'])){ 
            // Execute the R script within PHP code
              shell_exec("randomForestSample.R");

              $sqlTruncate = "TRUNCATE TABLE customer";
              $conn -> query($sqlTruncate);
              $sqlUploadCSV = "LOAD DATA LOCAL INFILE 'C:/xampp/htdocs/DAI/customerUpload.csv'
              INTO TABLE customer
              FIELDS TERMINATED BY ','
              ENCLOSED BY '\"'
              LINES TERMINATED BY '\n'
              IGNORE 1 LINES
              (memberNumber, response,cluster,Random_response, SVM_response,adaBoost_response,total_response)";
              $conn -> query($sqlUploadCSV);

            }

            ?> <!--end of php to execute R-->
            <!-- Split button -->
            <div class="col-md-6">
              <label>Yes/No</label>
              <select id="clusterOption" onchange="choose()">
                <option value="Yes" data-div="yes">Yes</option>
                <option value="No"  data-div="no">No</option>
              </select>
            </div><!--end of col-md-6-->
          </div><!--end of row-->
          <br>
          <div class="optionContainer">
            <div id="yes">

              <?php
              $sqlCluster = "SELECT * FROM customer INNER JOIN tbl_users ON customer.memberNumber = tbl_users.memberNumber WHERE total_response = 1";
              $resultCluster = $conn -> query($sqlCluster);

              echo '<div data-spy="scroll" class="list-group">';
              if ($resultCluster->num_rows > 0) {
                       // output data of each row
                while($row = $resultCluster->fetch_assoc()) {        
                  echo '<a class="list-group-item list-group-item-action justify-content-between">
                  '.$row['userName'].' </a>';
                }
              } 
              else {
                echo "0 results";
              }
              echo '</div>';
              ?><!--end of php-->

            </div><!--end of yes-->

            <div id="no">
              <?php
              $sqlCluster = "SELECT * FROM customer INNER JOIN tbl_users ON customer.memberNumber = tbl_users.memberNumber WHERE total_response = 0";
              $resultCluster = $conn -> query($sqlCluster);

              echo '<div data-spy="scroll" class="list-group">';
              if ($resultCluster->num_rows > 0) {
                       // output data of each row
                while($row = $resultCluster->fetch_assoc()) {        
                  echo '<a class="list-group-item list-group-item-action justify-content-between">
                  '.$row['userName'].' </a>';
                }
              } 
              else {
                echo "0 results";
              }
              echo '</div>';
              ?><!--end of php-->

            </div> <!--end of no--> 
          </div><!--end of optionContainer-->
        </div><!--end of clusterLabel-->
      </div> <!--end of row-->
    </div><!--end of showCluster-->
  </div><!--end of container-fluid-->


  <!-- JavaScript code for building the chart -->
  <script src="js/jquery.min.js" crossorigin="anonymous"></script>
  <script src="js/bootstrap.min.js" crossorigin="anonymous"></script>
  <script src="js/predict_javaScript.js"></script>

</body>
</html>

