<!-- 
  Name: Geoffrey Belcher
  Assignment 5
  Course: CSCI 2170
  Date: 2020-12-08
  Description: This file represents the navigation part of the site. Read framework.txt for a detailed
              summary of the file.
-->

<?php

$name = "picturegram";
$session_page = "Login";
$session_link = "login.php";

if (isset($_SESSION) && !count($_SESSION) == 0) {

    if ($_SESSION['loggedin'] == true) {

        $sql = "SELECT Name from users WHERE UserID =?";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $_SESSION['UserID']);
        $stmt->execute();
        $result = $stmt->get_result(); // get the result

        $row = $result->fetch_assoc();

        $name = $row['Name'];
        $session_page = "Logout";
        $session_link = "logout.php";
        
    }
}

?>

<nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
    <div class="container">
        <!-- Name of the profile -->
        <?php echo '<a class="navbar-brand" href="about.php">' . $name . '</a>'; ?>

        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            Menu
            <i class="fas fa-bars"></i>
        </button>
        <!-- Links -->
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="about.php">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="addPost.php">Add Post</a>
                </li>
                <?php

                        echo "<li class=\"nav-item\">
                        <a class=\"nav-link\" href=\"" . $session_link . "\">" . $session_page . "</a>
                        </li>";

                ?>

            </ul>
        </div>
    </div>
</nav>