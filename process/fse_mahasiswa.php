<?php
	require_once('../lib/fn_lib.php');
	session_start();
	privilegesPage();
    
	$a = isset($_REQUEST['id']) ?$_REQUEST['id']: false;
    $nim = isset($_POST['nim']) ? mysql_real_escape_string(trim($_POST['nim'])) : false;
     $nama = isset($_POST['nama']) ? mysql_real_escape_string(trim($_POST['nama'])) : false;
     $hp = isset($_POST['hp']) ? mysql_real_escape_string(trim($_POST['hp'])) : false;
     $alamat = isset($_POST['alamat']) ? mysql_real_escape_string(trim($_POST['alamat'])) : false;
        
    if($a){
    
	   $query = mysql_query("SELECT * FROM mahasiswa WHERE id='$a'");
		if(mysql_num_rows($query) == 1){
		      $q =mysql_query("UPDATE mahasiswa SET
               nim='$nim',
            nama='$nama',
            hp='$hp',
            alamat='$alamat'
             WHERE id='$a'");
		 	
            
			if($q){
				success('User');
			}else error('data gagal diedit!');	
		}else error('Failed to save data user');
        
	}else{
	   
			$kueri=mysql_query("
            INSERT INTO mahasiswa SET 
            nim='$nim',
            nama='$nama',
            hp='$hp',
            alamat='$alamat'");
             if($kueri){
                success('Mahasiswa');
            }else{
                error('Gagal Insert Data');
            }
		
			
	}
?>