<?php
session_start();
//If your session isn't valid, it returns you to the login screen for protection

include "dbconnect.php";

if(empty($_SESSION['aid'])){
 Print '<script>alert("ACCESS DENIED. PLEASE LOGIN");</script>';
  Print '<script>window.location.assign("index.html");</script>';
} 

$result=mysqli_query($dbc,"SELECT * FROM admin WHERE aid = '$_SESSION[aid]'")
or die("There are no records to display ... \n" . mysqli_error()); 
if (mysqli_num_rows($result)<1){
    $result = null;
}
$row = mysqli_fetch_array($result);
if($row)
 {
 // get data from db
 $id = $row['aid'];
 $pass = $row['apass'];

 }

?>

<?php
// updating sql query
if (isset($_POST['update'])){
include "dbconnect.php";

//$myId = addslashes( $_GET['pid']);
$pass= addslashes( $_POST['fpass'] );

$sql = "UPDATE admin SET apass='$pass' WHERE aid = '$id'";
        $result=mysqli_query($dbc,$sql);
    
if($result) //success  
     {
      mysqli_commit($dbc);
      Print '<script>alert("Profile has successfully updated.");</script>'; 
      Print '<script>window.location.assign("aprofile.php?id='.$id.'");</script>'; 
    }
    else //unsuccess  
    {
      mysqli_rollback($dbc);

      Print '<script>alert("Profile failed to update.");</script>'; 
      Print '<script>window.location.assign("aprofile.php?id='.$id.'");</script>';    
    }

// redirect back to profile
//header("Location: comp-upd.php");
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
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
#list{
    font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
    border-collapse: collapse;
    width: 60%;
    min-height: 0/*43px*/;
    max-height: 450px;
    overflow:auto;
    overflow-x: hidden;
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
    color: black;
}
.box{
  overflow: auto;
  width: auto;
  max-height: 450;
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
<script>
function validateForm(){

    if (document.forms["form1"]["femail"].value == "")
    {
     alert ("Please enter email");
     return false;
    }
    
}
</script>

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
  <center><h1>Profile Update</h1></center>
</div>
<div class="w3-container w3-lobster">
  <center><p class="w3-xxxlarge">Update Details</p></center>
</div>
</div>

<div id="page">
<div id="container">
<center><table  style="margin-left:50%" align="center">
<form action="aprofileupd.php?id=<?php echo $id; ?>" method="post" name="form1" onclick="return validateFOrm()"> 
<table align="center">
<div class="box" >
<table id="list" style="margin-left:30%" >
<tr>
  <td> ID:</td>
  <td><fieldset disabled>
    <input  class="form-control" type="text" style="background-color:#99s9999; font-weight:bold;" name="fid" maxlength="10" value='<?=$row['aid'];?>' required></fieldset>
  </td>
</tr>
<tr>
  <td>Password:</td>
  <td>
    <input  class="form-control" type="password" style="background-color:#99s9999; font-weight:bold;" name="fpass" maxlength="20" value='<?=$row['apass'];?>' required>
  </td>
</tr>
<tr><div class="w3-container" >
  <td></td>
     <td> <input  class="w3-btn w3-teal" type="submit" name="update" value="Update"></td>
</div></tr>
</table>
</div>
</table>
</form>
</table>
</center>
</div>
</body>
</html>