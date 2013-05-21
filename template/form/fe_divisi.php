<?php
	require_once('../../lib/fn_lib.php');
	session_start();
	isAjax();
	privilegesPage();
	$data = array();
	$id = mysql_real_escape_string(preg_replace('/[^0-9]/','',$_REQUEST['id']));
	$z = mysql_query("SELECT * FROM media_tb WHERE id='$_GET[id]'");
    //$y = mysql_query("SELECT * FROM media_tb WHERE id='$_GET[id]'");
	if(!$z || mysql_num_rows($z) != 1){
		$data['status'] = "error";
		$data['message'] = "Data not valid";
		echo json_encode($data);	
	}else{
		$rowdata = mysql_fetch_array($z);
		$data['status'] = "success";
        $data['id'] = $rowdata['id'];
		$data['judul'] = $rowdata['judul'];
		$data['episode'] = $rowdata['episode'];
        $data['noKontrak'] = $rowdata['noKontrak'];
        $data['jenisKontrak'] = $rowdata['jenisKontrak'];
        $data['tglAwalKontrak'] = $rowdata['tglAwalKontrak'];
        $data['tglAkhirKontrak'] = $rowdata['tglAkhirKontrak'];
        $data['batasPutar'] = $rowdata['batasPutar'];
        $data['jenisTayang'] = $rowdata['jenisTayang'];
        $data['jumlahSegmen'] = $rowdata['jumlahSegmen'];
        $data['sinopsis'] = $rowdata['sinopsis'];
        $data['channel_id'] = $rowdata['channel_id'];
        
       
		echo json_encode($data);
	}
?>