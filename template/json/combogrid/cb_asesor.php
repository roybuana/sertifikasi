<?php
	require_once('../../../lib/fn_lib.php');
	session_start();
	isAjax();
	privilegesPage();

$q = isset($_POST['q']) ? strval($_POST['q']) : '';
$rs = mysql_query("select * FROM users where id_group_users=4 AND users like '%$q%'");
$rows = array();
while($row = mysql_fetch_assoc($rs)){
	$rows[] = $row;
}
echo json_encode($rows);
?>