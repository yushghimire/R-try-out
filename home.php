<?php
session_start();
?>
<html>
<head>
  <title>Home</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">

</head>

<body>
  <?php
  include 'navbar.html';
  ?>
  <div class="container-fluid">
   <div class="row">
     <div class="col-md-12">
       <div id="myCarousel" class="carousel slide" data-ride="carousel">
         <!-- Indicators -->
         <ol class="carousel-indicators">
           <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
           <li data-target="#myCarousel" data-slide-to="1"></li>
           
         </ol>

         <!-- Wrapper for slides -->
         <div class="carousel-inner">
           

           <div class="item active">
             <img src="img/buns.jpg" alt="buns" >
           </div>

           <div class="item">
             <img src="img/otherVegetables.jpg" alt="otherVegetables">
           </div>
         </div>

         <!-- Left and right controls -->
         <a class="left carousel-control" href="#myCarousel" data-slide="prev">
           <span class="glyphicon glyphicon-chevron-left"></span>
           <span class="sr-only">Previous</span>
         </a>
         <a class="right carousel-control" href="#myCarousel" data-slide="next">
           <span class="glyphicon glyphicon-chevron-right"></span>
           <span class="sr-only">Next</span>
         </a>
       </div>
     </div>
   </div>              

 </div>

 <script src="js/jquery.min.js" crossorigin="anonymous"></script>
 <!-- Latest compiled and minified JavaScript -->
 <script src="js/bootstrap.min.js" crossorigin="anonymous"></script>
</body>

</html>
