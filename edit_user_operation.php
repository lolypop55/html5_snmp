<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

mysql_connect("localhost", "root", "password");
mysql_select_db("logon");

isset($_POST['User_ID']) ? $userId = $_POST['User_ID'] : $userId = NULL;
isset($_POST['Username']) ? $username = $_POST['Username'] : $username = NULL;
isset($_POST['Status']) ? $status = $_POST['Status'] : $status = NULL;
isset($_POST['Name']) ? $name = $_POST['Name'] : $name = NULL;
isset($_POST['Password']) ? $password = $_POST['Password'] : $password = NULL;

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

$query = "SELECT COUNT(Password) AS COUNTIT FROM admin WHERE (Password = '$password') AND (User_ID = '$userId')";
$result = mysql_query($query);
$count = mysql_fetch_array($result);
if ($count['COUNTIT'] != 1) {
    ?>
    <script language="JavaScript">alert("Wrong Password");</script>
    <script language="JavaScript">window.location.href = "login.html";</script>
    <?php
}

$query = "UPDATE admin SET Username = '$username', Name = '$name', Status = '$status' WHERE (User_ID = '$userId') AND (Password = '$password')";
mysql_query($query);
?>

<script language="JavaScript">alert("Success");</script>
<script language="JavaScript">window.location.href = "edit_user.php";</script>