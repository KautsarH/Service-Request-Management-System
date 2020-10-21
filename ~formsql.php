<?php
session_start();
include "dbconnect.php";
$dname = $_POST['fname'];
$ddesc= $_POST['fdesc'];
$memail = $_POST['fmemail'];
$total =$_POST['ftot'];
$mode =$_POST['fmode'];
$payto =$_POST['fpto'];
$addr =$_POST['faddr'];
$ddate =date("Y-m-d H:i:s");
$sid= $_SESSION['sid'];




	$mid1 = mysqli_query($dbc,"SELECT mid from manager where memail = '$memail'");
	while($row = mysqli_fetch_array($mid1)){
	$mid = $row['mid'];	
	/*`attch`,'" . mysqli_escape_string($dbc,file_get_contents($target_file)) . "'*/
	 $sql="INSERT INTO `servicerequests`.`form`(`dname`,`dtot`,`dmode`,`dpto`,`daddr`,`ddesc`,`ddate`,`sid_fk`,`mid_fk`) VALUES ('$dname','$total','$mode','$payto','$addr','$ddesc','$ddate','$sid','$mid')";
	}

	$results=mysqli_query($dbc,$sql);



if ($results)
{
	mysqli_commit($dbc);
	print'<script> alert("Form Successfully Added");</script>';
	print'<script> window.location.assign("sffadd.php");</script>'; //nama file input form
}


{
	mysqli_rollback($dbc);
	print'<script> alert("Data is Invalid, Form Unsuccessful");</script>'; //display message box
	print'<script> window.location.assign("sffadd.php");</script>'; //go to index box . nama file input form
}
?>
