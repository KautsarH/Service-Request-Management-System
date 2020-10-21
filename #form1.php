
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<?php

$dbh = new PDO("mysql:host-localhost;dbname-servicerequests","root","");

if(isset($_POST['btn'])){
	$name = $_FILES['myfile']['name'];
	$type = $_FILES['myfile']['type'];
	$data = file_get_contents($_FILES['myfile']['tmp_name']); 
	$stmt = $dbh->prepare("insert into form1 values('',?,?,?)");
	$stmt->bindParam(1,$name);
	$stmt->bindParam(2,$type);
	$stmt->bindParam(3,$data);	
	$stmt->execute();
	echo $name;
	}
	
?>
  
  <form method="post" enctype="multipart/form-data">
  <p>
    <input type="file" name="myfile"/>
  </p>
  <button name="btn">Upload</button>
  <p>&nbsp;</p>
</form>
</body>
</html>