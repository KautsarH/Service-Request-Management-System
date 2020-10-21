<?php
    session_start();
//If your session isn't valid, it returns you to the login screen for protection
if(empty($_SESSION['aid'])){
 Print '<script>alert("ACCESS DENIED. PLEASE LOGIN");</script>';
  Print '<script>window.location.assign("index.html");</script>';
} 

include "dbconnect.php";


$result =mysqli_query($dbc,"SELECT dstats, count(*) as stats FROM form GROUP BY dstats")or die("There are no records to display ... \n" . mysqli_error()); 
$result2 =mysqli_query($dbc,"SELECT dbget, count(*) as bget FROM form GROUP BY dbget")or die("There are no records to display ... \n" . mysqli_error()); 
$result3 =mysqli_query($dbc,"SELECT sid_fk, mid_fk, tid_fk, count(*) as worker FROM form GROUP BY sid_fk, mid_fk , tid_fk")or die("There are no records to display ... \n" . mysqli_error()); 

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lobster">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Allerta+Stencil">
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Form', 'By Status'],
          <?php
          while($row = mysqli_fetch_array($result))
          {
            echo "['".$row["dstats"]."', ".$row["stats"]."],";
          }
          ?>        
    
        ]);

        var options = {
          legend: 'none',
          pieSliceText: 'label',
          slices: {  4: {offset: 0.2},
                    12: {offset: 0.3},
                    14: {offset: 0.4},
                    15: {offset: 0.5},
          

            },
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));
        chart.draw(data, options);

        var data2 = google.visualization.arrayToDataTable([
          ['Form', 'By Budget'],
          <?php
          while($row2 = mysqli_fetch_array($result2))
          {
            echo "['".$row2["dbget"]."', ".$row2["bget"]."],";
          }
          ?>        
    
        ]);

        var options2 = {
          legend: 'none',
          pieSliceText: 'label',
          slices: {  4: {offset: 0.2},
                    12: {offset: 0.3},
                    14: {offset: 0.4},
                    15: {offset: 0.5},
          

            },
        };

        var chart2 = new google.visualization.PieChart(document.getElementById('piechart2'));
        chart2.draw(data2, options2);

        /*var data3 = google.visualization.arrayToDataTable([
          ['Form', 'By Worker'],
          <?php
          while($row3 = mysqli_fetch_array($result3))
          {
            if ($row3["sid_fk"])
            {
            echo "['".$row3["sid_fk"]."', ".$row3["worker"]."],";
            }
            else if ($row3["mid_fk"])
            {
            echo "['".$row3["mid_fk"]."', ".$row3["worker"]."],";
            }
            else
              {
            echo "['".$row3["tid_fk"]."', ".$row3["worker"]."],";
            }




          }
          ?>        
    
        ]);

        var options3 = {
          legend: 'none',
          pieSliceText: 'label',
          slices: {  4: {offset: 0.2},
                    12: {offset: 0.3},
                    14: {offset: 0.4},
                    15: {offset: 0.5},
          

            },
        };

        var chart3 = new google.visualization.PieChart(document.getElementById('piechart3'));
        chart3.draw(data3, options3);*/


      }
    </script>
<body class="w3-container w3-pale-blue">
<style>
.w3-lobster {
    font-family: "Lobster", serif;
}

#list{
    font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
    border-collapse: collapse;
    width: 60%;
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
    background-color: #4CAF50;
    color: white;
}

.box{
  overflow: auto;
  width: auto;
  max-height: 60px;
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

      <div class="w3-sidebar w3-display-left w3-light-grey w3-bar-block" style="width:25%">
  <h3 class="w3-bar-item">Menu</h3>
  <a href="aprofile.php" class="w3-bar-item w3-button">Home</a>
  <a href="aliststaff.php" class="w3-bar-item w3-button">Staff List</a>
   <a href="alistmanager.php" class="w3-bar-item w3-button">Manager List</a>
   <a href="alisttopm.php" class="w3-bar-item w3-button">Top Management List</a>
   <a href="alistexec.php" class="w3-bar-item w3-button">Executive List</a>
   <a href="createnew.php" class="w3-bar-item w3-button">Create New User</a>
   <a href="areport.php" class="w3-bar-item w3-button">Report</a>
    <a href="logout.php" class="w3-bar-item w3-button">Logout</a>

</div>

<div style="margin-left:25%" align="center">

<div class="w3-container w3-dark-gray" width="100">
  <center><h1>ANALYSIS</h1></center>
</div>

<!--<img src="img_car.jpg" alt="Car" style="width:100%">

<div class="w3-container w3-lobster">
  <center><p class="w3-xxxlarge">Profile details</p></center>
</div>-->

</div>
<div style="margin-left:25%" align="center">
  <center><h4>Form sorted by Status</h4></center>
<div style="margin-left:90% width: 500px; height: 500px;" id="piechart"></div>
<center><h4>Form sorted by Estimated Budget</h4></center>
<div style="margin-left:90% width: 500px; height: 500px;" id="piechart2"></div>
<!--<center><h4>Form sorted by Worker</h4></center>
<div style="margin-left:90% width: 500px; height: 500px;" id="piechart3"></div>-->
</div>
<hr>

<div id="footer">


</body></html>