<?php
	require_once('../../lib/fn_lib.php');
	session_start();
    privilegesPage();
    $sid=$_SESSION['id'];
    $kode=isset($_POST['kode'])? mysql_real_escape_string(trim($_POST['kode'])): false;
    $id_sesion=mysql_fetch_array(mysql_query("SELECT id FROM lsp WHERE id_users=$sid"));
    $nm_table='tak';
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
       // $query = mysql_query("SELECT * FROM $nm_table WHERE id='$kode'");
	//	if(mysql_num_rows($query) == 1){
		 
         $max=sizeof($var_field);
         $list=array();
         for($i=0;$i < $max ; $i++){
            $var_array=$var_field[$i].'="'.$var_post[$i].'"';
            array_push($list,$var_array);
         }
         $q='UPDATE '.$nm_table.' SET '.implode($list,',').' WHERE id='.$kode;
         $kueri_q=mysql_query($q);
        // unset($var_post['kode']);
         //unset($var_field['id']);
         //success($nm_table);
		//	$q =mysql_query("UPDATE $nm_table SET" hasil='$hasil',catatan='$catatan' WHERE id='$kode'");
            
			if($kueri_q){
				success($nm_table);
			}else error("data $nm_table gagal diedit!");	
		//}else error("Failed to save data $nm_table");
        //success('edit');
     }else{
    $val_post=implode($var_post,"','");
    $gabung="'".$val_post."'";
    $val_field=implode($var_field,",");
    $a="INSERT INTO tak($val_field) values($val_post)";
			$kueri=mysql_query("INSERT INTO tak(id_lsp,$val_field) values('$id_sesion[id]',$gabung)");
           $pesan=mysql_error($connect);
           
             if($kueri){
                success($nm_table);
                }else{
                    error($pesan);
                }    
     }
    
?>
  
    
	