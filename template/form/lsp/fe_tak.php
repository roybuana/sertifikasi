<?php
	require_once('../../../lib/fn_lib.php');
	session_start();
	isAjax();
	privilegesPage();
	$data = array();
	$id = mysql_real_escape_string(preg_replace('/[^0-9]/','',$_REQUEST['id']));
	$z = mysql_query("SELECT * FROM tak WHERE id='$_GET[id]'");
    //$y = mysql_query("SELECT * FROM media_tb WHERE id='$_GET[id]'");
	if(!$z || mysql_num_rows($z) != 1){
		$data['status'] = "error";
		$data['message'] = "Data not valid";
		echo json_encode($data);	
	}else{
	   $data_object=mysql_fetch_object($z);
       
       $data_object->kode=$data_object->id;
       unset($data_object->id);
	
        /**
         * 	$rowdata = array();
        while($array_edit=mysql_fetch_array($z)){
         array_push($rowdata,$array_edit);   
        }
        
         * $data['status'] = "success";
        $data['id'] = $rowdata['id'];
		$data['id_golongan'] = $rowdata['id_golongan'];
		$data['nm_user'] = $rowdata['nm_user'];
        $data['username'] = $rowdata['username'];
        $data['nip'] = $rowdata['nip'];
         $data['id_jabatan'] = $rowdata['id_jabatan'];
        $data['status_aktif'] = $rowdata['status_aktif'];
         */
		
       
       
		echo json_encode($data_object);
	}
?>