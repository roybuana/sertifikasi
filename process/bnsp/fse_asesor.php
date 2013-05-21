<?php
	require_once('../../lib/fn_lib.php');
	session_start();
	privilegesPage();
    
	$id = isset($_POST['id']) ? mysql_real_escape_string(trim($_POST['id'])) : false;
    $id_auto = isset($_POST['id_auto']) ? mysql_real_escape_string(trim($_POST['id_auto'])) : false;
    
    $rasesor_nama = isset($_POST['rasesor_nama']) ? mysql_real_escape_string(trim($_POST['rasesor_nama'])) : false;
    $id_lsp = isset($_POST['id_lsp']) ? mysql_real_escape_string(trim($_POST['id_lsp'])) : false;
    $id_asesor_type = isset($_POST['id_asesor_type']) ? mysql_real_escape_string(trim($_POST['id_asesor_type'])) : false;
    $sex = isset($_POST['sex']) ? mysql_real_escape_string(trim($_POST['sex'])) : false;
    $alamat= isset($_POST['alamat']) ? mysql_real_escape_string(trim($_POST['alamat'])) : false;
    $rasesor_dstart= isset($_POST['rasesor_dstart']) ? mysql_real_escape_string(trim($_POST['rasesor_dstart'])) : false;
    $rasesor_dend= isset($_POST['rasesor_dend']) ? mysql_real_escape_string(trim($_POST['rasesor_dend'])) : false;
    $prov= isset($_POST['prov']) ? mysql_real_escape_string(trim($_POST['prov'])) : false;
    $kota= isset($_POST['kota']) ? mysql_real_escape_string(trim($_POST['kota'])) : false;
    $email= isset($_POST['email']) ? mysql_real_escape_string(trim($_POST['email'])) : false;
    
    $hp= isset($_POST['hp']) ? mysql_real_escape_string(trim($_POST['hp'])) : false;
    $status_aktif = isset($_POST['status_aktif']) ? mysql_real_escape_string(trim($_POST['status_aktif'])) : false;
     
        
    if($id_auto){
    
	   $query = mysql_query("SELECT * FROM user WHERE id_user='$a'");
		if(mysql_num_rows($query) == 1){
		  if($id_asesor_type==''){
		      $q =mysql_query("UPDATE user SET nm_user='$nm_user',alamat=$alamat,nip='$nip',id_lsp='$id_lsp',status_aktif='$status_aktif',sex=$sex WHERE id_user='$a'");
		  }else{
		      $q =mysql_query("UPDATE user SET nm_user='$nm_user',alamat=$alamat,nip='$nip',id_lsp='$id_lsp',id_asesor_type=id_asesor_type('$id_asesor_type'),status_aktif='$status_aktif',sex=$sex WHERE id_user='$a'");
		  }
			
            
			if($q){
				success('User');
			}else error('data gagal diedit!');	
		}else error('Failed to save data user');
        
	}else{
	   $max=mysql_fetch_array(mysql_query("SELECT MAX(id) as besar FROM users"));
       $id_use=$max['besar']+1;
       mysql_query("INSERT INTO users SET id=$id_use,email='$email',id_group_users=4,users='$rasesor_nama',hp='$hp'");
			$kueri=mysql_query("INSERT INTO asesor SET
             id='$id',
             id_users='$id_use',
             rasesor_nama='$rasesor_nama',
            id_asesor_type='$id_asesor_type',
            id_lsp='$id_lsp',
            rgender_kode='$sex',
            rasesor_alamat='$alamat',
            rasesor_telp='$hp',
            rasesor_email='$email',
            rasesor_dstart='$rasesor_dstart',
            rasesor_dend='$rasesor_dend',
            status_aktif='$status_aktif',
            rprop_kode='$prov',
            rkota_kode='$kota'
          
            ");
            $pesan=mysql_error($connect);
             if($kueri){
                success('Asesor');
            }else{
                error($pesan);
            }
		
			
	}
?>