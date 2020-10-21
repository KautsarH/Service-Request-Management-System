<?php 
include "dbconnect.php";

session_start();
//If your session isn't valid, it returns you to the login screen for protection
if(empty($_SESSION['eid'])){
	Print '<script>alert("ACCESS DENIED. PLEASE LOGIN");</script>';
 	Print '<script>window.location.assign("index.html");</script>';
}
$did =$_GET['id'];

//cari bil separuh dari executive
$count1=mysqli_query($dbc,"SELECT * FROM exec");
$count=mysqli_num_rows($count1);
$x = 2;
$half = $count / $x;

//kira each status
$pen =0;
$app =0;
$rej =0;
$can =0;

$result =mysqli_query($dbc,"SELECT * FROM formexec where did_fk = '$did' ")or die("There are no records to display ... \n" . mysqli_error()); 
while($row = mysqli_fetch_array($result))
{
    if ($row['estats']=="PENDING")
      { $pen++;}
    if ($row['estats']=="APPROVED")
      { $app++;}
    if ($row['estats']=="REJECTED")
      { $rej++;}
    if($row['estats']=="CANCELLED")
      { $can++;}
}

if( $pen != 0)
{
	$status = "PENDING";

}
else if ( $app > $half)
{
	$status = "APPROVED"; 
}
else
{
	$status = "REJECTED";
}



$sql = "UPDATE form  SET dstats = '$status' WHERE did = '$did'";
$result1=mysqli_query($dbc,$sql);


if($result1) //success  
     {
      mysqli_commit($dbc);
      Print '<script>alert("Status has successfully updated.");</script>'; 
      Print '<script>window.location.assign("elist.php");</script>'; 
    }
    else //unsuccess  
    {
      mysqli_rollback($dbc);

      Print '<script>alert("Status failed to update.");</script>'; 
      Print '<script>window.location.assign("elist.php");</script>';     
    }


?>