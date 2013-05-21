<?php
session_start();
require_once("../../lib/fn_lib.php");
$id=$_POST['id'];
$hasil=$_POST['hasil'];
$catatan=$_POST['catatan'];
$kueri=mysql_query("UPDATE cps SET hasil='$hasil',catatan='$catatan' WHERE id=$id");
if($kueri){
    echo"Data berhasil di update";
}else{
    echo"Data Gagal di update";
}
     ?>
