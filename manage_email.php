<?php
    mysql_connect("localhost", "root", "password");
    mysql_select_db("logon");
    $query = "SELECT * FROM email where id = '001'";
    $result = mysql_query($query);
    $rows = mysql_fetch_array($result);?>
	<form name="form1" method="post" action="edit_email.php">
		<table width="478" border="1" style="width: 600px">
                                        <tbody>  
                                            <tr>
                                                <td width="157"> Username</td>
                                                <td width="305"><input type="text" name="email" id="email" placeholder="<?php echo $rows['email']; ?>"></td>
                                            </tr>
                                           

                                        </tbody>
                                    </table>
                                    <br>
                                    <input type="submit" name="Submit" value="Change">
                                </form>

