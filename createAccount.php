<!-- 
  Name: Geoffrey Belcher
  Assignment 5
  Course: CSCI 2170
  Date: 2020-12-08
  Description: This file represents the createaccount page of the site. Read framework.txt for a detailed
              summary of the file.
-->

<?php include 'header.php'; ?>
<?php include 'serverlogin.php'; ?>
<?php

$error_string = array();

if (isset($_POST) and !count($_POST) == 0) {

    $password_not_valid = false;

    // Does password have at least 7 characters.
    if (!preg_match("/.{7,}/", $_POST['password'])) {
        $password_not_valid = true;
        $error_string[] = "- at least 7 characters long.";
    }

    // Does password have at least one digit.
    if (!preg_match("/\d/", $_POST['password'])) {
        $password_not_valid = true;
        $error_string[] = "- one digit.";
    }

    // Does password have at least one capital letter.
    if (!preg_match("/[A-Z]/", $_POST['password'])) {
        $password_not_valid = true;
        $error_string[] = "- one capital letter";
    }

    // Does password have at least one special character.
    if (!preg_match("/[^A-Za-z0-9]/", $_POST['password'])) {
        $password_not_valid = true;
        $error_string[] = "- one special character";
    }

    if (!$password_not_valid) {

        $sql = "SELECT Username FROM login WHERE Username=?";
        $username = $_POST['username'];

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc(); // get the result

        if (sizeof((array) $result) == 0) {

            $sql = "INSERT INTO users (Name, About, AboutImage) VALUES (?, ?, ?);";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sss", $_POST['name'], $_POST['bio'], $_POST['image']);
            if (!$stmt->execute()) {
                echo "Error creating user.";
                die();
            }

            $UserID = $stmt->insert_id;

            $sql = "INSERT INTO login (UserID, Username, Password) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $hashed_password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $stmt->bind_param("iss", $UserID, $_POST['username'], $hashed_password);
            if (!$stmt->execute()) {
                echo "Error creating login.";
                die();
            }

            $_SESSION = array();
            $_SESSION['loggedin'] = true;
            $_SESSION['UserID'] = $UserID;

            header("Location: index.php");
        } else {

            $error_string = "Username already exists.";
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
    <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
        <div class="container">
            <span class="navbar-brand">picturegram</span>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                Menu
                <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="about.php">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="post.php">Add Post</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Page Header -->
    <header class="masthead" style="background-image: url('img/logo.jpg')">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-10 mx-auto">
                    <div class="page-heading">
                        <h1>picturegram</h1>
                        <h2>CREATE ACCOUNT</h2>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                <form action="createAccount.php#" method="POST" name="sentMessage" id="contactForm">
                    <div class="control-group">
                        <div class="form-group floating-label-form-group controls">
                            <label>Name</label>
                            <input type="text" class="form-control" placeholder="Full Name" name="name" id="name" required data-validation-required-message="Please enter your name.">
                            <p class="help-block text-danger"></p>
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="form-group floating-label-form-group controls">
                            <label>Tell us about you</label>
                            <input type="textarea" class="form-control" placeholder="Bio" name="bio" id="bio" required data-validation-required-message="Please enter a biography.">
                            <p class="help-block text-danger"></p>
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="form-group floating-label-form-group controls">
                            <label>Image</label>
                            <input type="text" class="form-control" placeholder="Image" name="image" id="image" required data-validation-required-message="Please enter an image name.">
                            <p class="help-block text-danger"></p>
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="form-group floating-label-form-group controls">
                            <label>Username</label>
                            <input type="text" class="form-control" placeholder="Username" name="username" id="username" required data-validation-required-message="Please enter a username">
                            <p class="help-block text-danger"></p>
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="form-group floating-label-form-group controls">
                            <label>Password</label>
                            <input type="password" class="form-control" placeholder="Password" name="password" id="password" required data-validation-required-message="Please enter a password">
                            <p class="help-block text-danger"></p>
                        </div>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary" id="sendMessageButton">Create account</button>
                    <?php
                    // Print errors.
                    if ($password_not_valid) {
                        echo "<br>";
                        echo "PASSWORD ERROR:";
                        echo "<br>";
                        foreach ($error_string as $error) {
                            echo $error . "<br>";
                        }
                        echo "Please try again!";
                    }

                    ?>
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

    <!-- Custom scripts for this template -->
    <script src="js/clean-blog.min.js"></script>

</body>

</html>