<?php
    session_start();
//If your session isn't valid, it returns you to the login screen for protection
if(empty($_SESSION['aid'])){
 Print '<script>alert("ACCESS DENIED. PLEASE LOGIN");</script>';
  Print '<script>window.location.assign("index.html");</script>';
} 

include "dbconnect.php";
$id = $_GET['id'];

     $sql = "select * from staff where sid='$id'";
     $result = mysqli_query($dbc, $sql);
     $row = mysqli_fetch_assoc($result);

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lobster">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Allerta+Stencil">
<body class="w3-container w3-pale-blue">
<style>
.w3-lobster {
    font-family: "Lobster", serif;
}

#list{
    font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
    border-collapse: collapse;
    width: 60%;
}

#list td, #list th {
    border: 1px solid #ddd;
    padding: 8px;
}

#list tr:nth-child(even){background-color: #f2f2f2;}

#list tr:hover {background-color: #ddd;}

#list th {
    padding-top: 10px;
    padding-bottom: 10px;
    text-align: left;
    background-color: #4CAF50;
    color: white;
}

.box{
  overflow: auto;
  width: auto;
  max-height: 60px;
  border: none;
  padding: 5px;

}

::-webkit-scrollbar {
width: 10px;
height: 10px;
}

::-webkit-scrollbar-track {
background: #f5f5f5;
border-radius: 10px;
}

::-webkit-scrollbar-thumb {
border-radius: 10px;
background: #ccc;  
}

::-webkit-scrollbar-thumb:hover {
background: #999;  
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
  <center><h1>STAFF DETAILS</h1></center>
</div>

<!--<img src="img_car.jpg" alt="Car" style="width:100%">-->

<div class="w3-container w3-lobster">
  <center><p class="w3-xxxlarge">Staff details</p></center>
</div>

</div>


<table id="list" style="margin-left:30%" >
  <tr>
    <td>ID:</td>
    <td><?php echo $row['sid']; ?></td>
</tr>
<tr>
    <td>Name:</td>
    <td><?php echo $row['sname']; ?></td>
</tr>
<tr>
    <td>Password:</td>
    <td ><?php echo $row['spass']; ?></td>
</tr>
<tr>
    <td>Email:</td>
    <td><div class="box" ><?php echo $row['semail']; ?> </div></td>
</tr>
<tr>
    <td>Position:</td>
    <td><?php echo $row['sposit']; ?></td>
</tr>

</table>

<hr>

<div id="footer">
</div>

</body></html>