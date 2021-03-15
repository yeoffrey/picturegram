<!-- 
  Name: Geoffrey Belcher
  Assignment 5
  Course: CSCI 2170
  Date: 2020-12-08
  Description: This file represents the logout script of the site. Read framework.txt for a detailed
              summary of the file.
-->

<?php include 'header.php'; ?>
<?php 

    $_SESSION= array();

    header("Location: index.php");

?>