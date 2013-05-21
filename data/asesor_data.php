<?php
	require_once("../lib/fn_lib.php");
	session_start();
	isAjax();
	privilegesPage();
	$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
	$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 300;
    $ia = isset($_POST['ia']) ? mysql_real_escape_string($_POST['ia']) : '';
    $ib = isset($_POST['ib']) ? mysql_real_escape_string($_POST['ib']) : '';
    $ic = isset($_POST['ic']) ? mysql_real_escape_string($_POST['ic']) : '';
	$offset = ($page-1)*$rows;

	$result = array();
	$where = "nama like '%$ia%' AND status_aktif like '%$ib%' AND tgl_daftar like '%$ic%'  ";
	$rs = mysql_query("select count(*) FROM cps WHERE ".$where);
	$row = mysql_fetch_row($rs);
	$result["total"] = $row[0];
	if($result["total"]==0){
	   $row2[] =	array("nama"=>"No Record");
       $result["rows"] = $row2;
       echo json_encode($result); 
	}else{
	  
	   $rs = mysql_query("
       SELECT * FROM cps WHERE ".$where." 
ORDER BY tgl_daftar ASC,nama ASC limit $offset,$rows");
	   while($record = mysql_fetch_array($rs)){
	   $row2[] =	array("kode"=>$record['id'],
       "nama"=>$record['nama'],
       "tmp_lahir"=>$record['tmp_lahir'],
       "tgl_lahir"=>$record['tgl_lahir'],
       "jen_kel"=>$record['jen_kel'],
       "kebangsaan"=>$record['kebangsaan'],
       "alamat"=>$record['alamat'],
       "ko_pos"=>$record['ko_pos'],
       "hp"=>$record['hp'],
       "email"=>$record['email'],
       "nama_sekolah"=>$record['nama_sekolah'],
       "jurusan"=>$record['jurusan'],
       "strata"=>$record['strata'],
       "thn_lulus"=>$record['thn_lulus'],
       "nama_perusahaan"=>$record['nama_perusahaan'],
       "jabatan"=>$record['jabatan'],
       "alamat_kantor"=>$record['alamat_kantor'],
       "ko_pos_kantor"=>$record['ko_pos_kantor'],
       "telp_kantor"=>$record['telp_kantor'],
       "fax"=>$record['fax'],
       "email_kantor"=>$record['email_kantor'],
       "tuk"=>$record['tuk'],
       "tgl_daftar"=>$record['tgl_daftar'],
       "status_aktif"=>$record['status_aktif']);		
	}
    $result["rows"] = $row2;
    
    echo json_encode($result);   
	}
?>