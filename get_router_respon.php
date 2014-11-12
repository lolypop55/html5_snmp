<?php
//snmpget system stats

//header("Refresh: 3; URL=new_respon.php");
/*if (ini_set('max_execution_time',10)){
	?>
     <script language="JavaScript">alert("Something is Error!!!");</script>
     <script language="JavaScript">window.location.href = "view.php";</script>
<?php 
} 
*/

	ini_set('max_execution_time',5);
	error_reporting(0);
	

	$host = $_GET["Router_IP"];
	//$host = "192.168.0.1";
	$servername = "localhost";
$username = "root";
$password = "password";
$dbname = "logon";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT Router_Name 	,Router_IP 	,Router_ID 	,String ,Remark  FROM router WHERE Router_IP='$host'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo $row["String"]."<br>";
		$tmp =  $row["String"];
    }
} else {
    echo "0 results";
}

 //echo $tmp;
$conn->close();

	$community = $tmp;

	//get system name
	$sysname = snmpget($host, $community, "system.sysName.0");

	//get system uptime
	$sysup = snmpget($host, $community, "system.sysUpTime.0");
	$sysupre = eregi_replace("([0-9]{3})","",$sysup);
	$sysupre2 = eregi_replace("Timeticks:","",$sysupre);
	$sysupre3 = eregi_replace("[()]","",$sysupre2);


	//Joke Code
	$sysDescr = snmpget($host, $community, "sysDescr.0");
	$sysContact = snmpget($host, $community, "sysContact.0");
	$sysLocation = snmpget($host, $community, "sysLocation.0");


	//End joke

	//get tcp connections
	$tcpcon = snmpget($host, $community,"tcp.tcpCurrEstab.0");
	$tcpconre = eregi_replace("Gauge32:","",$tcpcon);

	echo '
	Opeation Name: '.eregi_replace("STRING:","",$sysDescr),'<br>
	System Name: '.eregi_replace("STRING:","",$sysname).'<br>
	Admin Name: '.eregi_replace("STRING:","",$sysContact).'<br>
	Location: '.eregi_replace("STRING:","",$sysLocation).'<br>
	System Uptime: '.$sysup.'<br>';
	//print time on system
	$systime = snmpget($host, $community, ".1.3.6.1.4.1.2021.100.4.0");
	echo "Time on system:";
	echo eregi_replace("STRING:","",$systime);
	echo "<br>";


	//check wan ip
	echo "<br>";
	echo "IP WAN CONNECT";
	echo "<br>";
	$ipAdEntAddr = snmpwalk($host, $community, "ipAdEntAddr");
	/*echo "<br>";
	for ($i=0; $i<count($ipAdEntAddr); $i++){
		echo "Ip wan : ".$ipAdEntAddr[$i].".";
		echo "<br>";
	}
	*/
	echo "IP Wan Router :".eregi_replace("IpAddress:","",$ipAdEntAddr[2]).".";
	echo "<br>";
	echo "IP Router :".eregi_replace("IpAddress:","",$ipAdEntAddr[3]).".";
	echo "<br>";

	//check mac connect
	echo "<br>";
	echo "Mac Address connect in lan";
	$atPhysAddress = snmpwalk($host, $community, "atPhysAddress");
	echo "<br>";
	for ($i=0; $i<count($atPhysAddress); $i++){
		echo eregi_replace("Hex-STRING:","",$atPhysAddress[$i]);
		echo "<br>";
	}
	echo "<br>";

	//check ip address connect
	echo "IP connect in lan";
	$ipNetToMediaNetAddress = snmpwalk($host, $community, "ipNetToMediaNetAddress");
	echo "<br>";
	for ($i=0; $i<count($ipNetToMediaNetAddress); $i++){
		echo eregi_replace("IpAddress:","",$ipNetToMediaNetAddress[$i]);
		echo "<br>";
	}
	echo "<br>";

	//check wifi connect status
	echo "##Wifi Device Status##";
	echo "<br>";
	echo "<br>";
	echo "Mac address of wifi device";
	$macwifi = snmpwalk($host, $community, ".1.3.6.1.4.1.2021.255.3.54.1.3.32.1.4");
	echo "<br>";
	for ($i=0; $i<count($macwifi); $i++){
		echo "{".$i."}>>";
		echo eregi_replace("Hex-STRING:","",$macwifi[$i]);
		echo "<br>";
	}
	echo "<br>";

	//check wifi connect noise
	echo "Noise Signal of wifi device";
	$signalwifi = snmpwalk($host, $community, ".1.3.6.1.4.1.2021.255.3.54.1.3.32.1.13");
	echo "<br>";
	for ($i=0; $i<count($signalwifi); $i++){
		echo "{".$i."}>>";
		echo eregi_replace("INTEGER:","",$signalwifi[$i]);
		echo "<br>";
	}
	echo "<br>";

	//check wifi connect snr
	echo "SNR Signal of wifi device";
	$snrwifi = snmpwalk($host, $community, ".1.3.6.1.4.1.2021.255.3.54.1.3.32.1.26");
	echo "<br>";
	for ($i=0; $i<count($snrwifi); $i++){
		echo "{".$i."}>>";
		echo eregi_replace("INTEGER:","",$snrwifi[$i]);
		echo "<br>";
	}





?>