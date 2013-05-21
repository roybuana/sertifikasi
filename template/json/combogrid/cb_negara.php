<?php
require_once('../../../lib/fn_lib.php');
	session_start();
	isAjax();
	privilegesPage();

$q = isset($_POST['q']) ? strval($_POST['q']) : '';
$rs = mysql_query("select * FROM countries
 where ccode like '%$q%' or country like '%$q%'");
$rows = array();
while($row = mysql_fetch_assoc($rs)){
	$rows[] = $row;
}
echo json_encode($rows);


?>