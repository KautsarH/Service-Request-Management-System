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
     $row = mysqli_fetch_assoc($result);
if($row)
 {
 // get data from db
 $comment = $row['dcomm'];
  $status = $row['t'];

 }
 

?>

<?php
// updating sql query
if (isset($_POST['update'])){
include "dbconnect.php";

//$myId = addslashes( $_GET['pid']);
$status1 = addslashes( $_POST['tstats'] );
$comment = addslashes( $_POST['fcomment'] );


if ($status1 == "PENDING")
{ 
  $t='PENDING'; 
}
else
{
  $t=$status1;
}



if ($status1 == "APPROVED" || $status1 == "PENDING")
{
  $status = 'PENDING';
}
else
{
   $status = $status1;
}

$sql = "UPDATE form SET dstats='$status', t='$t' , dcomm='$comment' WHERE did = '$id'";
        $result=mysqli_query($dbc,$sql);
    
if($result) //success  
     {
      mysqli_commit($dbc);
      Print '<script>alert("Status has successfully updated.");</script>'; 
      Print '<script>window.location.assign("tlistr.php?id='.$id.'");</script>'; 
    }
    else //unsuccess  
    {
      mysqli_rollback($dbc);

      Print '<script>alert("Status failed to update.");</script>'; 
      Print '<script>window.location.assign("tlistr.php?id='.$id.'");</script>';     
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
<form action="tlistrupd.php?id=<?php echo $id; ?>" method="post" name="form1"> 
<table align="center">
<div class="box" >
<table id="list" style="margin-left:30%" >
<tr>
  <td> ID:</td>
  <td><fieldset disabled>
    <input  class="form-control" type="text" style="background-color:#99s9999; font-weight:bold;" name="fid" maxlength="10" value='<?=$row['did'];?>' required></fieldset>
  </td>
</tr>
  <tr>
  <td>Payment For:</td>
  <td><fieldset disabled>
    <input  class="form-control" type="text" style="background-color:#99s9999; font-weight:bold;" name="fname" maxlength="256" value='<?=$row['dname'];?>' required></fieldset>
  </td>
</tr>
<tr>
    <td>Total Amount (RM)</td>
    <td><fieldset disabled>
      <input class="form-control" type="float" name="ftot" id="ftot" maxlength="10" value='<?=$row['dtot'];?>' required /></fieldset></td>
</tr>
<tr>
  <td>Status:</td>
  <td>
  <select  selected="selected" name="tstats" id="tstats">
 
     <option value="PENDING">PENDING</option>
     <option value="APPROVED">APPROVED</option>
     <option value="REJECTED">REJECTED</option>
     <option value="CANCELLED">CANCELLED</option>

    </select>
    <script type="text/javascript">
  document.getElementById('tstats').value = "<?php echo $status;?>";
  </script>
    </td>
</tr>
<tr>
  <td>Comment:</td>
  <td><textarea class="form-control" type="text" name="fcomment" id="fcomment" rows="5" maxlength="256" placeholder="Comment"><?php echo $comment;?></textarea>
  </td>
</tr>
<tr><div class="w3-container" >
  <td></td>
     <td> <input  class="w3-btn w3-teal" type="submit" name="update" value="Update"></td>
</div></tr>
</table>
</form>
</table>
</div>
</table>
</center>
</div>
</body>
</html>