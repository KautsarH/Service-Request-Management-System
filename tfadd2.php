<?php
session_start();
include "dbconnect.php";
$did =$_GET['id'];
$sql1 = mysqli_query($dbc,"SELECT * from form f, exec e where f.did = '$did'");
$i=0;
while($row = mysqli_fetch_array($sql1)){
$eid = $row['eid'];	

$sql="INSERT INTO `servicerequests`.`formexec`(`did_fk`,`eid_fk`) VALUES ('$did','$eid')";

$results=mysqli_query($dbc,$sql);
mysqli_commit($dbc);
$i++;
}
$count1=mysqli_query($dbc,"SELECT * FROM exec");
$count=mysqli_num_rows($count1);
	
if ($i==$count)
{
	print'<script> alert("Form Successfully Added");</script>';
	print'<script> window.location.assign("tffadd.php");</script>'; //nama file input form
}

else
{//$did2 = mysqli_insert_id($dbc);?id='.$did2.'
	//mysqli_rollback($dbc);
	print'<script> alert("Data is Invalid, Form Unsuccessful");</script>'; 
	print'<script> window.location.assign("tffadd.php");</script>'; //go to index box . nama file input form
}
?>