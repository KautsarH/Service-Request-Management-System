<?php

$sid = $_POST['fid'];  //variable reka . 'xx' ambil dekat form
$sname = $_POST['fname'];
$spass= $_POST['fpass'];
$semail = $_POST['femail'];
$sposit = $_POST['fposit'];

include "dbconnect.php";


$sql="INSERT INTO `servicerequests`.`staff`(`sid`,`spass`,`sname`,`semail`,`sposit`) VALUES ('$sid','$spass','$sname','$semail','$sposit')"; //`namadatabase`.`namaTable`(`variable kat table database`) VALUES ('variable kat atas')";

$results=mysqli_query($dbc,$sql); //to keep results query into $result
if ($results)
{
	mysqli_commit($dbc);
	print'<script> alert("Registration Successfull!");</script>';
	print'<script> window.location.assign("createnew.php");</script>'; //nama file input form
}

else
{
	mysqli_rollback($dbc);
	print'<script> alert("Registration NOT Successfull. Try Again");</script>'; //display message box
	print'<script> window.location.assign("createnew.php");</script>'; //go to index box . nama file input form
}
?>

