<?php
session_start();
//If your session isn't valid, it returns you to the login screen for protection
if(empty($_SESSION['sid'])){
 Print '<script>alert("ACCESS DENIED. PLEASE LOGIN");</script>';
  Print '<script>window.location.assign("index.html");</script>';
} 

include "dbconnect.php";
$id = $_GET['id'];

$result=mysqli_query($dbc,"SELECT * FROM form WHERE did = '$id'")
or die("There are no records to display ... \n" . mysql_error()); 
if (mysqli_num_rows($result)<1){
    $result = null;
}
$row = mysqli_fetch_array($result);
if($row)
 {
 $mode = $row['dmode'];
 }


?>

<?php
// updating sql query
if (isset($_POST['update'])){
include "dbconnect.php";

//$myId = addslashes( $_GET['pid']);
//$status = addslashes( $_POST['fstatus'] );
$desc = addslashes( $_POST['fdesc'] );
$name = addslashes( $_POST['fname'] );
$tot = addslashes( $_POST['ftot'] );
$mode = addslashes( $_POST['fmode'] );
$payto = addslashes( $_POST['fpto'] );
$addr = addslashes( $_POST['faddr'] );//prevents types of SQL injection 


$sql = "UPDATE form SET  ddesc='$desc', dname ='$name', dtot='$tot', dmode='$mode', dpto='$payto', daddr='$addr' WHERE did = '$id'";
        $result=mysqli_query($dbc,$sql);
    
if($result) //success  
     {
      mysqli_commit($dbc);
      Print '<script>alert("Status has successfully updated.");</script>'; 
      Print '<script>window.location.assign("slist.php?id='.$id.'");</script>'; 
    }
    else //unsuccess  
    {
      mysqli_rollback($dbc);

      Print '<script>alert("Status failed to update.");</script>'; 
      Print '<script>window.location.assign("slist.php?id='.$id.'");</script>';     
    }

// redirect back to profile
//header("Location: comp-upd.php");
}
?>


<html >
<body>

<form action="slistupd.php?id=<?php echo $id; ?>" method="post" name="form1"> 
<table >
<tr>
  <td> ID:</td>
  <td><fieldset disabled>
    <input  class="form-control" type="text" name="fid" maxlength="10" value='<?=$row['did'];?>' required></fieldset>
  </td>
</tr>
<tr>
  <td>Payment For:</td>
  <td>
    <input class="form-control" type="text"  name="fname" maxlength="256" value='<?=$row['dname'];?>' required>
  </td>
</tr>
<tr>
    <td>Total Amount (RM)</td>
    <td>
      <input class="form-control" type="float" name="ftot" id="ftot" maxlength="10" value='<?=$row['dtot'];?>' required /></td>
</tr>
<tr>
  <td>Payable Mode</td> 
  <td>
    <select name="fmode" id="fmode">
      <option value="Cash">Cash</option>
      <option value="Cheque">Cheque</option>
    </select>
  </td>
</tr>
<td><label for="fpto">Payable To</label></td>
    <td><input class="form-control" type="text" name="fpto" id="fpto" maxlength="256" value='<?=$row['dpto'];?>' required /></td>
  </tr>
  <tr>
    <td><label for="faddr">Address</label></td>
    <td><textarea class="form-control" type="text" name="faddr" id="faddr" rows="3" maxlength="256"><?php echo $row['daddr']; ?></textarea></td>
  </tr>
<tr>
  <td>Remarks:</td>
  <td><textarea  class="form-control" type="text" name="fdesc" id="fdesc" rows="2" maxlength="256"><?php echo $row['ddesc']; ?></textarea>
  </td>
</tr>

<tr><div >
  <td></td>
     <td> <input id="submit" type="submit" name="update" value="Update"></td>
</div>
</tr>
</table>
</form>
</div>
</body>
</html>