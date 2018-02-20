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
    <link href="css/cluster_style.css" rel="stylesheet">
    <script src="//d3js.org/d3.v4.min.js"></script>
  </head>

  <body>

    <div class="container-fluid">

      <div class="showCluster">
        <div class="row">

          <div class="col-md-8">
            <form action = "searchCluster.php" method="POST">
            <br>
              <input type="text" class="form-control searchFor" placeholder="Search" name="searchFor">
              <br>
             <button type="submit" class="btn btn-info">Search</button>
    </a>
              <button type="submit" name="customerCluster" class="btn btn-primary">CLUSTER</button>
            </form>
          </div>
          
          <?php
          if(isset($_POST['customerCluster'])){
           shell_exec("RFManalysis.R");
         }
         ?>

         <div class="col-md-4 clusterLabel">
          <h1>Customer Hierarchy</h1>
          <!-- Split button -->
          <label>Cluster</label>
          <select id="clusterOption" onchange="change()">
            <option value="1" data-div="cluster1">1</option>
            <option value="2"  data-div="cluster2">2</option>
            <option value="3"  data-div="cluster3">3</option>
            <option value="4"  data-div="cluster4">4</option>
          </select>
        </div>
      </div> <!--end of row-->

      <div class="row">
       <div id="clusterViz" class="col-md-8 ">
        <?php 
          include("ss.php"); ?>
        </div>
        <div class="col-md-4 allItem">

          <div id="cluster1">

            <?php

            $sqlCluster = "SELECT * FROM customer INNER JOIN tbl_users ON customer.memberNumber = tbl_users.memberNumber WHERE cluster = 1";
            $resultCluster = $conn -> query($sqlCluster);

            echo '<div data-spy="scroll" class="list-group">';
            if ($resultCluster->num_rows > 0) {
                       // output data of each row
              while($row = $resultCluster->fetch_assoc()) {        
                echo '<a class="list-group-item list-group-item-action justify-content-between">
                '.$row['userName'].' <span class="badge badge-default badge-pill"> '.$row["memberNumber"].'</span>
              </a>';
            }
          } 
          else {
            echo "0 results";
          }
          echo '</div>';
          ?><!--end of php-->

        </div><!--end of cluster1-->

        <div id="cluster2">
          <?php

          $sqlCluster = "SELECT * FROM customer INNER JOIN tbl_users ON customer.memberNumber = tbl_users.memberNumber WHERE cluster = 2";
          $resultCluster = $conn -> query($sqlCluster);

          echo '<div data-spy="scroll" class="list-group">';
          if ($resultCluster->num_rows > 0) {
                       // output data of each row
            while($row = $resultCluster->fetch_assoc()) {        
              echo '<a class="list-group-item list-group-item-action justify-content-between">
              '.$row['userName'].' <span class="badge badge-default badge-pill"> '.$row["memberNumber"].'</span>
            </a>';
          }
        } 
        else {
          echo "0 results";
        }
        echo '</div>';
        ?><!--end of php-->

      </div> <!--end of cluster2--> 

      <div id="cluster3">
        <?php

        $sqlCluster = "SELECT * FROM customer INNER JOIN tbl_users ON customer.memberNumber = tbl_users.memberNumber WHERE cluster = 3";
        $resultCluster = $conn -> query($sqlCluster);

        echo '<div data-spy="scroll" class="list-group">';
        if ($resultCluster->num_rows > 0) {
                       // output data of each row
          while($row = $resultCluster->fetch_assoc()) {        
            echo '<a class="list-group-item list-group-item-action justify-content-between">
            '.$row['userName'].' <span class="badge badge-default badge-pill"> '.$row["memberNumber"].'</span>
          </a>';
        }
      } 
      else {
        echo "0 results";
      }
      echo '</div>';
      ?><!--end of php-->

    </div> <!--end of cluster3--> 

    <div id="cluster4">
      <?php

      $sqlCluster = "SELECT * FROM customer INNER JOIN tbl_users ON customer.memberNumber = tbl_users.memberNumber WHERE cluster = 4";
      $resultCluster = $conn -> query($sqlCluster);

      echo '<div data-spy="scroll" class="list-group">';
      if ($resultCluster->num_rows > 0) {
                       // output data of each row
        while($row = $resultCluster->fetch_assoc()) {        
          echo '<a class="list-group-item list-group-item-action justify-content-between">
          '.$row['userName'].' <span class="badge badge-default badge-pill"> '.$row["memberNumber"].'</span>
        </a>';
      }
    } 
    else {
      echo "0 results";
    }
    echo '</div>';
    ?><!--end of php-->

  </div> <!--end of cluster4--> 
</div> <!--end of allItem-->
</div> <!--end of row-->
</div><!--end of showCluster-->

</div><!--end of container-->

<script src="js/jquery.min.js" crossorigin="anonymous"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="js/bootstrap.min.js" crossorigin="anonymous"></script>
<script src="js/cluster_javaScript.js"></script>

</body>
</html>

