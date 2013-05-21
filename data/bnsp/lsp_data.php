<?php
	require_once("../../lib/fn_lib.php");
	session_start();
	isAjax();
	privilegesPage();
	$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
	$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
     $ia = isset($_POST['ia']) ? mysql_real_escape_string($_POST['ia']) : '';
     $ib = isset($_POST['ib']) ? mysql_real_escape_string($_POST['ib']) : '';
      $ic = isset($_POST['ic']) ? mysql_real_escape_string($_POST['ic']) : '';
      
	$offset = ($page-1)*$rows;

	$result = array();
	$where = "id like '%$ia%' AND rlsp_nama like '%$ib%' AND status_aktif like '%$ic%'";
	$rs = mysql_query("select count(id) FROM lsp WHERE ".$where);
	$row = mysql_fetch_row($rs);
	$result["total"] = $row[0];
	if($result["total"]==0){
	   $row2[] =	array("kode"=>"No Record");
       $result["rows"] = $row2;
       echo json_encode($result); 
	}else{
	 
 
	   $rs = mysql_query("SELECT * FROM lsp WHERE ".$where." ORDER BY id ASC limit $offset,$rows");
        while($record = mysql_fetch_array($rs)){
    	   $row2[] =	array(
           "kode"=>$record['id'],
           "id_auto"=>$record['id_auto'],
           "rprop_kode"=>$record['rprop_kode'],
           "rkota_kode"=>$record['rkota_kode'],
           "rlsp_nama"=>$record['rlsp_nama'],
           "rlsp_alamat"=>$record['rlsp_alamat'],
           "rlsp_kodepos"=>$record['rlsp_kodepos'],
           "rlsp_telp"=>$record['rlsp_telp'],
           "rlsp_fax"=>$record['rlsp_fax'],
           "rlsp_email"=>$record['rlsp_email'],
           "rlsp_url"=>$record['rlsp_url'],
           "rlsp_nolis"=>$record['rlsp_nolis'],
           "rlsp_dberdiri"=>$record['rlsp_dberdiri'],
           "rlsp_doperasi"=>$record['rlsp_doperasi'],
           "rlsp_dlic"=>$record['rlsp_dlic'],
           "status_aktif"=>$record['status_aktif'],
           "id_users"=>$record['id_users'],
           );		
    	}
    $result["rows"] = $row2;
    
    echo json_encode($result);   
	}
?>