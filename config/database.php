<?php
$host = "localhost"; 
	$db = "bnsp_db";
	$user_db = "root";
	$pass_db = "";
	/**
	 * 
     * $db = "k4475946_intala2_db";
	$user_db = "k4475946_intala2";
	$pass_db = "400485Aa";
	 */
    //$pass_db = "root31170";
	$connect = mysql_connect($host,$user_db,$pass_db);
	mysql_select_db($db);
    
?>