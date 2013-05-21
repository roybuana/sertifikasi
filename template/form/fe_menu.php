<?php
	require_once('../../lib/fn_lib.php');
	session_start();
	isAjax();
	privilegesPage();
	$data = array();
	$id = mysql_real_escape_string(preg_replace('/[^0-9]/','',$_REQUEST['id']));
	$z = mysql_query("SELECT * FROM menu WHERE id='$_GET[id]'"); 
    //$y = mysql_query("SELECT * FROM media_tb WHERE id='$_GET[id]'");
	if(!$z || mysql_num_rows($z) != 1){
		$data['status'] = "error";
		$data['message'] = "Data not valid";
		echo json_encode($data);	
	}else{
		$rowdata = mysql_fetch_array($z);
		$data['status'] = "success";
        $data['id'] = $rowdata['id'];
		$data['id_group_users'] = $rowdata['id_group_users'];
		$data['nm_menu'] = $rowdata['nm_menu'];
        $data['id_module']= $rowdata['id_module'];
        $data['id_menu'] = $rowdata['id_menu'];
        $data['no_urut'] = $rowdata['no_urut'];
        $data['id_tag'] = $rowdata['id_tag'];
        $data['class_tag'] = $rowdata['class_tag'];
        $data['icon_tag'] = $rowdata['icon_tag'];
        $data['status_aktif'] = $rowdata['status_aktif'];
       
       
		echo json_encode($data);
	}
?>