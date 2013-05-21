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
	$where = "users like '%$ia%'";
	$rs = mysql_query("select count(users.id) FROM users JOIN group_users ON users.id_group_users=group_users.id WHERE ".$where);
	$row = mysql_fetch_row($rs);
	$result["total"] = $row[0];
	if($result["total"]==0){
	   $row2[] =	array("kode"=>"No Record");
       $result["rows"] = $row2;
       echo json_encode($result); 
	}else{
	  
	   $rs = mysql_query("SELECT users.id,users.id_group_users,users.kode_user,users.email,users.aktivasi,
       users.users,
       users.username,users.tgl_aktif,users.status_aktif,
       group_users.group_users FROM users JOIN group_users ON
        users.id_group_users=group_users.id  WHERE ".$where." ORDER BY id ASC limit $offset,$rows");
	   while($record = mysql_fetch_array($rs)){
	   $row2[] =	array("kode"=>$record['id'],
       "group_users"=>$record['group_users'],
       "id_group_users"=>$record['id_group_users'],
       "kode_user"=>$record['kode_user'],
       "users"=>$record['users'],
       "username"=>$record['username'],
       "email"=>$record['email'],
       "aktivasi"=>$record['aktivasi'],
       "tgl_aktif"=>$record['tgl_aktif'],
       "status_aktif"=>$record['status_aktif']);		
	}
    $result["rows"] = $row2;
    
    echo json_encode($result);   
	}
?>