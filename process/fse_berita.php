<?php
	require_once('../lib/fn_lib.php');
	session_start();
	privilegesPage();
    $sid=$_SESSION['id'];
	$a = isset($_REQUEST['id']) ?$_REQUEST['id']: false;
    $kode = isset($_POST['kode']) ? mysql_real_escape_string(trim($_POST['kode'])) : false;
    $id_kategori_berita = isset($_POST['id_kategori_berita']) ? mysql_real_escape_string(trim($_POST['id_kategori_berita'])) : false;
    $berita = isset($_POST['berita']) ? mysql_real_escape_string(trim($_POST['berita'])) : false;
    $password = isset($_POST['password']) ? mysql_real_escape_string(trim($_POST['password'])) : false;
    $id_kategori_berita = isset($_POST['id_kategori_berita']) ? mysql_real_escape_string(trim($_POST['id_kategori_berita'])) : false;    
    $front = isset($_POST['front']) ? mysql_real_escape_string(trim($_POST['front'])) : false;
     $judul_berita = isset($_POST['judul_berita']) ? mysql_real_escape_string(trim($_POST['judul_berita'])) : false;
 $status_aktif = isset($_POST['status_aktif']) ? mysql_real_escape_string(trim($_POST['status_aktif'])) : false;
     
        $cekMax=mysql_fetch_array(mysql_query("SELECT MAX(id_user)as besar FROM user"));
        $kode_plus=$cekMax['besar'] + 1;
       
     
  //  $alias=mysql_fetch_array(mysql_query("SELECT * FROM channel WHERE id='$batasPutar'"));
   
    if($a){
    
	   $query = mysql_query("SELECT * FROM user WHERE id_user='$a'");
		if(mysql_num_rows($query) == 1){
		  if($password==''){
		      $q =mysql_query("UPDATE user SET id_kategori_berita='$id_kategori_berita',berita='$berita',status_aktif='$status_aktif',front=$front WHERE id_user='$a'");
		  }else{
		      $q =mysql_query("UPDATE user SET id_kategori_berita='$id_kategori_berita',berita='$berita',password=PASSWORD('$password'),status_aktif='$status_aktif',front=$front WHERE id_user='$a'");
		  }
			
            
			if($q){
				success('User');
			}else error('data gagal diedit!');	
		}else error('Failed to save data user');
        
	}else{
	   
			$kueri=mysql_query("INSERT INTO berita SET id_kategori_berita='$id_kategori_berita',berita='$berita',status_aktif='$status_aktif',front='$front',judul_berita='$judul_berita',tgl_buat=NOW(),id_user=$sid");
             if($kueri){
                success('Berita');
            }else{
                error('Gagal Insert Data');
            }
		
			
	}
?>