<?php
session_start();
?>
<html><head>

</head><body>  

<?php
session_destroy();
Print '<script>alert("You have been successfully logged out.");</script>';
 	Print '<script>window.location.assign("index.html");</script>';
?>
<div id="footer">

</div>

</body></html>