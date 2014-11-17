<?php include("check_session.php"); ?>
<?php
$con=mysqli_connect("localhost","root","password","logon");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

$sql="INSERT INTO admin (User_ID, Username, Name, Status, Password)
VALUES
('$_POST[User_ID]','$_POST[Username]','$_POST[Name]','$_POST[Status]','$_POST[Password]')";

if (!mysqli_query($con,$sql))
  {
  die('Error: ' . mysqli_error($con));
  }

mysqli_close($con);
echo "<meta http-equiv=\"refresh\" content=\"0;URL=manage_user.php\">";
?>
