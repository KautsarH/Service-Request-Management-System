<?php
session_start();
include "dbconnect.php";
$dname = $_POST['fname'];
$ddesc= $_POST['fdesc'];
$budget = $_POST['fbudget'];
$total =$_POST['ftot'];
$mode =$_POST['fmode'];
$payto =$_POST['fpto'];
$addr =$_POST['faddr'];
$exec =1;
$ddate =date("Y-m-d H:i:s");
$tid= $_SESSION['tid'];
$name = $_FILES['fileToUpload']['name'];
$size = $_FILES['fileToUpload']['size'];
$type = $_FILES['fileToUpload']['type'];
$tmp_name = $_FILES['fileToUpload']['tmp_name'];
$extension = substr($name, strpos($name, '.') + 1);

	$target_dir = "uploads/";
	$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
	$uploadOk = 1;
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
	
	if(isset($_POST["submit"])) {
	$check = filesize($_FILES["fileToUpload"]["tmp_name"]);
	if($check < 8000000) {
	        $uploadOk = 1;
	    } else {
	    	mysqli_rollback($dbc);
	print'<script> alert("File exceed 8 MB. Your file was not uploaded.");</script>'; 
	print'<script> window.location.assign("sform.php");</script>';
	        $uploadOk = 0;
	    }
	}
	/*if (file_exists($target_file)) {
    mysqli_rollback($dbc);
	print'<script> alert("File already exist.");</script>';
	print'<script> window.location.assign("sform.php");</script>';
    $uploadOk = 0;
	}*/

	if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
	// if everything is ok, try to upload file
	} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        /*echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";*/
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
	}

	/*`attch`,'" . mysqli_escape_string($dbc,file_get_contents($target_file)) . "'*/
 $sql="INSERT INTO `servicerequests`.`form`(`dname`,`dbget`,`dtot`,`dmode`,`dpto`,`daddr`,`ddesc`,`ddate`,`tid_fk`,`exec`,`name`,`type`,`size`,`location`) VALUES ('$dname','$budget','$total','$mode','$payto','$addr','$ddesc','$ddate','$tid','$exec','$name','$type','$size','$target_file')";


$results='';
if ( $uploadOk == 1 )
{
	$results=mysqli_query($dbc,$sql);
}

 //to keep results query into $result
if ($results)
{	$did2 = mysqli_insert_id($dbc);
	mysqli_commit($dbc);
	print'<script> window.location.assign("tfadd2.php?id='.$did2.'");</script>'; //nama file input form
}

else
{
	mysqli_rollback($dbc);
	print'<script> alert("Data is Invalid, Form Unsuccessful");</script>'; //display message box
	print'<script> window.location.assign("tffadd1.php");</script>'; //go to index box . nama file input form
}
?>
