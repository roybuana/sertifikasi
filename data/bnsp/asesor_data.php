<?php
	require_once("../../lib/fn_lib.php");
	session_start();
	isAjax();
	privilegesPage();
	$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
	$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 300;
     $ia = isset($_POST['ia']) ? mysql_real_escape_string($_POST['ia']) : '';
  
	$offset = ($page-1)*$rows;

	$result = array();
	$where = "asesor.id like '%$ia%'";
	$rs = mysql_query("select count(*) FROM 
    asesor
LEFT JOIN lsp ON asesor.id_lsp=lsp.id
LEFT JOIN asesor_type ON asesor_type.id=asesor.id_asesor_type
     WHERE ".$where);
	$row = mysql_fetch_row($rs);
	$result["total"] = $row[0];
	if($result["total"]==0){
	   $row2[] =	array("kode"=>"No Record");
       $result["rows"] = $row2;
       echo json_encode($result); 
	}else{
	  
	   $rs = mysql_query("SELECT asesor.*,
lsp.rlsp_nama,
asesor_type.asesor_type
FROM asesor
LEFT JOIN lsp ON asesor.id_lsp=lsp.id
LEFT JOIN asesor_type ON asesor_type.id=asesor.id_asesor_type
        WHERE ".$where." ORDER BY asesor.id_auto DESC limit $offset,$rows");
	   while($record = mysql_fetch_array($rs)){
	   $row2[] =	array("kode"=>$record['id'],
       "id_auto"=>$record['id_auto'],
       "id_users"=>$record['id_users'],
       "rprop_kode"=>$record['rprop_kode'],
       "rkota_kode"=>$record['rkota_kode'],
       "rgender_kode"=>$record['rgender_kode'],
       "rtasesor_kode"=>$record['rtasesor_kode'],
       "rasesor_nama"=>$record['rasesor_nama'],
       "rasesor_alamat"=>$record['rasesor_alamat'],
       "rasesor_kdpos"=>$record['rasesor_kdpos'],
       "rasesor_telp"=>$record['rasesor_telp'],
       "rasesor_email"=>$record['rasesor_email'],
       "rasesor_dstart"=>$record['rasesor_dstart'],
       "rasesor_dend"=>$record['rasesor_dend'],
       "rasesor_jkom"=>$record['rasesor_jkom'],
       "status_aktif"=>$record['status_aktif'],
       "rlsp_nama"=>$record['rlsp_nama'],
       "asesor_type"=>$record['asesor_type']
       );		
	}
    $result["rows"] = $row2;
    
    echo json_encode($result);   
	}
?>