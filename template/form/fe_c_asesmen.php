<?php
	require_once('../../lib/fn_lib.php');
	session_start();
	isAjax();
	privilegesPage();
	$data = array();
	$id = mysql_real_escape_string(preg_replace('/[^0-9]/','',$_REQUEST['id']));
	$z = mysql_query("SELECT cps.id,cps.status_form,cps.tgl_asesmen,cps.status_aktif,users.users FROM
    cps JOIN users On users.id=cps.id_users WHERE cps.id='$_GET[id]'");
    
    //$y = mysql_query("SELECT * FROM media_tb WHERE id='$_GET[id]'");
	if(!$z || mysql_num_rows($z) != 1){
		$data['status'] = "error";
		$data['message'] = "Data not valid";
		echo json_encode($data);	
	}else{
		$rowdata = mysql_fetch_array($z);
		$data['status'] = "success";
        $data['id'] = $rowdata['id'];
		$data['status_form'] = $rowdata['status_form'];
		$data['status_aktif'] = $rowdata['status_aktif'];
        $data['tgl_asesmen'] = $rowdata['tgl_asesmen'];
        
        $data['users'] = $rowdata['users'];
       
       
		echo json_encode($data);
	}
?>