<?php
	require_once('../../../lib/fn_lib.php');
	session_start();
	isAjax();
	privilegesPage();
	$data = array();
	$id = mysql_real_escape_string(preg_replace('/[^0-9]/','',$_REQUEST['id']));
	$z = mysql_query("SELECT * FROM asesor WHERE id='$_GET[id]'");
    //$y = mysql_query("SELECT * FROM media_tb WHERE id='$_GET[id]'");
	if(!$z || mysql_num_rows($z) != 1){
		$data['status'] = "error";
		$data['message'] = "Data not valid";
		echo json_encode($data);	
	}else{
	   $data_object=mysql_fetch_object($z);
       
       $data_object->kode=$data_object->id_auto;
       unset($data_object->id_auto);
		echo json_encode($data_object);
	}
?>