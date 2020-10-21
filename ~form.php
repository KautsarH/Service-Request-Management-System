<?php
session_start();
//If your session isn't valid, it returns you to the login screen for protection
if(empty($_SESSION['sid'])){
 Print '<script>alert("ACCESS DENIED. PLEASE LOGIN");</script>';
  Print '<script>window.location.assign("index.html");</script>';
} 

include "dbconnect.php";
$query = "SELECT * FROM `manager`";
$result = mysqli_query($dbc,$query);

?>
<html>
<head>
</head>   
<body >
<form id="form1" name="form1" method="post" action="sfadd1.php">
  <tr>
    <td><label for="fname">Payment For</label></td>
    <td><input class="form-control" type="text" name="fname" id="fname" maxlength="256" placeholder="Payment For" required /></td>
  </tr>
  <tr>
    <td><label for="ftot">Total Amount (RM)</label></td>
    <td><input class="form-control" type="float" name="ftot" id="ftot" maxlength="10" placeholder="Amount" required /></td>
  </tr>
  <tr>
    <td><label for="fmode">Payable Mode</label></td> 
    <td><select name="fmode" id="fmode">
      <option value="Cash">Cash</option>
      <option value="Cheque">Cheque</option>
    </select></td>
  </tr>
  <tr>
    <td><label for="fpto">Payable To</label></td>
    <td><input class="form-control" type="text" name="fpto" id="fpto" maxlength="256" placeholder="Payment For" required /></td>
  </tr>
  <tr>
    <td><label for="faddr">Address</label></td>
    <td><textarea class="form-control" type="text" name="faddr" id="faddr" rows="3" maxlength="256" placeholder="Address" required></textarea></td>
  </tr>
  

 <tr>
    <td><label for="fmemail">Approver (Manager)</label></td> 
    <td><select name="fmemail" id="fmemail">
      <?php
       while ($line = mysqli_fetch_array($result)) 
         {
      ?>
     <option value="<?php echo $line['memail'];?>"><?php echo $line['memail'];?> </option>
<?php } ?>
    </select></td>
  </tr>

  <tr>
    <td><label for="fdesc">Remarks (If any)</label></td>
    <td><textarea class="form-control" type="text" name="fdesc" id="fdesc" rows="2" maxlength="256" placeholder="Remark"></textarea></td>
  </tr>
  <tr>
    <td>    </td>
    <td><input  name="submit" type="submit" value=" Submit ">   
   </td>
  </tr>
  </table>

</div>
</table>
  <p>&nbsp;</p>
</form>



</center>
<hr>
</div>
<div id="footer">
</div>
</body></html>