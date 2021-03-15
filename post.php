<!-- 
  Name: Geoffrey Belcher
  Assignment 2: to create functionality with the index.php page and post.php page.
  Course: CSCI 2170
  Date: 2020-10-19
  Description: This file represents the post page of the site. Read framework.txt for a detailed
              summary of the file.
-->

<?php

include 'serverLogin.php';

$loginError = "";

if (isset($_POST) and !count($_POST) == 0) {

  if (isset($_SESSION) and !count($_SESSION) == 0) {

    $sql = "INSERT INTO comments (UserID,PostID,Comment) VALUES (?, ?, ?);";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iis", $_SESSION['UserID'], $_GET['post_ID'], $_POST['comment']);
    $stmt->execute();

  } else {

    $loginError = "Please login to post a comment.";

  }

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
  <title>Post</title>

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

  <!-- Page Header PHP Code -->
  <?php

  // Get the data for the page from the GET variable.
  $post_ID = $_GET['post_ID'];
  $user_name = $_GET['user_name'];
  $post_image = $_GET['post_image'];
  $post = $_GET['post'];
  $date = $_GET['date'];

  // Print the post info to the post header.
  echo "<header class=\"masthead\" style=\"background-image: url('img/" . $post_image . "')\">
      <div class=\"overlay\"></div>
      <div class=\"container\">
        <div class=\"row\">
          <div class=\"col-lg-8 col-md-10 mx-auto\">
            <div class=\"post-heading\">
              <h3 class=\"post-subtitle\">" . $post . "</h3>
              <span class=\"meta\">Posted by <a href=\"about.php\">" . $user_name . "</a> on " . date("F d, Y g:ia", strtotime($date)) . "</span>
              </div>
            </div>
          </div>
        </div>
      </header>";

  ?>

  <!-- Post Content -->
  <article>
    <div class="container">
      <div class="card my-4">
        <h5 class="card-header">Leave a Comment: <?php echo $loginError ?></h5>
        <div class="card-body">
          <!-- Add comment form -->
          <form method="POST" action="#">
            <div class="form-group">
              <textarea class="form-control" rows="3" name="comment"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
        </div>
      </div>

      <?php

      $sql = "SELECT * FROM comments WHERE PostID=? ORDER BY date DESC;";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("i", $_GET['post_ID']);
      $stmt->execute();
      $result = $stmt->get_result(); // get the result

      while ($row = $result->fetch_assoc()) {

        $sql = "SELECT Name from users WHERE UserID =?";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $row['UserID']);
        $stmt->execute();
        $result2 = $stmt->get_result()->fetch_assoc(); // get the result
        $name = $result2['Name'];

        echo "<!-- Single Comment Taken From: https://startbootstrap.com/templates/blog-post/ -->
          <div class=\"media mb-4\">
            <img class=\"d-flex mr-3 rounded-circle\" src=\"http://placehold.it/50x50\" alt=\"\">
            <div class=\"media-body\">
              <h5 class=\"mt-0\">Date: " . date("F d, Y g:ia", strtotime($row['Date'])) .
          " Author: " . $name .
          "</h5>" .
          $row['Comment'] .
          "</div>
          </div>";
      }

      ?>

    </div>
    </div>
  </article>

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