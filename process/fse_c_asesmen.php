<?php
	require_once('../lib/fn_lib.php');
	session_start();
	privilegesPage();
    $idSession=$_SESSION['id'];
    //$arayKueri=mysql_fetch_array(mysql_query("SELECT user_tb.channel_id FROM user_tb WHERE id='$idSession'"));
	
    //$sid=$_SESSION['id'];
	$a = isset($_REQUEST['id']) ?$_REQUEST['id']: false;
    $kode = isset($_POST['kode']) ? mysql_real_escape_string(trim($_POST['kode'])) : false;
   	$status_form = isset($_POST['status_form']) ? mysql_real_escape_string(trim($_POST['status_form'])) : false;
    
     $id_asesor = $_POST['id_asesor'];
     $tgl_asesmen = isset($_POST['tgl_asesmen']) ? mysql_real_escape_string(trim($_POST['tgl_asesmen'])) : false;
      
   $status_aktif = isset($_POST['status_aktif']) ? mysql_real_escape_string(trim($_POST['status_aktif'])) : false;
         
    if($a){
    
	   $query = mysql_query("SELECT * FROM cps WHERE id='$a'");
		if(mysql_num_rows($query) == 1){
		 
			$q =mysql_query("UPDATE cps SET status_form='$status_form',
            tgl_asesmen='$tgl_asesmen',status_aktif='$status_aktif',
            status_aktif='$status_aktif' WHERE id='$a'");
            //$array_query = mysql_fetch_array($query);
            $kueri_asesor=mysql_query("SELECT id_cps FROM cps_asesor WHERE id_cps='$a'");
            if(mysql_num_rows($kueri_asesor) >= 1){
                mysql_query("DELETE FROM cps_asesor WHERE id_cps=$a");
                foreach($id_asesor as $key=>$value){
                        mysql_query("INSERT INTO cps_asesor SET id_cps=$a,id_asesor='$value'");
                    }
                }else{
                    foreach($id_asesor as $key=>$value){
                        mysql_query("INSERT INTO cps_asesor SET id_cps=$a,id_asesor='$value'");
                    }
                }
          	if($kueri_asesor){
				success('Asesi');
			}else error('data gagal diedit!');	
		}else error('Failed to save data Asesi');
        
	}else{
	    if(isset($_POST['id_sop'])){
		$kueri=mysql_query("INSERT INTO kegiatan SET id_asesor='$id_asesor',status_form='$status_form',tgl_asesmen='$tgl_asesmen',tgl_berakhir='$tgl_akhir',id_user='$idSession',detail='$detail',tempat='$tempat',status_aktif='$status_aktif',id_sop=$id_sop"); 
	   }else{
	    	$kueri=mysql_query("INSERT INTO kegiatan SET id_asesor='$id_asesor',status_form='$status_form',tgl_asesmen='$tgl_asesmen',tgl_berakhir='$tgl_akhir',id_user='$idSession',detail='$detail',pic_bnsp=$pic_bnsp,pic_sekretariat=$pic_sekretariat,tempat='$tempat',status_aktif='$status_aktif',id_notulen=$id_notulen");   
	   	       
	   }
	   
		
             if($kueri){
                success('Kegiatan ');
            }else{
                error('Gagal Insert Data');
            }
		
			
	}
?>