<?php
session_start();
//If your session isn't valid, it returns you to the login screen for protection
if(empty($_SESSION['tid'])){
 Print '<script>alert("ACCESS DENIED. PLEASE LOGIN");</script>';
  Print '<script>window.location.assign("index.html");</script>';
} 

include "dbconnect.php";
$id = $_GET['id'];

     $result=mysqli_query($dbc,"SELECT * FROM form WHERE did = '$id'")
or die("There are no records to display ... \n" . mysql_error()); 


$row = mysqli_fetch_array($result);
if($row)
 {
 // get data from db
 $status = $row['dstats'];
 $comment = $row['dcomm'];

 }
 

?>

<?php
// updating sql query
if (isset($_POST['update'])){
include "dbconnect.php";

//$myId = addslashes( $_GET['pid']);
$status = addslashes( $_POST['fstatus'] );
$comment = addslashes( $_POST['fcomment'] );  //prevents types of SQL injection 


$sql = "UPDATE form SET dstats='$status', dcomm='$comment' WHERE did = '$id'";
        $result=mysqli_query($dbc,$sql);
    
if($result) //success  
     {
      mysqli_commit($dbc);
      Print '<script>alert("Status has successfully updated.");</script>'; 
      Print '<script>window.location.assign("tlistall.php?id='.$id.'");</script>'; 
    }
    else //unsuccess  
    {
      mysqli_rollback($dbc);

      Print '<script>alert("Status failed to update.");</script>'; 
      Print '<script>window.location.assign("tlistall.php?id='.$id.'");</script>';     
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
<body class="w3-container w3-pale-blue">
<style>
.w3-lobster {
    font-family: "Lobster", serif;
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
  <center><h1>UPDATE DETAILS</h1></center>
</div>
<div class="w3-container w3-lobster">
  <center><p class="w3-xxxlarge">Request Update</p></center>
</div>
</div>

<div id="page">
<div id="container">
<center><table  style="margin-left:50%" align="center">
<form action="tlistallupd.php?id=<?php echo $id; ?>" method="post" name="form1"> 
<table align="center">
<tr>
  <td> ID:</td>
  <td><fieldset disabled>
    <input  class="form-control" type="text" style="background-color:#99s9999; font-weight:bold;" name="fid" maxlength="10" value='<?=$row['did'];?>' required></fieldset>
  </td>
</tr>
<tr>
  <tr>
  <td>Title:</td>
  <td><fieldset disabled>
    <input  class="form-control" type="text" style="background-color:#99s9999; font-weight:bold;" name="fname" maxlength="20" value='<?=$row['dname'];?>' required></fieldset>
  </td>
</tr>
<tr>
  <td>Status:</td>
  <td>
  <select selected="selected" name="fstatus" id="fstatus">
 
     <option value="PENDING">PENDING</option>
     <option value="APPROVED">APPROVED</option>
     <option value="REJECTED">REJECTED</option>
     <option value="CANCELLED">CANCELLED</option>

    </select>
    <script type="text/javascript">
  document.getElementById('fstatus').value = "<?php echo $status;?>";
  </script>
    </td>
</tr>
<tr>
  <td>Comment:</td>
  <td><textarea type="text" name="fcomment" id="fcomment" rows="5" maxlength="256" placeholder="Comment"><?php echo $comment;?></textarea>
  </td>
</tr>
<tr><div class="w3-container" >
  <td></td>
     <td> <input  class="w3-btn w3-teal" type="submit" name="update" value="Update"></td>
</div></tr>
</table>
</form>
</table>
</center>
</div>
</body>
</html>