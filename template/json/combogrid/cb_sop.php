<?php
	require_once('../../../lib/fn_lib.php');
	session_start();
	isAjax();
	privilegesPage();
    $q = isset($_POST['q']) ? strval($_POST['q']) : '';
  $p=mysql_fetch_array(mysql_query("select * from user where id_user='$_SESSION[id]'"));
     
    $rs = mysql_query("select * FROM sop where id_jabatan=$p[id_jabatan] ORDER BY id_sop");
   


$rows = array();
while($row = mysql_fetch_assoc($rs)){
	$rows[] = $row;
}
echo json_encode($rows);
?>