<!-- 
  Name: Geoffrey Belcher
  Assignment 5
  Course: CSCI 2170
  Date: 2020-12-08
  Description: This file represents the add post page of the site. Read framework.txt for a detailed
              summary of the file.
-->

<?php include 'header.php'; ?>
<?php include 'serverlogin.php'; 

if (isset($_POST) and !count($_POST) == 0) {

  $sql = "INSERT INTO posts (UserID, PostImage, Post) VALUES (?, ?, ?);";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("iss", $_SESSION['UserID'], $_POST['image-file-name'], $_POST['post']);
  $stmt->execute();

  $_POST = array();

}

?>
<!DOCTYPE html>
<html lang="en">

<!-- Header -->

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <!-- Title -->
  <title>Picturegram</title>

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

  <!-- Page Header -->
  <header class="masthead" style="background-image: url('img/logo.jpg')">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <div class="site-heading">
            <!-- Name of the site -->
            <h1>picturegram</h1>
            <h2 class="subheading">ADD NEW POST</h2>
          </div>
        </div>
      </div>
    </div>
  </header>

  <!-- Main Content -->
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-10 mx-auto">
        <div class="card my-4">
          <h5 class="card-header">Add a Post:</h5>
          <div class="card-body">
            <!-- Add comment form -->
            <form method="POST" action="#">
              <div class="form-group">
                Post:
                <textarea class="form-control" rows="3" name="post"></textarea>
                Image Filename:
                <textarea class="form-control" rows="1" name="image-file-name"></textarea>
              </div>
              <button type="submit" class="btn btn-primary">Submit</button>
            </form>
          </div>
        </div>
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