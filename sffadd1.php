<?php
session_start();
//If your session isn't valid, it returns you to the login screen for protection
if(empty($_SESSION['sid'])){
 Print '<script>alert("ACCESS DENIED. PLEASE LOGIN");</script>';
  Print '<script>window.location.assign("index.html");</script>';
} 

include "dbconnect.php";
$budget = $_GET['id'];
$query = "SELECT * FROM `manager`";
$result = mysqli_query($dbc,$query);
$query1 = "SELECT * FROM `topm`";
$result1 = mysqli_query($dbc,$query1);

?>

<html>
<head>
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lobster">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Allerta+Stencil">
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>  
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
</head>   
<body class="w3-container w3-pale-blue">
<style>
.w3-lobster {
    font-family: "Lobster", serif;
}
#list{
    font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
    border-collapse: collapse;
    width: 60%;
    min-height: 0/*43px*/;
    max-height: 450px;
    overflow:auto;
    overflow-x: hidden;
}

#list td, #list th {
    border: 1px solid #ddd;
    padding: 8px;
}

#list tr:nth-child(even){background-color: #f2f2f2;}

#list tr:hover {background-color: #ddd;}

#list th {
    padding-top: 10px;
    padding-bottom: 10px;
    text-align: left;
    color: black;
}
.box{
  overflow: auto;
  width: auto;
  max-height: 450;
  border: none;
  padding: 5px;

}

::-webkit-scrollbar {
width: 10px;
height: 10px;
}

::-webkit-scrollbar-track {
background: #f5f5f5;
border-radius: 10px;
}

::-webkit-scrollbar-thumb {
border-radius: 10px;
background: #ccc;  
}

::-webkit-scrollbar-thumb:hover {
background: #999;  
}
</style>

<script>
function validateForm(){
  
    if (document.forms["form1"]["fname"].value == "")
    {
     alert ("Please enter title");
     return false;
    
    }

    if (document.forms["form1"]["fileToUpload"].value == "")
    {
     alert ("Please attach a file");
     return false;
    
    }

    if (document.getElementById('fileToUpload').files[0].size > 8000000)
    {
       alert ("This file exceeded 8MB");
       return false;
    }  
}


</script>

    <div class="w3-sidebar w3-display-left w3-light-grey w3-bar-block" style="width:25%">
  <h3 class="w3-bar-item">Menu</h3>
  <a href="sprofile.php" class="w3-bar-item w3-button">Home</a>
  <a href="sffadd.php" class="w3-bar-item w3-button">Create New Form</a>
  <a href="slist.php" class="w3-bar-item w3-button">My Request List</a>
    <a href="logout.php" class="w3-bar-item w3-button">Logout</a>

</div>

<div style="margin-left:25%" align="center">

<div class="w3-container w3-dark-gray" width="100">
  <center><h1>CREATE FORM</h1></center>
</div>

<!--<img src="img_car.jpg" alt="Car" style="width:100%">-->

<div class="w3-container w3-lobster">
  <center><p class="w3-xxxlarge">Form details</p></center>
</div>

</div>
<div id="page">
<div id="container">
<center><table  style="margin-left:60%" align="center">

<?php 
if($budget == "In" || $budget == "Under" )
{ ?>
<form id="form1" name="form1" method="post" action="sfadd1.php" enctype="multipart/form-data" onsubmit="return validateForm()">

<?php }  else {?>

  <form id="form1" name="form1" method="post" action="sfadd2.php" enctype="multipart/form-data" onsubmit="return validateForm()">

<?php }?> 
<div class="box" >
<table id="list" style="margin-left:30%" >
  <tr>
  <?php 
  if($budget == "In")
  { ?>
    <td colspan="2" align="center"><h3>Estimated Budget = RM10k -RM100k</h3></td>

  <?php }  else if($budget == "Under"){?>

    <td colspan="2" align="center"><h3>Estimated Budget = Under RM10k</h3></td>
  <?php }  else {?>

      <td colspan="2" align="center"><h3>Estimated Budget = Above RM100k</h3></td>

  <?php }?>
 </tr>
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
  
<?php 
if($budget == "Under")
{ ?>

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
  <input type="hidden" value="Under RM10k" name="fbudget"/>
  
  <?php } else if($budget == "In") {?>

    <tr>
    <td><label for="fmemail">Reviewer (Manager)</label></td> 

    <td><select name="fmemail" id="fmemail">
   <?php
       while ($line = mysqli_fetch_array($result)) 
         {
    ?>
     <option value="<?php echo $line['memail'];?>"><?php echo $line['memail'];?> </option>
     <?php
         }
     ?>
    </select></td>
  </tr>
  <tr>
    <td><label for="ftemail">Approver (TM)</label></td> 

    <td><select name="ftemail" id="ftemail">
   <?php
       while ($line = mysqli_fetch_array($result1)) 
         {
    ?>
     <option value="<?php echo $line['temail'];?>"><?php echo $line['temail'];?> </option>
     <?php
         }
     ?>
    </select></td>
  </tr>
  <input type="hidden" value="RM10k - RM100k" name="fbudget"/>

  <?php }  else {?>

    <tr>
    <td><label for="fmemail">Reviewer (Manager)</label></td> 

    <td><select name="fmemail" id="fmemail">
   <?php
       while ($line = mysqli_fetch_array($result)) 
         {
    ?>
     <option value="<?php echo $line['memail'];?>"><?php echo $line['memail'];?> </option>
     <?php
         }
     ?>
    </select></td>
  </tr>
  <tr>
    <td><label for="ftemail">Reviewer (TM)</label></td> 

    <td><select name="ftemail" id="ftemail">
   <?php
       while ($line = mysqli_fetch_array($result1)) 
         {
    ?>
     <option value="<?php echo $line['temail'];?>"><?php echo $line['temail'];?> </option>
     <?php
         }
     ?>
    </select></td>
  </tr>
  <input type="hidden" value="Above RM100k" name="fbudget"/>
  <tr>
    <td>Approver</td>
    <td>Executive Team</td>
  </tr>

<?php }?>

  <tr>
    <td><label for="fdesc">Remarks (If any)</label></td>
    <td><textarea class="form-control" type="text" name="fdesc" id="fdesc" rows="2" maxlength="256" placeholder="Remark"></textarea></td>
  </tr>
  <tr>
    <td rowspan="2"><label for="fattch">Attachment</label></td>
    <td><input name="fileToUpload" type="file" id="fileToUpload"/></td>
    <!--<td><input type="hidden" name="MAX_FILE_SIZE" value="8000000"/></td>-->
  </tr>
  <tr>
    <td><p>*File must not exceed 8 MB. One file per form</p></td>
    
  </tr>
  <tr>
    <td>    </td>
    <td><input  name="submit" type="submit" class="w3-btn w3-teal" id="submit" value=" Submit ">   
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