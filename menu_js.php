<?php
	require_once("lib/fn_lib.php");
	
	$result = array();
	
	$rs = mysql_query("select count(*) FROM menu");
	$row = mysql_fetch_row($rs);
	$result["total"] = $row[0];
	if($result["total"]==0){
	   $row2[] =	array("kode"=>"No Record");
       $result["rows"] = $row2;
       echo json_encode($result); 
	}else{
	  
	   $rs = mysql_query("
       SELECT  * FROM menu");
	   while($record = mysql_fetch_array($rs)){
	   $row2[] =	array("kode"=>$record['id'],
       "nm_menu"=>$record['nm_menu'],
       "group_users"=>$record['group_users'],
       "module"=>$record['module'],
       "no_urut"=>$record['no_urut'],
       "id_tag"=>$record['id_tag'],
       "class_tag"=>$record['class_tag'],
       "icon_tag"=>$record['icon_tag'],
       "status_aktif"=>$record['status_aktif']);		
	}
    $result["rows"] = $row2;
    print_r($result);
    //echo json_encode($result);   
	}
?>