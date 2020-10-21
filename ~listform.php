<?php

include "dbconnect.php";

session_start();
//If your session isn't valid, it returns you to the login screen for protection
if(empty($_SESSION['sid'])){
 Print '<script>alert("ACCESS DENIED. PLEASE LOGIN");</script>';
  Print '<script>window.location.assign("index.html");</script>';
} 

  $result=mysqli_query($dbc,"SELECT * FROM `form` where sid_fk = '$_SESSION[sid]' order by ddate desc ") or die("There are no records to display ... \n" . mysql_error()); 


?>

<html>
<head>
</head>
<body >
<table>
<tr>
    <th><center> No. </center></th>
    <th><center>ID</center></th>
    <th><center>Payment For</center></th>  
    <th><center>Status</center></th>
    <th><center>Date Created</center></th>
    <th colspan="2"><center>Manage</center></th>
</tr>


<?php
$i=1;
while($row = mysqli_fetch_array($result))
{?>
   
<tr>
    <td><?php echo $i ?></td>
    <td><?php echo $row['did'] ?></td>
    <td><?php echo $row['dname'] ?></td>>
    <td><?php echo $row['dstats'] ?></td>
    <td><?php echo $row['ddate'] ?></td>
    <td><a href="slistdet.php?id=<?php echo $row['did'] ?>" role="button">Details</a></td>
    <td><a href="slistupd.php?id=<?php echo $row['did'] ?>" role="button">Update</a></td>
    <td><a href="slistdel.php?id=<?php echo $row['did'] ?>" role="button">Delete</a></td>

</tr>

<?php $i++; }
?>

</table>

</div>

<hr>

<div id="footer">


</body></html>