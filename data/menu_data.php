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
	$where = "menu.nm_menu like '%$ia%'";
	$rs = mysql_query("select count(menu.id) FROM menu
JOIN group_users ON menu.id_group_users=group_users.id
JOIN module ON module.id=menu.id_module WHERE ".$where);
	$row = mysql_fetch_row($rs);
	$result["total"] = $row[0];
	if($result["total"]==0){
	   $row2[] =	array("kode"=>"No Record");
       $result["rows"] = $row2;
       echo json_encode($result); 
	}else{
	  
	   $rs = mysql_query("
       SELECT menu.id,
       menu.nm_menu,
       group_users.group_users,
       module.module,
       menu.no_urut,
       menu.id_tag,
       menu.class_tag,
       menu.icon_tag,
       menu.status_aktif
FROM menu
JOIN group_users ON menu.id_group_users=group_users.id
JOIN module ON module.id=menu.id_module WHERE ".$where." 
ORDER BY group_users.group_users ASC,module.module ASC,menu.no_urut limit $offset,$rows");
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
    
    echo json_encode($result);   
	}
?>