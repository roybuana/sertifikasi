<?php
	require_once('../lib/fn_lib.php');
	session_start();
	privilegesPage();
   	$a = isset($_REQUEST['id']) ?$_REQUEST['id']: false;
    $kode = isset($_POST['kode']) ? mysql_real_escape_string(trim($_POST['kode'])) : false;
    $jabatan = isset($_POST['jabatan']) ? mysql_real_escape_string(trim(ucwords(strtolower($_POST['jabatan'])))) : false;
    $status_aktif = isset($_POST['status_aktif']) ? mysql_real_escape_string(trim($_POST['status_aktif'])) : false;
    $id_parent = isset($_POST['id_parent']) ? mysql_real_escape_string(trim($_POST['id_parent'])) : false;
    
    if($a){
         if($jabatan != ''){
	   $query = mysql_query("SELECT * FROM jabatan WHERE id_jabatan='$a'");
		if(mysql_num_rows($query) == 1){
		  
			$q =mysql_query("UPDATE jabatan SET jabatan='$jabatan',status_aktif='$status_aktif',id_parent='$id_parent' WHERE id_jabatan='$a'");
            
			if($q){
				success('Jabatan');
			}else error('data gagal diedit!');	
		}else error('Failed to save data Iklan');
        }else{
            error('Data Channel Harus Diisi');
        }
	}else{
	   
			$kueri=mysql_query("INSERT INTO jabatan SET jabatan='$jabatan',id_parent='$id_parent',status_aktif='$status_aktif'");
             if($kueri){
                success('Jabatan');
            }else{
                error('Gagal Insert Data');
            }
		
			
	}
?>