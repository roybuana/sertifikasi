<?php
	require_once('../../lib/fn_lib.php');
	session_start();
	isAjax();
	privilegesPage();
	$data = array();
	$id = mysql_real_escape_string(preg_replace('/[^0-9]/','',$_REQUEST['id']));
	$z = mysql_query("SELECT * FROM group_users WHERE id=$id");
    //$y = mysql_query("SELECT * FROM media_tb WHERE id_golongan='$_GET[id_golongan]'");
	if(!$z || mysql_num_rows($z) != 1){
		$data['status'] = "error";
		$data['message'] = "Data not valid";
		echo json_encode($data);	
	}else{
		$rowdata = mysql_fetch_array($z);
		$data['status'] = "success";
        $data['kode'] = $rowdata['id'];
		$data['group_users'] = $rowdata['group_users'];
		 $data['parent'] = $rowdata['parent'];
        $data['status_aktif'] = $rowdata['status_aktif'];
        
       
		echo json_encode($data);
	}
?>