<?php
	require_once('../lib/fn_lib.php');
	session_start();
	privilegesPage();
    
	//$a = isset($_REQUEST['id']) ?$_REQUEST['id']: false;
    $id_auto = isset($_POST['id_auto']) ? mysql_real_escape_string(trim($_POST['id_auto'])) : false;
    $id = isset($_POST['id']) ? mysql_real_escape_string(trim($_POST['id'])) : false;
    $rlsp_nama = isset($_POST['rlsp_nama']) ? mysql_real_escape_string(trim($_POST['rlsp_nama'])) : false;
    $rlsp_nolis = isset($_POST['rlsp_nolis']) ? mysql_real_escape_string(trim($_POST['rlsp_nolis'])) : false;
    $rlsp_dberdiri = isset($_POST['rlsp_dberdiri']) ? mysql_real_escape_string(trim($_POST['rlsp_dberdiri'])) : false;
    $rlsp_doperasi = isset($_POST['rlsp_doperasi']) ? mysql_real_escape_string(trim($_POST['rlsp_doperasi'])) : false;
    $rlsp_dlic= isset($_POST['rlsp_dlic']) ? mysql_real_escape_string(trim($_POST['rlsp_dlic'])) : false;
    $rlsp_alamat= isset($_POST['rlsp_alamat']) ? mysql_real_escape_string(trim($_POST['rlsp_alamat'])) : false;
    $rlsp_telp= isset($_POST['rlsp_telp']) ? mysql_real_escape_string(trim($_POST['rlsp_telp'])) : false;
    $rlsp_fax= isset($_POST['rlsp_fax']) ? mysql_real_escape_string(trim($_POST['rlsp_fax'])) : false;
    $rlsp_email= isset($_POST['rlsp_email']) ? mysql_real_escape_string(trim($_POST['rlsp_email'])) : false;
    $rlsp_url= isset($_POST['rlsp_url']) ? mysql_real_escape_string(trim($_POST['rlsp_url'])) : false;
    $rlsp_kodepos= isset($_POST['rlsp_kodepos']) ? mysql_real_escape_string(trim($_POST['rlsp_kodepos'])) : false;
    $status_aktif = isset($_POST['status_aktif']) ? mysql_real_escape_string(trim($_POST['status_aktif'])) : false;
    $nama_pengurus=$_POST['nama_pengurus'];
    $jabatan=$_POST['jabatan'];
     
        
    if($id_auto){
    
	   $query = mysql_query("SELECT * FROM lsp WHERE id_auto='$id_auto'");
		if(mysql_num_rows($query) == 1){
		      $q =mysql_query("UPDATE lsp SET 
              id='$id',
             rlsp_nama='$rlsp_nama',
             rlsp_nolis='$rlsp_nolis',
             rlsp_dberdiri='$rlsp_dberdiri',
             rlsp_doperasi='$rlsp_doperasi',
             rlsp_dlic='$rlsp_dlic',
             rlsp_alamat='$rlsp_alamat',
             rlsp_telp='$rlsp_telp',
             rlsp_fax='$rlsp_fax',
             rlsp_email='$rlsp_email',
             rlsp_url='$rlsp_url',
             rlsp_kodepos='$rlsp_kodepos',
             status_aktif='$status_aktif'
               WHERE id_auto='$id_auto'");
		 
			
            
			if($q){
				success('LSP');
			}else error('data gagal diedit!');	
		}else error('Failed to save data user');
        
	}else{
	    $max=mysql_fetch_array(mysql_query("SELECT MAX(id) as besar FROM users"));
        $id_use=$max['besar']+1;
      
			$kueri=mysql_query("INSERT INTO lsp SET
             id='$id',
             rlsp_nama='$rlsp_nama',
             rlsp_nolis='$rlsp_nolis',
             rlsp_dberdiri='$rlsp_dberdiri',
             rlsp_doperasi='$rlsp_doperasi',
             rlsp_dlic='$rlsp_dlic',
             rlsp_alamat='$rlsp_alamat',
             rlsp_telp='$rlsp_telp',
             rlsp_fax='$rlsp_fax',
             rlsp_email='$rlsp_email',
             rlsp_url='$rlsp_url',
             rlsp_kodepos='$rlsp_kodepos',
             status_aktif='$status_aktif',
             id_users=$id_use;
             ");
             
             
             if($kueri){
                foreach($jabatan as $key=>$value){
                    mysql_query("INSERT INTO lsp_pengurus SET id_lsp='$id',jabatan='$value',nama='$nama_pengurus[$key]'");   
                }
                    mysql_query("INSERT INTO users SET id_group_users=3,users='$rlsp_nama',email='$rlsp_email',id=$id_use");
                    
                success('LSP');
            }else{
                error('Gagal Insert Data');
            }
		
			
	}
?>