<?php
	require_once('../../../lib/fn_lib.php');
	session_start();
	isAjax();
	privilegesPage();

$q = isset($_POST['q']) ? strval($_POST['q']) : '';
$rs = mysql_query("SELECT jabatan.*,(SELECT a.jabatan FROM jabatan a WHERE a.id_jabatan=jabatan.id_parent) AS parent FROM jabatan WHERE jabatan like '%$q%' ORDER BY id_jabatan ASC");
$rows = array();
while($row = mysql_fetch_assoc($rs)){
	$rows[] = $row;
}
echo json_encode($rows);
?>