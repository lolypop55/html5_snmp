<?php

mysql_connect("localhost", "root", "password");
mysql_select_db("logon");
$strSQL = "SELECT * FROM admin WHERE Username = 
'" . mysql_real_escape_string($_POST['txtUsername']) . "'
	and Password = 
'" . mysql_real_escape_string($_POST['txtPassword']) . "'";
$objQuery = mysql_query($strSQL);
$objResult = mysql_fetch_array($objQuery);
if (!$objResult) {
   	?>
     <script language="JavaScript">alert("Username and Password Incorrect!");</script>
     <script language="JavaScript">window.location.href = "login.html";</script>
<?php } 
else {
    session_start();
    $_SESSION["UserID"] = $objResult["UserID"];
    $_SESSION["Status"] = $objResult["Status"];
    session_write_close();
    if ($objResult["Status"] == "ADMIN") {
        header("location:admin_page5.php");
    } else {
        header("location:user_page.php");
    }
}
mysql_close();
?>
