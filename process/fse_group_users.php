<?php
	require_once('../lib/fn_lib.php');
	session_start();
	privilegesPage();
    //$idSession=$_SESSION['id'];
    //$arayKueri=mysql_fetch_array(mysql_query("SELECT user_tb.channel_id FROM user_tb WHERE id='$idSession'"));
	
    //$sid=$_SESSION['id'];
	$a = isset($_REQUEST['id']) ?$_REQUEST['id']: false;
    $kode = isset($_POST['kode']) ? mysql_real_escape_string(trim($_POST['kode'])) : false;
    $group_users = isset($_POST['group_users']) ? mysql_real_escape_string(trim(ucwords(strtolower($_POST['group_users'])))) : false;
//	$tingkat = isset($_POST['tingkat']) ? mysql_real_escape_string(trim($_POST['tingkat'])) : false;
    $status_aktif = isset($_POST['status_aktif']) ? mysql_real_escape_string(trim($_POST['status_aktif'])) : false;
      
    $parent = isset($_POST['parent']) ? mysql_real_escape_string(trim($_POST['parent'])) : false;
   
        
     
  //  $alias=mysql_fetch_array(mysql_query("SELECT * FROM channel WHERE id='$batasPutar'"));
   
    if($a){
        
	   $query = mysql_query("SELECT * FROM group_users WHERE id='$a'");
		if(mysql_num_rows($query) == 1){
		  
			$q =mysql_query("UPDATE group_users SET group_users='$group_users',status_aktif='$status_aktif' WHERE id='$a'");
           
			if($q){
				success('Group Users');
			}else error('data gagal diedit!');	
		}else error('Failed to save data Group Users');
        
	}else{
	$kueri=mysql_query("INSERT INTO group_users SET id='$kode',group_users='$group_users',status_aktif='$status_aktif'");
              
		  if($kueri){
                success('group_users');
            }else{
                error('Gagal Insert Data group_users');
            }
		
			
	}
?>