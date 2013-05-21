<?php
	require_once('../../lib/fn_lib.php');
	session_start();
    privilegesPage();
    $sid=$_SESSION['id'];
    $id_sesion=mysql_fetch_array(mysql_query("SELECT id_lsp FORM lsp WHERE id_user=$sid"));
    $nm_table='tak';
    $kolom_db=mysql_query("SELECT COLUMN_NAME FROM information_schema.`COLUMNS` WHERE table_name='$nm_table'");
    $no=0;
    $var_post=array();
    $var_field=array();
    while($array_table=mysql_fetch_array($kolom_db)){
        $name=$array_table['COLUMN_NAME'];
        if(isset($_POST[$name]) && $_POST[$name] != ''){
            array_push($var_post,$_POST[$name]);
            array_push($var_field,$name);    
        }
        
        
        //$var[$no] = $_POST[$name]) ? mysql_real_escape_string(trim($_POST[$name])) : false;
        //$no++;
        //echo $array_table['COLUMN_NAME'];
        
    }
    //unset($var['id']);
    $val_post=implode($var_post,"','");
    $val_field=implode($var_field,',');
   $a="INSERT INTO tak($val_field) values($val_post)";
			$kueri=mysql_query("INSERT INTO tak($val_field) values('$val_post')");
           // $pesan=mysql_error($connect);
             if($kueri){
                success($a);
                }else{
                    error($a);
                }
           
		
			
	
    ?>
  
    
	