<?php
require_once("../../lib/fn_lib.php");
	session_start();
	isAjax();
	privilegesPage();
    //$kode_orang=array();
    $data_array=$_POST['data_array'];
    $id_skema=$_GET['id_skema'];
    //$semester=substr($krs, -1, 1);
    foreach($data_array as $i){
            mysql_query("INSERT INTO skema_detail SET id_unit_kompetensi='$i',id_skema='$id_skema'");
          
    }
    if ($id_skema){
        success('Unit Kompetensi');
    } else {
    	error('data gagal diedit!');
    }

?>

