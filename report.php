 <!-- by ayushghimire  -->
 <?php

 /* Include the `fusioncharts.php` file that contains functions  to embed the charts. */

 include("includes/fusioncharts.php");
 include 'navbar.html';
 include ('connect.php');

 /* The following 4 code lines contain the database connection information. Alternatively, you can move these code lines to a separate file and include the file here. You can also modify this code based on your database connection. */

   $hostdb = "localhost";  // MySQl host
   $userdb = "root";  // MySQL username
   $passdb = "";  // MySQL password
   $namedb = "world";  // MySQL database name

   // Establish a connection to the database
   $dbhandle = new mysqli($hostdb, $userdb, $passdb, $namedb);

   /*Render an error message, to avoid abrupt failure, if the database connection parameters are incorrect */
   if ($dbhandle->connect_error) {
    exit("There was an error with your connection: ".$dbhandle->connect_error);
  }
  ?>

  <html>
  <head>
    <title>Report</title>
    <!-- You need to include the following JS file to render the chart.
    When you make your own charts, make sure that the path to this JS file is correct.
    Else, you will get JavaScript errors. -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/report_style.css" rel="stylesheet">
    <script src="fusioncharts/fusioncharts.js"></script>
  </head>

  <body>
    <div class="container">
      <div class="row">
        <div class="col-md-4">
          <select id="ddlOption" onchange="showdiv()">
            <option value="yearlyReport" data-div="divCollectionYearly">Yearly Report</option>
            <option value="Div2" data-div="div2">Customer Profiling</option>
            <option value="customerBuyPatten" data-div="divCollectionPattern">Customer's Buying pattern</option>
          </select>   
        </div><!--end of col-md-4-->
      </div><!--end of row-->
    </div><!--end of container-->

    <div class="container"> 
      <!-- collection of all the report that are to be showm--> 
      <div id="divCollection">
        <!--this div is only shown when the yearly Report is choosen from the dropdown option-->
        <div id="divCollectionYearly" class = "yearlyReport">
          <!-- shows the date selection from the the first year to the present year  -->
          <?php
          $sql = "SELECT DISTINCT MIN(purchaseDate) as min_date, MAX(purchaseDate) As max_date FROM transaction"; /* Query to select item from table itemLisst*/
          $result=$conn->query($sql);  
          while($row = $result->fetch_assoc()) {          
            $maxYear = $row["max_date"];
            $minYear = $row["min_date"];
          }
          $date = DateTime::createFromFormat("Y-m-d", $minYear);
          $itemYearMin = $date->format("Y");
          $date = DateTime::createFromFormat("Y-m-d", $maxYear);
          $itemYearMax = $date->format("Y");
          $temp = $itemYearMin;
          while($temp != $itemYearMax+1) {
            echo '<a href="#">' .$temp. '</a><br>';
            $temp++;
          }
          ?><!--end of php-->
          
          <?php
      // Form the SQL query that returns the top 10 most populous countries
          $strQuery = "SELECT Name, Population FROM Country ORDER BY Population DESC LIMIT 15";
      // Execute the query, or else return the error message.
          $result = $dbhandle->query($strQuery) or exit("Error code ({$dbhandle->errno}): {$dbhandle->error}");
      // If the query returns a valid response, prepare the JSON string
          if ($result) {
          // The `$arrData` array holds the chart attributes and data
            $arrData = array(
              "chart" => array(
                "caption" => "Yearly Report",
                "showValues" => "0",
                "theme" => "zune"
                )
              );
            $arrData["data"] = array();

  // Push the data into the array
            while($row = mysqli_fetch_array($result)) {
              array_push($arrData["data"], array(
                "label" => $row["Name"],
                "value" => $row["Population"]
                )
              );
            }

            /*JSON Encode the data to retrieve the string containing the JSON representation of the data in the array. */

            $jsonEncodedData = json_encode($arrData);

            /*Create an object for the column chart using the FusionCharts PHP class constructor. Syntax for the constructor is ` FusionCharts("type of chart", "unique chart id", width of the chart, height of the chart, "div id to render the chart", "data format", "data source")`. Because we are using JSON data to render the chart, the data format will be `json`. The variable `$jsonEncodeData` holds all the JSON data for the chart, and will be passed as the value for the data source parameter of the constructor.*/

            $columnChart = new FusionCharts("column2D", "myFirstChart" , 700, 500, "chart-1", "json", $jsonEncodedData);

          // Render the chart
            $columnChart->render();

          // Close the database connection
            $dbhandle->close();
          }

          ?> <!-- end of php -->

          <div id="chart-1"><!-- Fusion Charts will render here--></div>
        </div> <!--end of ID yearlyReport-->
      </dSiv><!--end of divCollection-->

      <div id="divCollectionPattern" class="customerBuyPattern">
        <div class="col-md-4"></div><!--end of col-md-4-->
        <div class="col-md-6">
          <form  method="POST">
            <button type="submit" name="analyzeSubmit" class="btn btn-primary">Analyze</button>
          </form><!--end of form-->
        </div><!--emnd of col-md-10-->
        <br><br>
        <!--start of php for analyzing the data in mysql for association rule-->
        

        <?php

        if(isset($_POST['analyzeSubmit'])){ 
            // Execute the R script within PHP code
          shell_exec("associationRules.R");
          echo '<img src="img/graph.svg" alt="Mountain View">';

        }

        ?> <!--end of php to execute R-->

      </div><!--end of divCollectionPattern-->

    </div><!--end of container -->

    <!--javascript connection code --> 
    <script type="text/javascript" src="js/report_javaScript.js"></script>
    <script src="js/jquery.min.js" crossorigin="anonymous"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="js/bootstrap.min.js" crossorigin="anonymous"></script>
    <!--end of javascript connection code-->

  </body><!--end of body-->
  </html><!--end of html