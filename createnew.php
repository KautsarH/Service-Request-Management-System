<?php
session_start();
//If your session isn't valid, it returns you to the login screen for protection
if(empty($_SESSION['aid'])){
 Print '<script>alert("ACCESS DENIED. PLEASE LOGIN");</script>';
  Print '<script>window.location.assign("index.html");</script>';
} 

include "dbconnect.php";

?>

<html>
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lobster">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Allerta+Stencil">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>  
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<body class="w3-container w3-pale-blue">
<style>
.w3-lobster {
    font-family: "Lobster", serif;
}

</style>



     <div class="w3-sidebar w3-display-left w3-light-grey w3-bar-block" style="width:25%">
  <h3 class="w3-bar-item">Menu</h3>
  <a href="aprofile.php" class="w3-bar-item w3-button">Home</a>
  <a href="aliststaff.php" class="w3-bar-item w3-button">Staff List</a>
   <a href="alistmanager.php" class="w3-bar-item w3-button">Manager List</a>
   <a href="alisttopm.php" class="w3-bar-item w3-button">Top Management List</a>
   <a href="alistexec.php" class="w3-bar-item w3-button">Executive List</a>
   <a href="createnew.php" class="w3-bar-item w3-button">Create New User</a>
   <a href="areport.php" class="w3-bar-item w3-button">Report</a>
    <a href="logout.php" class="w3-bar-item w3-button">Logout</a>

</div>

<div style="margin-left:25%" align="center">

<div class="w3-container w3-dark-gray" width="100">
  <center><h1>CREATE NEW USER</h1></center>
</div>

<!--<img src="img_car.jpg" alt="Car" style="width:100%">-->

<div class="w3-container w3-lobster">
  <p></p>
  <center><p class="w3-xxxlarge">New User</p></center>
</div>

</div>
<div id="page" style="margin-left:25%" align="center">
<div id="container" style="margin-left:0%" align="center">
<p ><center><a href=" afsadd.php" class="w3-btn w3-teal">Staff</a></center></p>
<p style="margin-left:50%"><center><a href=" afmadd.php" class="w3-btn w3-teal">Manager</a></center></p>
<p style="margin-left:50%"><center><a href=" aftadd.php" class="w3-btn w3-teal">Top Manager</a></center></p>
<p style="margin-left:50%"><center><a href=" afeadd.php" class="w3-btn w3-teal">Executive</a></center></p>
</div>
</div>
<hr>
<div id="footer">

</div>
</body></html>