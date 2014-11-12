<?php
$con=mysqli_connect("localhost","root","password","logon");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

$sql="INSERT INTO router (Router_ID, Router_Name, Router_IP, String, Remark)
VALUES
('$_POST[Router_ID]','$_POST[Router_Name]','$_POST[Router_IP]','$_POST[String]','$_POST[Remark]')";

if (!mysqli_query($con,$sql))
  {
  die('Error: ' . mysqli_error($con));
  }

mysqli_close($con);

echo "<meta http-equiv=\"refresh\" content=\"0;URL=admin_page5.php\">";
?>
