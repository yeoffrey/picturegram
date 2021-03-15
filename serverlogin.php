<!-- 
  Name: Geoffrey Belcher
  Assignment 5
  Course: CSCI 2170
  Date: 2020-12-08
  Description: This file represents back end server login of the site. Read framework.txt for a detailed
              summary of the file.
-->

<?php

    require_once 'serverlogin.php';

    $db_hostname = 'localhost';
    $db_database = 'picturegram';
    $db_username = 'root';
    $db_password = 'root';

    $conn = new mysqli($db_hostname, $db_username, $db_password, $db_database);

    if($conn->connect_error) die("Connction error with \n" . $db_hostname . " " . $db_database . " " . $db_username . " " . $db_password . "\n" . mysqli_connect_error());

?>