<!-- 
  Name: Geoffrey Belcher
  Assignment 5
  Course: CSCI 2170
  Date: 2020-12-08
  Description: This file represents the home page of the site. Read framework.txt for a detailed
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
            <h1>picturegram</h1>
            <span class="subheading">Your life in pictures</span>
          </div>
        </div>
      </div>
    </div>
  </header>

  <!-- Main Content -->
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-10 mx-auto">
        <?php

        $sql = "SELECT * FROM `posts` ORDER BY date DESC";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();

        while ($row = $result->fetch_assoc()) {

          // Fetch data from Array.
          $post_ID = $row['PostID'];
          $post_image = $row['PostImage'];
          $post = $row['Post'];
          $date = $row['Date'];

          $user_ID = $row['UserID'];

          $sql = "SELECT Name, About, AboutImage FROM users WHERE UserID=?";
          $stmt = $conn->prepare($sql);
          $stmt->bind_param("i", $user_ID);
          $stmt->execute();
          $result2 = $stmt->get_result()->fetch_assoc();
          $user_name = $result2['Name'];
          $About = $result2['About'];
          $AboutImage = $result2['AboutImage'];

          // Output of the post HTML with the variables defined above.
          echo "<div class=\"post-preview\">
              <a href=\"post.php?" .
            "post_ID=" . $post_ID .
            "&user_ID=" . $user_ID .
            "&user_name=" . $user_name .
            "&post_image=" . $post_image .
            "&post=" . $post .
            "&date=" . $date . "\">
                <img src=\"img/" . $post_image . "\" class=\"img-fluid\" alt=\"\" style=\"width:720px;height:380px\">
                <h3 class=\"post-subtitle\">" . $post . "</h3>
                </a>
                <p class=\"post-meta\">Posted by
                  <a href=\"about.php?" . 
                  "&About=" . $About .
                  "&AboutImage=" . $AboutImage .
                  "&Username=" . $user_name . "\">" . $user_name . "</a> on " . date("F d, Y g:ia", strtotime($date)) . "</p>
                  </div>";
        }

        ?>

        <!-- Pager -->
        <div class="clearfix">
          <a class="btn btn-primary float-right" href="#">Older Posts &rarr;</a>
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