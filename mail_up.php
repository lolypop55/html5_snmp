<?php include("check_session.php"); ?>
<html>
<head>
<title>SNMP MANAGER</title>
</head>
<body>
<?php
	mysql_connect("localhost", "root", "password");
    mysql_select_db("logon");
    $query = "SELECT * FROM email where id = '001'";
    $result = mysql_query($query);
    $rows = mysql_fetch_array($result);
	$emails =$rows['email']
	require_once('googlemail/class.phpmailer.php');
	$mail = new PHPMailer();
	$mail->IsHTML(true);
	$mail->IsSMTP();
	$mail->SMTPAuth = true; // enable SMTP authentication
	$mail->SMTPSecure = "ssl"; // sets the prefix to the servier
	$mail->Host = "smtp.gmail.com"; // sets GMAIL as the SMTP server
	$mail->Port = 465; // set the SMTP port for the GMAIL server
	$mail->Username = "gust4evergust@gmail.com"; // GMAIL username
	$mail->Password = "joke1234+"; // GMAIL password
	$mail->From = "webmaster@thaicreate.com"; // "name@yourdomain.com";
	//$mail->AddReplyTo = "support@thaicreate.com"; // Reply
	$mail->FromName = "SNMP MANAGER SERVICE";  // set from Name
	$mail->Subject = "Router in Topology Up."; 
	$mail->Body = "<b>".$_SESSION["nameup"]."UP!"."</b>";

	$mail->AddAddress("$emails", "Administrator"); // to Address


	//$mail->AddCC("member@thaicreate.com", "Mr.Member ShotDev"); //CC
	//$mail->AddBCC("member@thaicreate.com", "Mr.Member ShotDev"); //CC

	$mail->set('X-Priority', '1'); //Priority 1 = High, 3 = Normal, 5 = low

	$mail->Send(); 
?>
</body>
</html>