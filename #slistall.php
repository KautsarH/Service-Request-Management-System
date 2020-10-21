<?php

include "dbconnect.php";

	session_start();
//If your session isn't valid, it returns you to the login screen for protection
if(empty($_SESSION['sid'])){
 Print '<script>alert("ACCESS DENIED. PLEASE LOGIN");</script>';
  Print '<script>window.location.assign("index.html");</script>';
} 

$result=mysqli_query($dbc,"SELECT * FROM `form` order by ddate desc")
or die("There are no records to display ... \n" . mysql_error()); 


 if(isset($_POST['sort'])){
  if($_POST['sort'] == 'title'){
    $result=mysqli_query($dbc,"SELECT * FROM `form` order by dname") or die("There are no records to display ... \n" . mysql_error()); 
    mysqli_commit($dbc);
  }
  if($_POST['sort'] == 'status'){

    $result=mysqli_query($dbc,"SELECT * FROM `form` order by dstats") or die("There are no records to display ... \n" . mysql_error()); 
    mysqli_commit($dbc);
  }
  if($_POST['sort']=='date'){

    $result=mysqli_query($dbc,"SELECT * FROM `form` order by ddate desc") or die("There are no records to display ... \n" . mysql_error()); 
    mysqli_commit($dbc);
  }

  if($_POST['sort']=='id'){

    $result=mysqli_query($dbc,"SELECT * FROM `form` order by did") or die("There are no records to display ... \n" . mysql_error()); 
    mysqli_commit($dbc);
  }
}

?>
<html><head>
<link href="../css/user_styles.css" rel="stylesheet" type="text/css" />
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
  max-height: 450px;
  border: none;
  padding: 5px;
  /*margin-top:20px; ni untuk table*/

}

/*.table-wrapper {
  position:relative;
}


.table-wrapper table thead th .text {
  position:absolute;   
  top:-20px;
  z-index:2;
  height:20px;
  width:60%;
  border:1px solid grey;
}*/

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

function search() {
    var input, filter, table, tr, td, i;
  input = document.getElementById("search");
  filter = input.value.toUpperCase();
  table = document.getElementById("list");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[2];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}
</script>

    <div class="w3-sidebar w3-display-left w3-light-grey w3-bar-block" style="width:25%">
  <h3 class="w3-bar-item">Menu</h3>
  <a href="sprofile.php" class="w3-bar-item w3-button">Home</a>
  <a href="sform.php" class="w3-bar-item w3-button">Create New Form</a>
  <a href="slist.php" class="w3-bar-item w3-button">My Request List</a>
   <a href="slistall.php" class="w3-bar-item w3-button">All Request List</a>
    <a href="slogout.php" class="w3-bar-item w3-button">Logout</a>

</div>


<div style="margin-left:25%" align="center">

<div class="w3-container w3-dark-gray" width="100">
  <center><h1>REQUEST LIST</h1></center>
</div>

<!--<img src="img_car.jpg" alt="Car" style="width:100%">-->
<p></p>
<form  method="POST"><select style="margin-left:0%" name="sort" style="float: left" onchange="this.form.submit();">
      <option>Sort By:</option>
      <option value="date">Date Created</option>
      <option value="id">ID</option>
      <option value="title">Title</option>
      <option value="status">Status</option>
    </select></form>
    Search : <input type="text" id="search" onkeyup="search()" placeholder="Search for title">    
</div>

<div class="box" >
<table id="list" style="margin-left:30%" >
  
<tr class="header">
    <!--<th><span class="text"></span> <center> No. </center></th>
    <th><span class="text"></span> <center>ID</center></th>
    <th><span class="text"></span> <center>Title</center></th>
    <th><span class="text"></span> <center>Status</center></th>
    <th><span class="text"></span> <center>Date Created</center></th>
    <th><span class="text"></span> <center>Manage</center></th>-->
    <th><center> No. </center></th>
    <th><center>ID</center></th>
    <th><center>Title</center></th>
    <th><center>Status</center></th>
    <th><center>Date Created</center></th>
    <th><center>Manage</center></th>
</tr>
<?php
  $i=1;
  while($row = mysqli_fetch_array($result))
  {?>
<tr>
    <td><?php echo $i ?></td>
    <td><?php echo $row['did'] ?></td>
    <td><?php echo $row['dname'] ?></td>
    <td><?php echo $row['dstats'] ?></td>
    <td><?php echo $row['ddate'] ?></td>
    <td><a href="sformdet.php?id=<?php echo $row['did'] ?>" class="btn btn-default" role="button">Details</a></td>
</tr>

<?php $i++; }
?>


</table>
<!--</div>
</div>-->
</div>

<hr>

<div id="footer">
<div class="w3-display-bottommiddle" style="margin-left:5%">&copy; 2018 Service Requests Management System. All Rights Reserved</div>
</div>

</body></html>