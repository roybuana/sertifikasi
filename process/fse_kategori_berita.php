<?php
	require_once('../lib/fn_lib.php');
	session_start();
	privilegesPage();
    //$idSession=$_SESSION['id'];
    //$arayKueri=mysql_fetch_array(mysql_query("SELECT user_tb.channel_id FROM user_tb WHERE id='$idSession'"));
	
    //$sid=$_SESSION['id'];
	$a = isset($_REQUEST['id']) ?$_REQUEST['id']: false;
    $kode = isset($_POST['kode']) ? mysql_real_escape_string(trim($_POST['kode'])) : false;
    $kategori_berita = isset($_POST['kategori_berita']) ? mysql_real_escape_string(trim(ucwords(strtolower($_POST['kategori_berita'])))) : false;
  $status_aktif = isset($_POST['status_aktif']) ? mysql_real_escape_string(trim($_POST['status_aktif'])) : false;
     
         if($a){
         if($channel_id != ''){
	   $query = mysql_query("SELECT * FROM media_tb WHERE id='$a'");
		if(mysql_num_rows($query) == 1){
		  if($jenisKontrak=='by time'){
		      $batasPutar='-';
		  }else{
		      $tglAwalKontrak='-';
              $tglAkhirKontrak='-';
		  }
			$q =mysql_query("UPDATE media_tb SET kategori_berita='$kategori_berita',batasPutar='$batasPutar',tingkat='$tingkat',status_aktif='$status_aktif',jenisKontrak='$jenisKontrak',tglAwalKontrak='$tglAwalKontrak',tglAkhirKontrak='$tglAkhirKontrak',jenisTayang='$jenisTayang' WHERE id='$a'");
            mysql_query("DELETE FROM media_channel WHERE id_media='$a'");
            foreach($channel_id as $key => $value){
	                      mysql_query("INSERT INTO media_channel SET id_media='$a',id_channel=$value");
            }
			if($q){
				success('Iklan');
			}else error('data gagal diedit!');	
		}else error('Failed to save data Iklan');
        }else{
            error('Data Channel Harus Diisi');
        }
	}else{
	   
			$kueri=mysql_query("INSERT INTO kategori_berita SET kategori_berita='$kategori_berita',status_aktif='$status_aktif'");
             if($kueri){
                success('Kategori Berita ');
            }else{
                error('Gagal Insert Data');
            }
		
			
	}
?>