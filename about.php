<!-- 
  Name: Geoffrey Belcher
  Assignment 5
  Course: CSCI 2170
  Date: 2020-12-08
  Description: This file represents the about page of the site. Read framework.txt for a detailed
              summary of the file.
-->
<?php include 'header.php'; ?>
<?php include 'serverlogin.php'; ?>
<!DOCTYPE html>
<html lang="en">

<!-- Header -->

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <!-- Title -->
  <title>About</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom fonts for this template -->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href='https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>

  <!-- Custom styles for this template -->
  <link href="css/clean-blog.min.css" rel="stylesheet">

</head>

<body>

  <!-- Navigation -->
  <?php include 'navigation.php'; ?>
  <?php

  //Stateless values
  $name = "About Me";
  $about = "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe nostrum ullam eveniet pariatur voluptates odit, fuga atque ea nobis sit soluta odio, adipisci quas excepturi maxime quae totam ducimus consectetur?
        
        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eius praesentium recusandae illo eaque architecto error, repellendus iusto reprehenderit, doloribus, minus sunt. Numquam at quae voluptatum in officia voluptas voluptatibus, minus!
        
        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aut consequuntur magnam, excepturi aliquid ex itaque esse est vero natus quae optio aperiam soluta voluptatibus corporis atque iste neque sit tempora!";
  $image = "dal-about.jpg";

  //Check if the get variable is set.
  if (isset($_GET) && !count($_GET) == 0) {

    $name = $_GET['Username'];
    $about = $_GET['About'];
    $image = $_GET['AboutImage'];
  } else {

    if (isset($_SESSION) && !count($_SESSION) == 0) {

      if ($_SESSION['loggedin'] == true) {

        $sql = "SELECT Name, About, AboutImage from users WHERE UserID =?";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $_SESSION['UserID']);
        $stmt->execute();
        $result = $stmt->get_result(); // get the result
        $row = $result->fetch_assoc();

        $name = $row['Name'];
        $about = $row['About'];
        $image = $row['AboutImage'];
      }
    }
  }

  ?>

  <!-- Page Header -->
  <?php echo "<header class=\"masthead\" style=\"background-image: url('img/" . $image . "')\">"; ?>

  <div class="overlay"></div>
  <div class="container">
    <div class="row">

      <div class="col-lg-8 col-md-10 mx-auto">
        <div class="page-heading">
          <?php echo "<h1>" . $name . "</h1>"; ?>
          <span class="subheading">This is what I do.</span>
        </div>
      </div>
    </div>
  </div>
  </header>

  <!-- Main Content -->
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-10 mx-auto">
        <?php echo "<p>" . $about . "</p>"; ?>
      </div>
    </div>
  </div>

  <hr>

  <!-- Footer -->
  <?php include 'footer.php'; ?>

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Custom scripts for this template -->
  <script src="js/clean-blog.min.js"></script>

</body>

</html>