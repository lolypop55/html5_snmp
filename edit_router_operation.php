<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

mysql_connect("localhost", "root", "password");
mysql_select_db("logon");

isset($_POST['Router_ID']) ? $Router_ID = $_POST['Router_ID'] : $Router_ID = NULL;
isset($_POST['Router_IP']) ? $Router_IP = $_POST['Router_IP'] : $Router_IP = NULL;
isset($_POST['Router_Name']) ? $Router_Name = $_POST['Router_Name'] : $Router_Name = NULL;
isset($_POST['String']) ? $String = $_POST['String'] : $String = NULL;
isset($_POST['Remark']) ? $Remark = $_POST['Remark'] : $Remark = NULL;

if ($Router_ID == NULL || $Router_IP == NULL || $Router_Name == NULL || $Remark == NULL || $String == NULL) {
   echo 'Router_ID = ' . $Router_ID . ' Router_IP = ' . $Router_IP . ' Router_Name = ' . $Router_Name . ' String = ' . $String . ' Remark = ' . $Remark; 
    ?>
    <script language="JavaScript">alert("Incorrectly Redirect");</script>
    <script language="JavaScript">window.location.href = "login.html";</script>
    <?php
}

$Router_ID = stripcslashes($Router_ID);
$String = stripcslashes($String);
$Router_IP = stripcslashes($Router_IP);
$Router_Name = stripcslashes($Router_Name);
$Remark = stripcslashes($Remark);

$Router_ID = mysql_real_escape_string($Router_ID);
$String = mysql_real_escape_string($String);
$Router_IP = mysql_real_escape_string($Router_IP);
$Router_Name = mysql_real_escape_string($Router_Name);
$Remark = mysql_real_escape_string($Remark);
/*
$query = "SELECT COUNT(Remark) AS COUNTIT FROM admin WHERE (Remark = '$Remark') AND (Router_ID = '$userId')";
$result = mysql_query($query);
$count = mysql_fetch_array($result);
if ($count['COUNTIT'] != 1) {
    ?>
    <script language="JavaScript">alert("Wrong Remark");</script>
    <script language="JavaScript">window.location.href = "login.html";</script>
    <?php
}
*/
$query = "UPDATE router SET Router_IP = '$Router_IP', Router_Name = '$Router_Name', String = '$String', Remark = '$Remark'   WHERE Router_ID = '$Router_ID'";
mysql_query($query);
?>

<script language="JavaScript">alert("Success");</script>
<script language="JavaScript">window.location.href = "manage_router.php";</script>