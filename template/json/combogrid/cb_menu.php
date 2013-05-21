<?php
	require_once('../../../lib/fn_lib.php');
	session_start();
	isAjax();
	privilegesPage();

$q = isset($_POST['q']) ? strval($_POST['q']) : '';
$level=$_GET['level'];
$modul=$_GET['modul'];
$rs = mysql_query("select * FROM menu where id_group_users=$level AND id_module=$modul ORDER BY no_urut");
$rows = array();
$rows[] = array("id"=>"0","nm_menu"=>"Top");

while($row = mysql_fetch_assoc($rs)){
            $result = array();
			$result['id'] = $row['id'];
			$result['nm_menu'] = $row['nm_menu'];
	$rows[] = $result;
}
echo json_encode($rows);
?>