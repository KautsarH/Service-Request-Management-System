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
$sql="SELECT * FROM admin WHERE aid='$fid' and apass='$fpass'";
$result=mysqli_query($dbc,$sql) or die(mysqli_error());

      
// Checking table row
$count=mysqli_num_rows($result);
// If username and password is a match, the count will be 1

if($count==1){
// If everything checks out, you will now be forwarded to menu.php
$user = mysqli_fetch_assoc($result);
$_SESSION['aid'] = $user['aid'];
header("location:aprofile.php");
}
//If the username or password is wrong, you will receive this message below.
else {
print'<script> alert("Wrong ID or Password");</script>';
	print'<script> window.location.assign("achecklogin.php"));</script>';
}

ob_end_flush();

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Manager Login</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->  
  <link rel="icon" type="image/png" href="img/icons/favicon.ico"/>
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->  
  <link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->  
  <link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="css/util.css">
  <link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
</head>
<body>
  
  <div class="limiter">
    <div class="container-login100" style="background-image: url('img/arrows-box-business-533189.jpg');">
      <div class="wrap-login100">
        <form class="login100-form validate-form" method="post" action="achecklogin.php">
          <span class="login100-form-logo">
            <img src="img/adult-american-business-1059122.jpg" width="165px" height="165px">
          </span>

          <span class="login100-form-title p-b-34 p-t-27">
            Admin Log in
          </span>

          <div class="wrap-input100 validate-input" data-validate = "Enter username">
            <input class="input100" type="text" name="fid" id="fid" placeholder="Admin ID">
            <span class="focus-input100" data-placeholder="&#xf207;"></span>
          </div>

          <div class="wrap-input100 validate-input" data-validate="Enter password">
            <input class="input100" type="password" name="fpass" id="fpass" placeholder="Password">
            <span class="focus-input100" data-placeholder="&#xf191;"></span>
          </div>

          <div class="contact100-form-checkbox">
            <input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
            <label class="label-checkbox100" for="ckb1">
              Remember me
            </label>
          </div>

          <div class="container-login100-form-btn">
            <button class="login100-form-btn">
              Login
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
  

  <div id="dropDownSelect1"></div>
  
<!--===============================================================================================-->
  <script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
  <script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
  <script src="vendor/bootstrap/js/popper.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
  <script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
  <script src="vendor/daterangepicker/moment.min.js"></script>
  <script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
  <script src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
  <script src="js/main.js"></script>

</body>
</html>