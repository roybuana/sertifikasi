<?php
	require_once('../lib/fn_lib.php');
	session_start();
	isAjax();
	privilegesPage();
	$data = array();
	//$id = mysql_real_escape_string(preg_replace('/[^0-9]/','',$_REQUEST['id']));
	$var_array=$_POST['var_array'];
    $hasil_gabung=implode(",",$var_array);
        $kueri=mysql_query("DELETE FROM lsp WHERE id_users IN($hasil_gabung)");
     
    if ($kueri){
        mysql_query("DELETE FROM users WHERE id IN($hasil_gabung)");
        success('LSP');
    } else {
    	error('data gagal di hapus!');
    }
    
?>