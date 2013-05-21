<?php
	require_once('../../lib/fn_lib.php');
	session_start();
	isAjax();
	privilegesPage();
	$data = array();
	$id = mysql_real_escape_string(preg_replace('/[^0-9]/','',$_REQUEST['id']));
	$z = mysql_query("SELECT * FROM kegiatan WHERE id_kegiatan='$_GET[id]'");
    //$y = mysql_query("SELECT * FROM media_tb WHERE id='$_GET[id]'");
	if(!$z || mysql_num_rows($z) != 1){
		$data['status'] = "error";
		$data['message'] = "Data not valid";
		echo json_encode($data);	
	}else{
		$rowdata = mysql_fetch_array($z);
		$data['status'] = "success";
        $data['id'] = $rowdata['id'];
        
		$data['id_category_kegiatan'] = $rowdata['id_category_kegiatan'];
        $data['id_kegiatan'] = $rowdata['id_kegiatan'];
		$data['nm_kegiatan'] = $rowdata['nm_kegiatan'];
        $data['tgl_mulai'] = $rowdata['tgl_mulai'];
        $data['tgl_akhir'] = $rowdata['tgl_berakhir'];
        $data['pic_bnsp'] = $rowdata['pic_bnsp'];
        $data['pic_sekretariat'] = $rowdata['pic_sekretariat'];
        $data['tempat'] = $rowdata['tempat'];        
        $data['status_aktif'] = $rowdata['status_aktif'];
       
       
		echo json_encode($data);
	}
?>
