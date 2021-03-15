<!-- 
  Name: Geoffrey Belcher
  Assignment 5
  Course: CSCI 2170
  Date: 2020-12-08
  Description: This file represents the login page of the site. Read framework.txt for a detailed
              summary of the file.
-->

<?php include 'header.php'; ?>
<?php

include 'serverlogin.php';

$username = $password = "";
$usernameStatus = $passwordStatus = "";
$usernameError = "";
$passwordError = "";

if (isset($_POST) and !count($_POST) == 0) {

  // Check if username exists.
  if (empty(trim($_POST['username']))) {

    $usernameStatus = "Please enter a username";

  } else {

    $username = trim($_POST['username']);

  }

  // Check if password exists.
  if (empty(trim($_POST['password']))) {

    $passwordStatus = "Please enter a password";

  } else {

    $password = trim($_POST['password']);

  }

  if (empty($usernameStatus) && empty($passwordStatus)) {

    $sql = "SELECT UserID, Username, Password from login WHERE username =?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result(); // get the result

    if ($result) {

      if (mysqli_num_rows($result) == 1) {

        $row = $result->fetch_assoc();

        if ($row['Password'] == $password) {

          session_start();

          $_SESSION['loggedin'] = true;
          $_SESSION['UserID'] = $row['UserID'];

          header("Location: index.php");

        } else {

          $passwordError = "Sorry password is incorrect, please try again.";

        }

      } else {

        $usernameError = "Username is incorrect, please try again.";

      }

    } else {

      echo "sql result didn't work.";

    }

  }

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
  <title>Login</title>

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
          <div class="page-heading">
            <h1>picturegram</h1>
            <h2>LOGIN TO YOUR ACCOUNT</h2>
          </div>
        </div>
      </div>
    </div>
  </header>

  <!-- Main Content -->
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-10 mx-auto">
        <!-- Contact Form - Enter your email address on line 19 of the mail/contact_me.php file to make this form work. -->
        <!-- WARNING: Some web hosts do not allow emails to be sent through forms to common mail hosts like Gmail or Yahoo. It's recommended that you use a private domain email address! -->
        <!-- To use the contact form, your site must be on a live web host with PHP! The form will not work locally! -->
        <form method="POST" action="#">
          <div class="control-group">
            <div class="form-group floating-label-form-group controls">
              <label>UserName</label>
              <input type="text" class="form-control" placeholder="UserName" name="username" id="name" required data-validation-required-message="Please enter your name.">
              <p class="help-block text-danger"></p>
            </div>
          </div>
          <div class="control-group">
            <div class="form-group floating-label-form-group controls">
              <label>Password</label>
              <input type="password" class="form-control" placeholder="Password" name="password" id="password" required data-validation-required-message="Please enter a password.">
              <p class="help-block text-danger"></p>
            </div>
          </div>
          <br>
          <button type="submit" class="btn btn-primary">Login</button>
          <?php echo $usernameError;
              echo $passwordError;
          ?>
        </form>
        <form action="createAccount.php">
          <p>If you don't have an account, create one.</p>
          <button type="submit" class="btn btn-primary" id="sendMessageButton">Create account</button>
        </form>
      </div>
    </div>
  </div>

  <hr>

  <!-- Footer -->
  <?php include 'footer.php'; ?>

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Contact Form JavaScript -->
  <script src="js/jqBootstrapValidation.js"></script>
  <script src="js/contact_me.js"></script>

  <!-- Custom scripts for this template -->
  <script src="js/clean-blog.min.js"></script>

</body>

</html>