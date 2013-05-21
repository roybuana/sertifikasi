<?php
	require_once("../lib/fn_lib.php");
	session_start();
    $sid=$_SESSION['id'];
	isAjax();
	privilegesPage();
	$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
	$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 300;
     $ia = isset($_POST['ia']) ? mysql_real_escape_string($_POST['ia']) : '';
    $ib = isset($_POST['ib']) ? mysql_real_escape_string($_POST['ib']) : '';
  
	$offset = ($page-1)*$rows;

	$result = array();
	$where = "sertifikat.no like '%$ia%' AND sertifikat.tgl_terbit like '%$ib%'";
	$rs = mysql_query("select count(*) FROM sertifikat WHERE ".$where);
	$row = mysql_fetch_row($rs);
	$result["total"] = $row[0];
	if($result["total"]==0){
	   $row2[] =	array("no"=>"No Record");
       $result["rows"] = $row2;
       echo json_encode($result); 
	}else{
	  
	   $rs = mysql_query("
       SELECT * FROM sertifikat WHERE ".$where." ORDER BY sertifikat.tgl_terbit DESC limit $offset,$rows");
	   while($record = mysql_fetch_array($rs)){
	   $row2[] =	array("kode"=>$record['id'],
       "no"=>$record['no'],
       "id_formulir"=>$record['id_formulir'],
       "tgl_terbit"=>$record['tgl_terbit'],
       "masa_berlaku"=>$record['masa_berlaku'],
       "lsp_id"=>$record['lsp_id']);		
	}
    $result["rows"] = $row2;
    
    echo json_encode($result);   
	}
?>