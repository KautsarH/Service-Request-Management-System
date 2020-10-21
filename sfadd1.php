<?php
session_start();
include "dbconnect.php";
$dname = $_POST['fname'];
$ddesc= $_POST['fdesc'];
$budget = $_POST['fbudget'];
$memail = $_POST['fmemail'];
$total =$_POST['ftot'];
$mode =$_POST['fmode'];
$payto =$_POST['fpto'];
$addr =$_POST['faddr'];
$ddate =date("Y-m-d H:i:s");
$sid= $_SESSION['sid'];


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
        echo "Sorry, there was an error uploading your file.";;
        $uploadOk == 0;
    }
	}

if($budget =="Under RM10k"){
	$mid1 = mysqli_query($dbc,"SELECT mid from manager where memail = '$memail'");
	while($row = mysqli_fetch_array($mid1)){
	$mid = $row['mid'];	
	/*`attch`,'" . mysqli_escape_string($dbc,file_get_contents($target_file)) . "'*/
	 $sql="INSERT INTO `servicerequests`.`form`(`dname`,`dbget`,`dtot`,`dmode`,`dpto`,`daddr`,`ddesc`,`ddate`,`sid_fk`,`mid_fk`,`name`,`type`,`size`,`location`) VALUES ('$dname','$budget','$total','$mode','$payto','$addr','$ddesc','$ddate','$sid','$mid','$name','$type','$size','$target_file')";
	}
}
else if($budget =="RM10k - RM100k"){
	$temail = $_POST['ftemail'];
	$mid1 = mysqli_query($dbc,"SELECT mid,tid from manager,topm where memail = '$memail' and temail = '$temail'");
	while($row = mysqli_fetch_array($mid1)){
	$mid = $row['mid'];	
	$tid = $row['tid'];	
	$m='PENDING';

	$sql="INSERT INTO `servicerequests`.`form`(`dname`,`dbget`,`dtot`,`dmode`,`dpto`,`daddr`,`ddesc`,`ddate`,`sid_fk`,`mid_fk`,`tid_fk`,`m`,`name`,`type`,`size`,`location`) VALUES ('$dname','$budget','$total','$mode','$payto','$addr','$ddesc','$ddate','$sid','$mid','$tid','$m','$name','$type','$size','$target_file')";
	}
}

$results='';

if ( $uploadOk == 1 )
{
	$results=mysqli_query($dbc,$sql);
}


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
