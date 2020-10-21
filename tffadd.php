<?php
session_start();
//If your session isn't valid, it returns you to the login screen for protection
if(empty($_SESSION['tid'])){
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

<script>
function validateForm(){
  
    if (document.forms["form1"]["fname"].value == "")
    {
     alert ("Please enter title");
     return false;
    
    }

    if (document.forms["form1"]["fileToUpload"].value == "")
    {
     alert ("Please attach a file");
     return false;
    
    }

    if (document.getElementById('fileToUpload').files[0].size > 8000000)
    {
       alert ("This file exceeded 8MB");
       return false;
    }  
}


</script>

     <div class="w3-sidebar w3-display-left w3-light-grey w3-bar-block" style="width:25%">
  <h3 class="w3-bar-item">Menu</h3>
  <a href="tprofile.php" class="w3-bar-item w3-button">Home</a>
  <a href="tffadd.php" class="w3-bar-item w3-button">Create New Form</a>
  <a href="tlist.php" class="w3-bar-item w3-button">My Request List</a>
  <a href="tlista.php" class="w3-bar-item w3-button">My Approval List</a>
  <a href="tlistr.php" class="w3-bar-item w3-button">My Review List</a>
   <a href="tlistall.php" class="w3-bar-item w3-button">All Request List</a>
    <a href="logout.php" class="w3-bar-item w3-button">Logout</a>
</div>

<div style="margin-left:25%" align="center">

<div class="w3-container w3-dark-gray" width="100">
  <center><h1>CREATE FORM</h1></center>
</div>

<!--<img src="img_car.jpg" alt="Car" style="width:100%">-->

<div class="w3-container w3-lobster">
  <center><p class="w3-xxxlarge">Form details</p></center>
</div>

</div>
<div id="page" style="margin-left:25%" align="center">
<div id="container" style="margin-left:0%" align="center">
<center><p style="margin-left:50%"><center><a href=" tffadd1.php?id=Under" class="w3-btn w3-teal">Under RM10k</a></center></p>
<p style="margin-left:50%"><center><a href=" tffadd1.php?id=In" class="w3-btn w3-teal">RM10k - RM100k</a></center></p>
<p style="margin-left:50%"><center><a href=" tffadd1.php?id=Above" class="w3-btn w3-teal">Above RM100k</a></center></p></center>
<hr>
</div>
<div id="footer">

</div>
</body></html>