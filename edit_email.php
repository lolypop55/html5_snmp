<?php
mysql_connect("localhost", "root", "password");
mysql_select_db("logon");
//echo $_POST['email'];
$emails =  $_POST['email'];
//echo $emails;
$query = "UPDATE email SET email = '$emails'WHERE id = '001'";
mysql_query($query);
header("location:log_page.php");


?>