<?php
    mysql_connect("localhost", "root", "password");
    mysql_select_db("logon");
    isset($_GET['id']) ? $userId = $_GET['id'] : $userId = NULL;
    $userId = stripcslashes($userId);
    $userId = mysql_real_escape_string($userId);
    $query = "SELECT * FROM router where Router_IP = '$userId'";
    $result = mysql_query($query);
    $rows = mysql_fetch_array($result);
?> 