<?php
	require_once("../../lib/fn_lib.php");
	session_start();
	isAjax();
	privilegesPage();
	$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
	$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
     $ia = isset($_POST['ia']) ? mysql_real_escape_string($_POST['ia']) : '';
  
	$offset = ($page-1)*$rows;

	$result = array();
	$where = "b.sektor_sub like '%$ia%'";
	$rs = mysql_query("select count(*) FROM sektor a
JOIN sektor_sub b
ON a.id=b.id_sektor
JOIN bidang c
ON c.id_sub_sektor=b.id
JOIN unit_kompetensi d
ON d.id_bidang=c.id WHERE ".$where);
	$row = mysql_fetch_row($rs);
	$result["total"] = $row[0];
	if($result["total"]==0){
	   $row2[] =	array("kode"=>"No Record");
       $result["rows"] = $row2;
       echo json_encode($result); 
	}else{
	  
	   $rs = mysql_query("SELECT b.id_sektor,a.sektor,b.id,b.sektor_sub,c.bidang,c.id as bid_id,d.id as id_uk,d.unit_kompetensi
FROM sektor a
JOIN sektor_sub b
ON a.id=b.id_sektor
JOIN bidang c
ON c.id_sub_sektor=b.id
JOIN unit_kompetensi d
ON d.id_bidang=c.id WHERE ".$where." ORDER BY b.id ASC limit $offset,$rows");
	   while($record = mysql_fetch_array($rs)){
	   $row2[] =	array("kode"=>$record['id'],
       "id_sektor"=>$record['id_sektor'],
       "sektor"=>$record['sektor'],
       "sektor_sub"=>$record['sektor_sub'],
       "bidang"=>$record['bidang'],
       "bid_id"=>$record['bid_id'],
       "id_uk"=>$record['id_uk'],
       "unit_kompetensi"=>$record['unit_kompetensi']
       );		
	}
    $result["rows"] = $row2;
    
    echo json_encode($result);   
	}
?>