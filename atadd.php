<?php

$tid = $_POST['fid'];  //variable reka . 'xx' ambil dekat form
$tname = $_POST['fname'];
$tpass= $_POST['fpass'];
$temail = $_POST['femail'];

include "dbconnect.php";


$sql="INSERT INTO `servicerequests`.`topm`(`tid`,`tpass`,`tname`,`temail`) VALUES ('$tid','$tpass','$tname','$temail')"; //`namadatabase`.`namaTable`(`variable kat table database`) VALUES ('variable kat atas')";

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

