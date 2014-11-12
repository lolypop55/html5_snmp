							<?php
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

									$sql = "SELECT router_name, router_ip, date, time FROM log";
									$result = $conn->query($sql);

									if ($result->num_rows > 0) {
										 // output data of each row
											echo "<br>";
										 while($row = $result->fetch_assoc()) {
											 echo "<br>". $row["router_name"]."\t".  $row["router_ip"]."\t". $row["date"] ."\t". $row["time"]. "<br>";
										 }
									} else {
										echo "<br> Non Log";
									}

									$conn->close();
                         
?>