<?php
	require_once('../../lib/fn_lib.php');
	session_start();
	//isAjax();
//	privilegesPage();
	$query = mysql_query("SELECT * FROM golongan");
	$cb = array();
	if(mysql_num_rows($query) > 0){
		while($rows=mysql_fetch_array($query)){
			$result = array();
			$result['id'] = $rows['id'];
			$result['text'] = $rows['groups'];
			$cb[] = $result;
		}	
	}
	echo json_encode($cb);
?>