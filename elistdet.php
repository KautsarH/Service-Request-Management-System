<?php

include "dbconnect.php";

session_start();
//If your session isn't valid, it returns you to the login screen for protection
if(empty($_SESSION['eid'])){
 Print '<script>alert("ACCESS DENIED. PLEASE LOGIN");</script>';
  Print '<script>window.location.assign("index.html");</script>';
} 

$id = $_GET['id'];

$check1= "SELECT * from form  where did='$id'";
$check = mysqli_query($dbc, $check1);
$c = mysqli_fetch_array($check);
if ($c)
{
$did = $c['did'];
$dname = $c['dname'];
$dstats = $c['dstats'];
$dbget = $c['dbget'];
$ddesc = $c['ddesc'];
$total =$c['dtot'];
$mode =$c['dmode'];
$payto =$c['dpto'];
$addr =$c['daddr'];
$dcomm = $c['dcomm'];
$ddate= $c['ddate'];
$name = $c['name'];
$size = $c['size'];
$type = $c['type'];
$location = $c['location'];}

if ( $c['sid_fk'] != null)
{
     $sql1 = "SELECT * from form f , staff s where f.did='$id' and s.sid = f.sid_fk";
     $result1 = mysqli_query($dbc, $sql1);
     $row1 = mysqli_fetch_array($result1);
     if($row1)
     {
     $semail = $row1['semail'];}
}
if ( $c['mid_fk'] != null){
 
  $sql2 = "SELECT * from form f , manager m where f.did='$id' and  m.mid = f.mid_fk";
     $result2 = mysqli_query($dbc, $sql2);
     $row2 = mysqli_fetch_assoc($result2);
     if($row2)
     {
     $memail = $row2['memail'];}
}

 if ($c['tid_fk'] != null){
   $sql3 = "SELECT * from form f , topm t where f.did='$id' and t.tid =f.tid_fk";
     $result3 = mysqli_query($dbc, $sql3);
     $row3 = mysqli_fetch_assoc($result3);
     if($row3)
     {
     $temail = $row3['temail'];}

}


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
  <a href="eprofile.php" class="w3-bar-item w3-button">Home</a>
  <a href="elist.php" class="w3-bar-item w3-button">My Approval List</a>
   <a href="elistall.php" class="w3-bar-item w3-button">All Request List</a>
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
<div id="footer">
<tr>
    <td>Payable For:</td>
    <td><?php echo $dname; ?></td>
</tr>
<tr>
    <td>Status:</td>
    <td ><?php echo $dstats; ?></td>
</tr>
<tr>
    <td>Estimated Budget:</td>
    <td ><?php echo $dbget; ?></td>
</tr>
<tr>
    <td>Total Amount (RM):</td>
    <td ><?php echo $total; ?></td>
</tr>
<tr>
    <td>Payable Mode:</td>
    <td ><?php echo $mode; ?></td>
</tr>
<tr>
    <td>Payable To:</td>
    <td ><div class="box" ><?php echo $payto; ?></div></td>
</tr>
<tr>
    <td>Address:</td>
    <td ><div class="box" ><?php echo $addr; ?></div></td>
</tr>
<tr>
    <td>Remarks:</td>
    <td><div class="box" ><?php echo $ddesc; ?> </div></td>
</tr>
<tr>
    <td>Date Created:</td>
    <td><div class="box" ><?php echo $ddate; ?></div></td>
</tr>

<?php 
  if($c['sid_fk'] != null && $c['mid_fk'] != null && $c['tid_fk'] == null && $c['exec'] == null)
  { ?>
    
  <tr>
    <td>Created by:</td>
    <td><?php echo $semail; ?></td>
  </tr>
  <tr>
    <td>Approver:</td>
    <td><?php echo $memail; ?></td>
  </tr>

<?php } else if ( $c['sid_fk'] != null && $c['mid_fk'] != null && $c['tid_fk'] != null && $c['exec'] == null) {?>

  <tr>
    <td>Created by:</td>
    <td><?php echo $semail; ?></td>
  </tr>
  <tr>
    <td>Reviewer (Manager):</td>
    <td><?php echo $memail; ?></td>
  </tr>
  <tr>
    <td>Approver:</td>
    <td><?php echo $temail; ?></td>
  </tr>

 <?php } else if ( $c['sid_fk'] != null && $c['mid_fk'] != null && $c['tid_fk'] != null && $c['exec'] != null) {?>

   <tr>
    <td>Created by:</td>
    <td><?php echo $semail; ?></td>
  </tr>
  <tr>
    <td>Reviewer (Manager):</td>
    <td><?php echo $memail; ?></td>
  </tr>
  <tr>
    <td>Reviewer (TM):</td>
    <td><?php echo $temail; ?></td>
  </tr>
  <tr>
    <td>Approver:</td>
    <td>Executive Team</td>
  </tr>


 <?php } else if ( $c['sid_fk'] == null && $c['mid_fk'] != null && $c['tid_fk'] != null && $c['exec'] == null) {?>

  <tr>
    <td>Created by:</td>
    <td><?php echo $memail; ?></td>
  </tr>
  <tr>
    <td>Approver:</td>
    <td><?php echo $temail; ?></td>
  </tr>
  

 <?php } else if ( $c['sid_fk'] == null && $c['mid_fk'] != null && $c['tid_fk'] != null && $c['exec'] != null) {?>
  <tr>
    <td>Created by:</td>
    <td><?php echo $memail; ?></td>
  </tr>
  <tr>
    <td>Reviewer (TM):</td>
    <td><?php echo $temail; ?></td>
  </tr>
  <tr>
    <td>Approver:</td>
    <td>Executive Team</td>
  </tr>


 <?php } else  {?>
   <tr>
      <td>Created by:</td>
      <td><?php echo $temail; ?></td>
    </tr>
    <tr>
      <td>Approver:</td>
      <td>Executive Team</td>
    </tr>

  <?php } ?>

<tr>
    <td>Attachment:</td>
    <td><a href="<?php echo $location; ?>">View</a></td>
</tr>

<tr>
    <td>Name of file:</td>
    <td><?php echo $name; ?></td>
</tr>
<tr>
    <td>Type of file:</td>
    <td><?php echo $type; ?></td>
</tr>
<tr>
    <td>Size of file:</td>
    <td><?php echo $size; echo " bytes" ; ?></td>
</tr>
</table>
</div>

<hr>

<div id="footer">c
</div>

</body></html>