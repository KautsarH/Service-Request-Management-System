<?php
	
	session_start();
//If your session isn't valid, it returns you to the login screen for protection
if(empty($_SESSION['sid'])){
 Print '<script>alert("ACCESS DENIED. PLEASE LOGIN");</script>';
  Print '<script>window.location.assign("index.html");</script>';
} 

	include "dbconnect.php";
	$id   = $_GET['id'];
	$sql = "DELETE FROM form where did='$id'"; 
	$result = mysqli_query($dbc, $sql);
	
	if($result) //success  
	   {
			mysqli_commit($dbc);
			Print '<script>alert("Form is successfully deleted.");</script>'; 
			Print '<script>window.location.assign("aliststaff.php?id='.$id.'");</script>'; 
		}
		else //unsuccess  
		{
			mysqli_rollback($dbc);

			Print '<script>alert("Form failed to delete.");</script>'; 
			Print '<script>window.location.assign("aliststaff.php?id='.$id.'");</script>'; 		
		}
?>
