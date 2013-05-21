<?php
	require_once('../lib/fn_lib.php');
	session_start();
	isAjax();
	privilegesPage();
	$data = array();
	//$id = mysql_real_escape_string(preg_replace('/[^0-9]/','',$_REQUEST['id']));
	$var_array=$_POST['var_array'];
    $hasil_gabung=implode(",",$var_array);
    //$kueri_status=mysql_query("SELECT status_form FROM cps WHERE id IN($hasil_gabung)");
        $kueri=mysql_query("DELETE FROM cps WHERE id IN($hasil_gabung)");
     
    if ($kueri){
        success('Formulir');
    } else {
    	error('data gagal di hapus!');
    }
    
?>