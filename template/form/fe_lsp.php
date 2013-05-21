<?php
	require_once('../../lib/fn_lib.php');
	session_start();
	isAjax();
	privilegesPage();
	$data = array();
	$id = mysql_real_escape_string(preg_replace('/[^0-9]/','',$_REQUEST['id']));
	$z = mysql_query("SELECT * FROM lsp WHERE id='$_GET[id]'");
    //$y = mysql_query("SELECT * FROM media_tb WHERE id='$_GET[id]'");
	if(!$z || mysql_num_rows($z) != 1){
		$data['status'] = "error";
		$data['message'] = "Data not valid";
		echo json_encode($data);	
	}else{
	         
		$rowdata = mysql_fetch_array($z);
		$data['status'] = "success";
        $data['id'] = $rowdata['id'];
        $data['id_auto'] = $rowdata['id_auto'];
		$data['rlsp_nama'] = $rowdata['rlsp_nama'];
		$data['rlsp_nolis'] = $rowdata['rlsp_nolis'];
        $data['rlsp_dberdiri'] = $rowdata['rlsp_dberdiri'];
        $data['rlsp_doperasi'] = $rowdata['rlsp_doperasi'];
         $data['rlsp_dlic'] = $rowdata['rlsp_dlic'];
         $data['rlsp_alamat'] = $rowdata['rlsp_alamat'];
         $data['rlsp_telp'] = $rowdata['rlsp_telp'];
         $data['rlsp_fax'] = $rowdata['rlsp_fax'];
         $data['rlsp_email'] = $rowdata['rlsp_email'];
         $data['rlsp_url'] = $rowdata['rlsp_url'];
         $data['rlsp_kodepos'] = $rowdata['rlsp_kodepos'];
         
        $data['status_aktif'] = $rowdata['status_aktif'];
       
       
		echo json_encode($data);
	}
?>