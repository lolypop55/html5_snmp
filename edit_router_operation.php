<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

mysql_connect("localhost", "root", "password");
mysql_select_db("logon");

isset($_POST['Router_ID']) ? $userId = $_POST['Router_ID'] : $userId = NULL;
isset($_POST['Username']) ? $username = $_POST['Router_IP'] : $username = NULL;
isset($_POST['Status']) ? $status = $_POST['Router_Name'] : $status = NULL;
isset($_POST['String']) ? $name = $_POST['String'] : $name = NULL;
isset($_POST['Password']) ? $password = $_POST['Remark '] : $password = NULL;

if ($userId == NULL || $username == NULL || $status == NULL || $password == NULL || $name == NULL) {
   //echo 'userid = ' . $userId . ' username = ' . $username . ' Status = ' . $status . ' name = ' . $name . ' password = ' . $password; 
    ?>
    <script language="JavaScript">alert("Incorrectly Redirect");</script>
    <script language="JavaScript">window.location.href = "login.html";</script>
    <?php
}

$userId = stripcslashes($userId);
$name = stripcslashes($name);
$username = stripcslashes($username);
$status = stripcslashes($status);
$password = stripcslashes($password);

$userId = mysql_real_escape_string($userId);
$name = mysql_real_escape_string($name);
$username = mysql_real_escape_string($username);
$status = mysql_real_escape_string($status);
$password = mysql_real_escape_string($password);

$query = "SELECT COUNT(Password) AS COUNTIT FROM admin WHERE (Password = '$password') AND (Router_ID = '$userId')";
$result = mysql_query($query);
$count = mysql_fetch_array($result);
if ($count['COUNTIT'] != 1) {
    ?>
    <script language="JavaScript">alert("Wrong Password");</script>
    <script language="JavaScript">window.location.href = "login.html";</script>
    <?php
}

$query = "UPDATE admin SET Router_IP = '$username', String = '$name', Router_Name = '$status' WHERE (Router_ID = '$userId') AND (Remark  = '$password')";
mysql_query($query);
?>

<script language="JavaScript">alert("Success");</script>
<script language="JavaScript">window.location.href = "manage_user.php";</script>