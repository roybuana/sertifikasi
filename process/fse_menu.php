<?php
	require_once('../lib/fn_lib.php');
	session_start();
	privilegesPage();
  	$a = isset($_REQUEST['id']) ?$_REQUEST['id']: false;
    $kode = isset($_POST['kode']) ? mysql_real_escape_string(trim($_POST['kode'])) : false;
    $id_group_users = isset($_POST['id_group_users']) ? mysql_real_escape_string(trim($_POST['id_group_users'])) : false;
    $id_module = isset($_POST['id_module']) ? mysql_real_escape_string(trim($_POST['id_module'])) : false;
	$nm_menu = isset($_POST['nm_menu']) ? mysql_real_escape_string(trim($_POST['nm_menu'])) : false;
    $status_aktif = isset($_POST['status_aktif']) ? mysql_real_escape_string(trim($_POST['status_aktif'])) : false;
    $id_menu = isset($_POST['id_menu']) ? mysql_real_escape_string(trim($_POST['id_menu'])) : false;
     $id_tag = isset($_POST['id_tag']) ? mysql_real_escape_string(trim($_POST['id_tag'])) : false;
     $class_tag = isset($_POST['class_tag']) ? mysql_real_escape_string(trim($_POST['class_tag'])) : false;
     $icon_tag = isset($_POST['icon_tag']) ? mysql_real_escape_string(trim($_POST['icon_tag'])) : false;
    $cekMax=mysql_fetch_array(mysql_query("SELECT MAX(id)as besar FROM menu"));
    $kode_plus=$cekMax['besar'] + 1;
       
     
   $array_menu=mysql_query("SELECT * FROM menu WHERE id=$id_menu");
   
   
    if($a){
       $query = mysql_query("SELECT * FROM menu WHERE id='$a'");
		if(mysql_num_rows($query) == 1){
		 
			$q =mysql_query("UPDATE menu SET id_group_users='$id_group_users',id_tag='$id_tag',class_tag='$class_tag',icon_tag='$icon_tag',nm_menu='$nm_menu',status_aktif='$status_aktif' WHERE id='$a'");
         	if($q){
				success('Menu');
			}else error('data gagal diedit!');	
		}else error('Failed to save data menu');
       
	}else{
	   if(mysql_num_rows($array_menu)==0){
	       $kueri=mysql_query("INSERT INTO menu SET id='$kode_plus',id_module='$id_module',id_group_users='$id_group_users',nm_menu='$nm_menu',status_aktif='$status_aktif',id_tag='$id_tag',class_tag='$class_tag',icon_tag='$icon_tag',no_urut= 1");
             if($kueri){
                success('Menu');
            }else{
                error('Gagal Insert Data');
            }  
	   }else{
    $fetch=mysql_fetch_array($array_menu);
    $array_menu_besar=mysql_query("SELECT * FROM menu WHERE id_group_users=$fetch[id_group_users] AND no_urut > $fetch[no_urut]");
     if(mysql_num_rows($array_menu_besar)==0){
       
			$kueri=mysql_query("INSERT INTO menu SET id='$kode_plus',id_module='$id_module',id_group_users='$id_group_users',nm_menu='$nm_menu',status_aktif='$status_aktif',id_tag='$id_tag',class_tag='$class_tag',icon_tag='$icon_tag',no_urut=$fetch[no_urut] + 1");
    
        }else{
            while($row_menu=mysql_fetch_array($array_menu_besar)){
    mysql_query("UPDATE menu SET no_urut=$row_menu[no_urut] + 1 WHERE id=$row_menu[id_menu]");
   }
			$kueri=mysql_query("INSERT INTO menu SET id='$kode_plus',id_module='$id_module',id_group_users='$id_group_users',nm_menu='$nm_menu',status_aktif='$status_aktif',id_tag='$id_tag',class_tag='$class_tag',icon_tag='$icon_tag',no_urut=$fetch[no_urut] + 1");
     
        }
           if($kueri){
                success('Menu');
            }else{
                error('Gagal Insert Data');
            }  
	   }
 
		
			
	}
?>