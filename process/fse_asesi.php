<?php
	require_once('../lib/fn_lib.php');
	session_start();
	privilegesPage();
   	$a = isset($_REQUEST['id']) ?$_REQUEST['id']: false;
    $kode = isset($_POST['kode']) ? mysql_real_escape_string(trim($_POST['kode'])) : false;
    
    $hasil = isset($_POST['hasil']) ? mysql_real_escape_string(trim($_POST['hasil'])) : false;
    $catatan = isset($_POST['catatan']) ? mysql_real_escape_string(trim($_POST['catatan'])) : false;
    
    if($a){
       
	   $query = mysql_query("SELECT * FROM cps WHERE id='$a'");
		if(mysql_num_rows($query) == 1){
		 
			$q =mysql_query("UPDATE cps SET hasil='$hasil',catatan='$catatan' WHERE id='$a'");
            
			if($q){
				success('Asesi');
			}else error('data gagal diedit!');	
		}else error('Failed to save data Asesi');
        
	}else{
	  
	 
			$kueri=mysql_query("INSERT INTO sop SET id_jabatan='$id_jabatan',catatan='$catatan',hasil='$hasil'");
             if($kueri){
                success('SOP');
            }else{
                error('Gagal Insert Data');
            }
		
			
	}
?>