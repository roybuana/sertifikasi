<?php
	require_once('../lib/fn_lib.php');
	session_start();
	privilegesPage();
    
	$a = isset($_REQUEST['id']) ?$_REQUEST['id']: false;
    $kode = isset($_POST['kode']) ? mysql_real_escape_string(trim($_POST['kode'])) : false;
    $users = isset($_POST['users']) ? mysql_real_escape_string(trim($_POST['users'])) : false;
    $email = isset($_POST['email']) ? mysql_real_escape_string(trim($_POST['email'])) : false;
    $password = isset($_POST['password']) ? mysql_real_escape_string(trim($_POST['password'])) : false;
    $id_group_users = isset($_POST['id_group_users']) ? mysql_real_escape_string(trim($_POST['id_group_users'])) : false;
    $tgl_aktif= isset($_POST['id_jabatan']) ? mysql_real_escape_string(trim($_POST['id_jabatan'])) : false;
    $hp= isset($_POST['hp']) ? mysql_real_escape_string(trim($_POST['hp'])) : false;
    $status_aktif = isset($_POST['status_aktif']) ? mysql_real_escape_string(trim($_POST['status_aktif'])) : false;
     
        
    if($a){
    
	   $query = mysql_query("SELECT * FROM user WHERE id_user='$a'");
		if(mysql_num_rows($query) == 1){
		  if($password==''){
		      $q =mysql_query("UPDATE user SET nm_user='$nm_user',id_jabatan=$id_jabatan,nip='$nip',email='$email',status_aktif='$status_aktif',id_group_users=$id_group_users WHERE id_user='$a'");
		  }else{
		      $q =mysql_query("UPDATE user SET nm_user='$nm_user',id_jabatan=$id_jabatan,nip='$nip',email='$email',password=PASSWORD('$password'),status_aktif='$status_aktif',id_group_users=$id_group_users WHERE id_user='$a'");
		  }
			
            
			if($q){
				success('User');
			}else error('data gagal diedit!');	
		}else error('Failed to save data user');
        
	}else{
	   
			$kueri=mysql_query("INSERT INTO users SET users='$users',id_group_users=$id_group_users,email='$email',password=PASSWORD('$password'),tgl_aktif='$tgl_aktif',hp='$hp',status_aktif='$status_aktif'");
             if($kueri){
                success('Users');
            }else{
                error('Gagal Insert Data');
            }
		
			
	}
?>