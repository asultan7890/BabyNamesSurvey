<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Baby Names Survey</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>

    <!-- Plugin CSS -->
    <link href="vendor/magnific-popup/magnific-popup.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/creative.min.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">  

  </head>
    
  <?php
  //connect to sql database
  require_once './php/db_connect.php';
  ?>

  <body id="page-top">

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
      <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="#page-top">Baby Names Survey</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
           <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#survey">Survey</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#results">Results</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Survey -->
    <section class="bg-primary" id="survey">
      <div class="container">
        <div class="row">
          <div class="col-lg-8 mx-auto text-center">
            <h2 class="section-heading text-white">Baby Names Survey</h2>
            <hr class="light my-4">
            <form class="text-faded mb-4 survey_input" action="#results" method="post">
              <input type="radio" name="gender" value="boy"> Boy<br>
              <input type="radio" name="gender" value="girl"> Girl<br>
              <br><br>
              <input type="text" name="babyname" placeholder="Enter name">
              <input type="submit" value="Submit">
              </form>
              
              <?php
              //check if inputs are not empty
              if ((isset($_POST['gender'])) && (isset($_POST['babyname'])) &&(strlen($_POST['babyname']) > 0) && ($_POST['babyname'] != " ")){
                  $gender = $_POST['gender'];
                  $name = $_POST['babyname'];
                    
                  //enter submitted data into table
                  $sql = "insert into SURVEY (name, gender) VALUES ('".$name."','".$gender."')";
                  mysqli_query($db,$sql);
              }
              ?>              
          </div>
        </div>
      </div>
    </section>
      
    <!-- Results -->      
    <section id="results">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 text-center">
            <h2 class="section-heading text-white">Survey Results</h2>
            <hr class="light my-4">
            <?php
            //get results from sql table
            $query = "SELECT name, gender, count(*) FROM SURVEY GROUP BY name, gender ORDER BY count(*) DESC";
            $result = mysqli_query($db,$query);
            
            //print out results to the web page
            echo "<table><tr><th>Name</th><th>Gender</th><th>Count</th>";
            while ($row = mysqli_fetch_array($result)){
                echo "<tr><td>" .$row['name']. "</td><td>" .$row['gender']. "</td><td>" .$row['count(*)']."</td></tr>";
            }
            echo "</table>";
            ?>
          </div>
        </div>
      </div> 
    </section>
      
    <!-- Back to Top -->
    <div>
    <a class="text-white back_to_top nav-link js-scroll-trigger" href="#page-top">Back to Top</a>
    </div>
      
    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="vendor/scrollreveal/scrollreveal.min.js"></script>
    <script src="vendor/magnific-popup/jquery.magnific-popup.min.js"></script>

    <!-- Custom scripts for this template -->
    <script src="js/creative.min.js"></script>

  </body>

</html>