<?php
	require_once("../lib/fn_lib.php");
	session_start();
	isAjax();
	privilegesPage();
    $sid=$_SESSION['id'];
	$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
	$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 300;
    $ia = isset($_POST['ia']) ? mysql_real_escape_string($_POST['ia']) : '';
    $ib = isset($_POST['ib']) ? mysql_real_escape_string($_POST['ib']) : '';
    $ic = isset($_POST['ic']) ? mysql_real_escape_string($_POST['ic']) : '';
	$offset = ($page-1)*$rows;

	$result = array();
	$where = "cps.status_aktif like '%$ib%' AND cps.tgl_daftar like '%$ic%' AND
    cps.id_users=$sid";
	$rs = mysql_query("select count(*) FROM cps
       JOIN users ON users.id=cps.id_users WHERE ".$where);
	$row = mysql_fetch_row($rs);
	$result["total"] = $row[0];
	if($result["total"]==0){
	   $row2[] =	array("nama"=>"No Record");
       $result["rows"] = $row2;
       echo json_encode($result); 
	}else{
	  
	   $rs = mysql_query("
       SELECT cps.*,users.users FROM cps
       JOIN users ON users.id=cps.id_users
        WHERE ".$where." 
ORDER BY cps.tgl_daftar DESC,cps.nama ASC limit $offset,$rows");
	    
	   while($record = mysql_fetch_array($rs)){
	       $rs2 = mysql_query("SELECT cps_asesor.id_cps,cps_asesor.id_asesor,users.users FROM cps_asesor
       
       JOIN users ON users.id=cps_asesor.id_asesor
       WHERE id_cps=$record[id]
       ");
       if(mysql_num_rows($rs2)>=1){
        $asesi=array();
        while($ases=mysql_fetch_array($rs2)){
            array_push($asesi,$ases['users']);
        }
        $nama_asesor=$asesi;
       }else{
        $nama_asesor='-';
       }
       
	   $row2[] =	array("kode"=>$record['id'],
       "nama"=>$record['users'],
       "nm_asesor"=>$nama_asesor,
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
       "status_form"=>$record['status_form'],
       "type_form"=>$record['type_form'],
       "jenis_form"=>$record['jenis_form'],
       "tgl_asesmen"=>$record['tgl_asesmen'],
       "lampiran"=>$record['lampiran'],
       "status_aktif"=>$record['status_aktif']);		
	}
    $result["rows"] = $row2;
    
    echo json_encode($result);   
	}
?>