<?php
	require_once('../../lib/fn_lib.php');
	session_start();
	isAjax();
	privilegesPage();
	$data = array();
	$id = mysql_real_escape_string(preg_replace('/[^0-9]/','',$_REQUEST['id']));
	$z = mysql_query("SELECT * FROM jabatan WHERE id_jabatan='$_GET[id]'");
    //$y = mysql_query("SELECT * FROM media_tb WHERE id='$_GET[id]'");
	if(!$z || mysql_num_rows($z) != 1){
		$data['status'] = "error";
		$data['message'] = "Data not valid";
		echo json_encode($data);	
	}else{
		$rowdata = mysql_fetch_array($z);
		$data['status'] = "success";
        $data['id'] = $rowdata['id'];
		$data['id_golongan'] = $rowdata['id_golongan'];
		$data['jabatan'] = $rowdata['jabatan'];
        $data['id_parent'] = $rowdata['id_parent'];
        $data['id_jabatan'] = $rowdata['id_jabatan'];
        $data['status_aktif'] = $rowdata['status_aktif'];
       
       
		echo json_encode($data);
	}
?>