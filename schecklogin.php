<?php
ini_set ("display_errors", "1");
error_reporting(E_ALL);

ob_start();
session_start();
include "dbconnect.php";


// Defining your login details into variables
// username and password sent from form
$fid=$_POST['fid'];
$fpass=$_POST['fpass'];
// To protect MySQL injection (more detail about MySQL injection)
$fid = stripslashes($fid);
$fpass = stripslashes($fpass);
$fid = mysqli_real_escape_string($dbc,$fid);
$fpass = mysqli_real_escape_string($dbc,$fpass);
$sql="SELECT * FROM staff WHERE sid='$fid' and spass='$fpass'";
$result=mysqli_query($dbc,$sql) or die(mysqli_error());

      
// Checking table row
$count=mysqli_num_rows($result);
// If username and password is a match, the count will be 1

if($count==1){
// If everything checks out, you will now be forwarded to menu.php
$user = mysqli_fetch_assoc($result);
$_SESSION['sid'] = $user['sid'];
header("location:sprofile.php");
}
//If the username or password is wrong, you will receive this message below.
else {
print'<script> alert("Wrong ID or Password");</script>';
print'<script> window.location.assign("slogin.php");</script>';
}

ob_end_flush();

?>

<html> <head></head>
<body>
  <div id="footer"></div>
</body>
</html>