<?php
	require_once('../../lib/fn_lib.php');
	session_start();
    privilegesPage();
    $sid=$_SESSION['id'];
    $kode=isset($_POST['kode'])? mysql_real_escape_string(trim($_POST['kode'])): false;
    $rasesor_nama=isset($_POST['rasesor_nama'])? mysql_real_escape_string(trim($_POST['rasesor_nama'])): false;
    $rasesor_email=isset($_POST['rasesor_email'])? mysql_real_escape_string(trim($_POST['rasesor_email'])): false;
    //$id_sesion=mysql_fetch_array(mysql_query("SELECT id FROM lsp WHERE id_users=$sid"));
    $nm_table='asesor';
    $kolom_db=mysql_query("SELECT COLUMN_NAME FROM information_schema.`COLUMNS` WHERE table_name='$nm_table'");
    $no=0;
    $var_post=array();
    $var_field=array();
    while($array_table=mysql_fetch_array($kolom_db)){
        $name=$array_table['COLUMN_NAME'];
        if(isset($_POST[$name]) && $_POST[$name] != ''){
            array_push($var_post,mysql_real_escape_string(trim($_POST[$name])));
            array_push($var_field,$name);    
        }
     }
     if($kode){
  		 if(cek_email($rasesor_email)==true){
         $max=sizeof($var_field);
         $list=array();
         for($i=0;$i < $max ; $i++){
            $var_array=$var_field[$i].'="'.$var_post[$i].'"';
            array_push($list,$var_array);
         }
         $q='UPDATE '.$nm_table.' SET '.implode($list,',').' WHERE id_auto='.$kode;
         $kueri_q=mysql_query($q);
       		if($kueri_q){
				success('Asesor');
			}else error("data $nm_table gagal diedit!");
            }else{
              error('Email Sudah Terdaftar');  
            }	
	  }else{
	   if(cek_email($rasesor_email)==true){
	       
    $val_post=implode($var_post,"','");
    $gabung="'".$val_post."'";
    $val_field=implode($var_field,",");
    $max=mysql_fetch_array(mysql_query("SELECT MAX(id) as besar FROM users"));
    $id_use=$max['besar']+1;
    mysql_query("INSERT INTO users SET id=$id_use,email='$rasesor_email',id_group_users=4,users='$rasesor_nama'");

    $a="INSERT INTO $nm_table($val_field) values($val_post)";
			$kueri=mysql_query("INSERT INTO $nm_table($val_field) values($gabung)");
           $pesan=mysql_error($connect);
           
             if($kueri){
                success($nm_table);
                }else{
                    error($pesan);
                }
           }else{
               error('Email Sudah Terdaftar');
           }    
     }
    
?>
  
    
	