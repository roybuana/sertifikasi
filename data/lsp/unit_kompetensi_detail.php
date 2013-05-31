<?php
	require_once("../../lib/fn_lib.php");
	session_start();
	isAjax();
	privilegesPage();
    $id_skema=$_GET['id_skema'];
	$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
	$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
    $ia = isset($_POST['ia']) ? mysql_real_escape_string($_POST['ia']) : '';
    $ib = isset($_POST['ib']) ? mysql_real_escape_string($_POST['ib']) : '';
    $ic = isset($_POST['ic']) ? mysql_real_escape_string($_POST['ic']) : '';
      
	$offset = ($page-1)*$rows;
    $result = array();
	//$where = "lsp.rlsp_nama  like '%$ib%' AND skema.skema like '%$ia%'";
	$rs = mysql_query("select count(*) FROM skema_detail WHERE id_skema=$id_skema");
	$row = mysql_fetch_row($rs);
	$result["total"] = $row[0];
	if($result["total"]==0){
        $row2[] =	array("kode"=>"No Record");
        $result["rows"] = $row2;
        echo json_encode($result); 
	}else{
        $rs = mysql_query("SELECT * FROM skema_detail WHERE id_skema=$id_skema  limit $offset,$rows");
        $row2=array();
        while($record = mysql_fetch_object($rs)){
        $record->kode=$record->id;
            unset($record->id);
    	   array_push($row2,$record); 
    	}
        $result["rows"] = $row2;
    
        echo json_encode($result);   
	}
?>