                               <?php

							   function myErrorHandler($errno, $errstr, $errfile, $errline) {
								global $isDown;
									if (!(error_reporting() & $errno)) {
										// This error code is not included in error_reporting
										return;
									}
									if ($errno == 2) {
										$isDown = TRUE;
									}
								}
                                $host = "localhost"; // Host name 
                                $username = "root"; // Mysql username 
                                $password = "password"; // Mysql password 
                                $db_name = "logon"; // Database name 
                                $tbl_name = "router"; // Table name 
                                // Connect to server and select databse.
                                //=========================================
                                mysql_connect("$host", "$username", "$password")or die("cannot connect");
                                mysql_select_db("$db_name")or die("cannot select DB");

                                $sql = "SELECT * FROM $tbl_name";
                                $result = mysql_query($sql);

                                $count = mysql_num_rows($result);
                                //=========================================
                                ?>

                                <table width="400" border="0" cellspacing="1" cellpadding="0">
                                    <tr>
                                        <td><form action="admin_page5.php" method="post" >
                                                                                                   <tr>
                                                        <td width="20" bgcolor="#FFFFFF">&nbsp;</td>
                                                        
                                                    </tr>
                                                    <tr>
                                                        <td align="center" bgcolor="#FFFFFF">#</td>
                                                        <td width="73" align="center" bgcolor="#FFFFFF"><strong>Router_ID</strong></td>
                                                        <td width="95" align="center" bgcolor="#FFFFFF"><strong>Router_Name</strong></td>
                                                        <td width="70" align="center" bgcolor="#FFFFFF"><strong>Router_IP</strong></td>
                                                        <td width="55" align="center" bgcolor="#FFFFFF"><strong>Remark</strong></td>
                                                        <td width="57" align="center" bgcolor="#FFFFFF"><strong>System Descript</strong></td>
                                                        <td width="48" align="center" bgcolor="#FFFFFF"><strong>Uptime</strong></td>
                                                        <td width="53" align="center" bgcolor="#FFFFFF"><strong>System Name</strong></td>
                                                        <td width="58" align="center" bgcolor="#FFFFFF"><strong>System Location</strong></td>
                                                        <td width="72" align="center" bgcolor="#FFFFFF"><strong>Status</strong></td>
                                                    </tr>

                                                    <?php
                                                    set_error_handler("myErrorHandler");

                                                    while ($rows = mysql_fetch_array($result)) {
                                                        $snmpSysDescr = null;
                                                        $snmpSysUptime = null;
                                                        $snmpSysName = null;
                                                        $snmpSysLocation = null;
                                                        $snmpSysDescr = snmpwalk($rows['Router_IP'], $rows['String'], "1.3.6.1.2.1.1.1",3000);
                                                        if (!$isDown) {
                                                            $snmpSysUptime = snmpget($rows['Router_IP'], $rows['String'], "sysUpTime.0",3000);
		                                                    $snmpSysName = snmpwalk($rows['Router_IP'], $rows['String'], "1.3.6.1.2.1.1.5",3000);
                                                            $snmpSysLocation = snmpwalk($rows['Router_IP'], $rows['String'], "1.3.6.1.2.1.1.6",3000);
                                                        }
                                                        ?>

                                                        <tr>
                                                            <td align="center" bgcolor="#FFFFFF"><input name="checkbox[]" type="checkbox" id="checkbox[]" value="<?php echo $rows['Router_Name']; ?>"></td>
                                                            <td bgcolor="#FFFFFF"><center><?php echo $rows['Router_ID']; ?></center></td>
                                                            <td bgcolor="#FFFFFF"><center><?php echo $rows['Router_Name']; ?></center></td>
                                                            <td bgcolor="#FFFFFF"><center><?php echo $rows['Router_IP']; ?></center></td>
                                                            <td bgcolor="#FFFFFF"><center><?php echo $rows['Remark']; ?></center></td>                                                
                                                            <td bgcolor="#FFFFFF"><?php if ($isDown)
                                                        echo "---";
                                                    else{
														$val = explode(":", $snmpSysDescr[0]);
                                                        echo "<center>".$val[1]."</center>";
													}
                                                        ?></td>
                                                            <td bgcolor="#FFFFFF"><?php if ($isDown){
                                                                echo "---";
																if ($_SESSION["status".$rows['Router_Name']]!="down"){
																		$_SESSION["status".$rows['Router_Name']] = "down";
																		$_SESSION["check".$rows['Router_Name']] = "down in if ".date("h:i:sa");
																		$_SESSION["namedown"]=$rows['Router_Name'];
																		include "mail_down.php";
																		
																}else{
																		$_SESSION["check".$rows['Router_Name']] = "down in else".date("h:i:sa");

																		//include "mail_down.php";
																		//send mail
																}


																$txt = $rows['Router_Name']."\t".$rows['Router_IP']."\t".date("Y-m-d")."\t".date("h:i:sa");
																fwrite($myfile, $txt.PHP_EOL);
																$var1 = $rows['Router_Name'];
																$var2 = $rows['Router_IP'];
																$var3 = date("Y-m-d");
																$var4 = date("h:i:sa");
																$servername = "localhost";
																$username = "root";
																$password = "password";
																$dbname = "logon";

																// Create connection
																$conn = new mysqli($servername, $username, $password, $dbname);
																$sql="INSERT INTO log (router_name, router_ip, date,time)
																VALUES('$var1','$var2','$var3','$var4')";
																if ($conn->query($sql) === TRUE) {
																	} 
																	else {
																	echo "Error: " . $sql . "<br>" . $conn->error;
																}
															
														}else{																
																echo "<center>".$snmpSysUptime."</center>";
																if ($_SESSION["status".$rows['Router_Name']]!="up"){
																		$_SESSION["status".$rows['Router_Name']] = "up";
																		$_SESSION["check".$rows['Router_Name']] = "up in if ".date("h:i:sa");
																		$_SESSION["nameup"]=$rows['Router_Name'];
																		include "mail_up.php";
																		
																}else{
																		$_SESSION["check".$rows['Router_Name']] = "up in else".date("h:i:sa");

																		//include "mail_down.php";
																		//send mail
																}
															
														}
                                                                ?></td>
                                                            <td bgcolor="#FFFFFF"><?php if ($isDown){
                                                                echo "---";
																}else
                                                                echo "<center>".eregi_replace("STRING:","",$snmpSysName[0])."</center>";
                                                            ?></td>
                                                            <td bgcolor="#FFFFFF"><?php if ($isDown)
                                                    echo "---";
                                                else{
                                                    echo "<center>".eregi_replace("STRING:","",$snmpSysLocation[0])."</center>";
                                                   
												}?></td-->
                                                            <td bgcolor="#FFFFFF"><?php if ($isDown)
                                                    echo "<center>"."<img src=\"images/Offline.png\" height=\"16\" width=\"16\">"."</center>";
                                                else
                                                    echo "<center>"."<img src=\"images/Online.png\" height=\"16\" width=\"16\">"."</center>";
                                                    ?></td>
                                                        </tr>

														<?php
														$isDown = FALSE;
													}
													?>

                                                    <tr>
                                                        <td colspan="4" align="left" bgcolor="#FFFFFF">
                                                            <input name="add" type="submit" id="add" value="Add">
                                                            <input name="delete" type="submit" id="delete" value="Delete">
                                                        </td>
                                                        <td colspan="6" align="left" bgcolor="#FFFFFF"></td>
                                                    </tr>
													
                                                 <!--  <tr>
                                                        <td colspan="10" align="left" bgcolor="#FFFFFF">Refresh Every 
                                                            <select name="timeRefresh" id="timeRefresh">

                                                                
                                                                <option value="5">5 Sec.</option>
																<option value="3">3 Sec.</option>
                                                                <option value="10">10 Sec.</option>

                                                            </select><input name="refresh" type="button" value="Refresh" /></td>
                                                    </tr>
												-->
                                                    <?php
                                                    // Check if delete button active, start this
                                                    //==========================================
                                                    if (isset($_POST["delete"])) {
                                                        $routerList = $_POST["checkbox"];
                                                        for ($i = 0; $i < count($routerList); $i++) {
                                                            $sql = "DELETE FROM $tbl_name WHERE Router_Name='$routerList[$i]'";
                                                            $sql2 = "DROP TABLE $routerList[$i]";
                                                            $result = mysql_query($sql);
                                                            $result2 = mysql_query($sql2);
                                                        }
                                                        echo "<meta http-equiv=\"refresh\" content=\"0;URL=admin_page5.php\">";
                                                    }
                                                    /* ($delete) {
                                                      for ($i = 0; $i < $count; $i++) {
                                                      $del_id = $checkbox[$i];
                                                      $sql = "DELETE FROM $tbl_name WHERE Router_Name='$del_id'";
                                                      $sql2 = "DROP TABLE $del_id";
                                                      $result = mysql_query($sql);
                                                      $result2 = mysql_query($sql2);
                                                      }
                                                      // if successful redirect to delete_multiple.php
                                                      if ($result) {
                                                      echo "<meta http-equiv=\"refresh\" content=\"0;URL=admin_page.php\">";
                                                      }
                                                      } */
                                                    if (isset($_POST["add"]))
                                                        echo "<meta http-equiv=\"refresh\" content=\"0;URL=add_router.php\">";

													if (isset($_POST["refresh"])){
                                                        echo "EIEI!";
														$ro = $_POST["timeRefresh"];
														if ($ro==10)
															echo "<meta http-equiv=\"refresh\" content=\"0;URL=admin_page10.php\">";
														if ($ro==5)
															echo "<meta http-equiv=\"refresh\" content=\"0;URL=admin_page5.php\">";
														if ($ro==3)
															echo "<meta http-equiv=\"refresh\" content=\"0;URL=admin_page3.php\">";

													}
                                                    mysql_close();
													
                                                    ?>
