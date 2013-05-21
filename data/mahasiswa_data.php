<?php
	require_once("../lib/fn_lib.php");
	session_start();
	isAjax();
	privilegesPage();
	$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
	$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 300;
     $ia = isset($_POST['ia']) ? mysql_real_escape_string($_POST['ia']) : '';
  
	$offset = ($page-1)*$rows;

	$result = array();
	$where = "nama like '%$ia%'";
	$rs = mysql_query("select count(*) FROM mahasiswa WHERE ".$where);
	$row = mysql_fetch_row($rs);
	$result["total"] = $row[0];
	if($result["total"]==0){
	   $row2[] =	array("kode"=>"No Record");
       $result["rows"] = $row2;
       echo json_encode($result); 
	}else{
	  
	   $rs = mysql_query("SELECT * FROM mahasiswa  WHERE ".$where." ORDER BY nim ASC limit $offset,$rows");
	   while($record = mysql_fetch_array($rs)){
	   $row2[] =	array("kode"=>$record['nim'],
       "roy"=>$record['nama'],
       "hp"=>$record['hp'],
       "alamat"=>$record['alamat']);		
	
    }
 
    $result["rows"] = $row2;
    
    echo json_encode($result);   
	}
?>