<?php
//session_start();
if(!isset($_SESSION)) 
    { 
        session_start(); 
    }

if (!isset( $_SESSION["Status"]))
	header("location:login.html");

?>