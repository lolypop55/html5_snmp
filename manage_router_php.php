<?php include("check_session.php"); ?>
 <?php
                                $host = "localhost"; // Host name 
                                $username = "root"; // Mysql username 
                                $password = "password"; // Mysql password 
                                $db_name = "logon"; // Database name 
                                $tbl_name = "router"; // Table name 
                                // Connect to server and select databse.
                                mysql_connect("$host", "$username", "$password")or die("cannot connect");
                                mysql_select_db("$db_name")or die("cannot select DB");

                                $sql = "SELECT * FROM $tbl_name";
                                $result = mysql_query($sql);

                                $count = mysql_num_rows($result);
                                ?>

                                <table width="400" border="0" cellspacing="1" cellpadding="0">
                                    <tr>
                                        <td><form action="manage_router.php" method="post" >
                                                <table width="400" border="0" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
                                                    <tr>
                                                        <td bgcolor="#FFFFFF">&nbsp;</td>
                                                        <td colspan="5" bgcolor="#FFFFFF"></td>
                                                        <td bgcolor="#FFFFFF">
                                                    </tr>
                                                    <tr>
													<td align="center" bgcolor="#FFFFFF">#</td>
                                                        <td align="center" bgcolor="#FFFFFF"><strong>Router_ID</strong></td>
                                                        <td align="center" bgcolor="#FFFFFF"><strong>Router_Name</strong></td>
                                                        <td align="center" bgcolor="#FFFFFF"><strong>Router_IP</strong></td>
                                                        <td align="center" bgcolor="#FFFFFF"><strong>String</strong></td>
                                                        <td align="center" bgcolor="#FFFFFF"><strong>Remark</strong></td>
														<td align="center" bgcolor="#FFFFFF"><strong></strong></td>
                                                        
                                                    </tr>

                                                    <?php
                                                    while ($rows = mysql_fetch_array($result)) {
                                                        ?>

                                                        <tr>
                                                            <td align="center" bgcolor="#FFFFFF"><input name="checkbox[]" type="checkbox" id="checkbox[]" value="<?php echo $rows['Router_ID'];?>"></td>                                                            
                                                            <td bgcolor="#FFFFFF"><center><?php echo $rows['Router_Name']; ?></center></td>
                                                            <td bgcolor="#FFFFFF"><center><?php echo $rows['Router_IP']; ?></center></td>
                                                            <td bgcolor="#FFFFFF"><center><?php echo $rows['String']; ?></center></td>
                                                            <td bgcolor="#FFFFFF"><center><?php echo $rows['Remark']; ?></center></td>
                                                            <td bgcolor="#FFFFFF"><center><a href="edit_router.php?id=<?php echo $rows['Router_IP']?>" class="button alt">Edit</a> </center></td>
                                                        </tr>

                                                        <?php
                                                    }
                                                    ?>

                                                    <tr>
                                                        <td colspan="5" align="left" bgcolor="#FFFFFF"><input name="add" type="submit" id="add" value="add">
                                                    <colspan="5" align="left" bgcolor="#FFFFFF"><input name="delete" type="submit" id="delete" value="delete">
                                                    </td><td bgcolor="#FFFFFF"><td bgcolor="#FFFFFF"</td>
                                                </tr>

                                                <?php
														// Check if delete button active, start this    
                                                if (isset($_POST["delete"])){
                                                    $userList = $_POST["checkbox"];
                                                    for ($i=0; $i<count($userList);$i++){
                                                        $sql = "DELETE FROM $tbl_name WHERE Router_IP='$userList[$i]'";
                                                        //$sql2 = "DROP TABLE $routerList[$i]";
                                                        $result = mysql_query($sql);
                                                        //$result2 = mysql_query($sql2);
                                                    }
                                                    echo "<meta http-equiv=\"refresh\" content=\"0;URL=manage_router.php\">";
                                                }
                                                if (isset($_POST["add"])) {
                                                    echo "<meta http-equiv=\"refresh\" content=\"0;URL=add_router.php\">";
                                                }
                                               
                                                mysql_close();
                                                ?>

                                        </table>
                                    </form>
                                </td>
                            </tr>
                        </table>