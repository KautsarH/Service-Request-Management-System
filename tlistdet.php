<?php

include "dbconnect.php";

session_start();
//If your session isn't valid, it returns you to the login screen for protection
if(empty($_SESSION['tid'])){
 Print '<script>alert("ACCESS DENIED. PLEASE LOGIN");</script>';
  Print '<script>window.location.assign("index.html");</script>';
} 

$id = $_GET['id'];

     $sql = "SELECT * from form f, topm t where f.did='$id' and f.sid_fk is null and f.mid_fk is null and f.exec is not null";
     $result = mysqli_query($dbc, $sql);
     $row = mysqli_fetch_assoc($result);

?>

<html>

<body class="w3-container w3-pale-blue">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lobster">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Allerta+Stencil">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>  
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
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

.box2{
  overflow: auto;
  width: auto;
  max-height: 500px;
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
  <center><h1>REQUEST LIST</h1></center>
</div>

<!--<img src="img_car.jpg" alt="Car" style="width:100%">-->

<div class="w3-container w3-lobster">
  <center><p class="w3-xxxlarge">Request details</p></center>
</div>

</div>

<div class="box2">
<table id="list" style="margin-left:30%" >
<tr>
    <td>Payable For:</td>
    <td><div class="box" ><?php echo $row['dname']; ?></div></td>
</tr>
<tr>
    <td>Status:</td>
    <td ><?php echo $row['dstats']; ?></td>
</tr>
<tr>
    <td>Estimated Budget:</td>
    <td ><?php echo $row['dbget']; ?></td>
</tr>
<tr>
    <td>Total Amount (RM):</td>
    <td ><?php echo $row['dtot']; ?></td>
</tr>
<tr>
    <td>Payable Mode:</td>
    <td ><?php echo $row['dmode']; ?></td>
</tr>
<tr>
    <td>Payable To:</td>
    <td ><div class="box" ><?php echo $row['dpto']; ?></div></td>
</tr>
<tr>
    <td>Address:</td>
    <td ><div class="box" ><?php echo $row['daddr']; ?></div></td>
</tr>
<tr>
    <td>Remarks:</td>
    <td><div class="box" ><?php echo $row['ddesc']; ?> </div></td>
</tr>
<tr>
    <td>Comment:</td>
    <td><?php echo $row['dcomm']; ?></td>
</tr>

<tr>
    <td>Date Created:</td>
    <td><div class="box" ><?php echo $row['ddate']; ?></div></td>
</tr>
<tr>
    <td>Created by:</td>
    <td><?php echo $row['temail']; ?></td>
</tr>
<tr>
    <td>Approver:</td>
    <td>Executive Team</td>
</tr>

<tr>
    <td>Attachment:</td>
    <td><a href="<?php echo $row['location'] ?>">View</a></td>
</tr>

<tr>
    <td>Name of file:</td>
    <td><?php echo $row['name']; ?></td>
</tr>
<tr>
    <td>Type of file:</td>
    <td><?php echo $row['type']; ?></td>
</tr>
<tr>
    <td>Size of file:</td>
    <td><?php echo $row['size']; echo " bytes" ; ?></td>
</tr>

</table>
</div>

<hr>

<div id="footer">
</div>

</body></html>