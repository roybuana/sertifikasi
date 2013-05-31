<?php
require_once('../../../lib/fn_lib.php');
	session_start();
	isAjax();
	privilegesPage();
 $memcache = new Memcache;
   $memcache->connect('localhost', 11211) or die ("Could not connect");
 
    $key = md5("0612502526");
  //Ambil dari cache
  $get_result = $memcache->get($key);
   //echo "Data dari  cache:<br/>";
  
   // $tes=var_dump($get_result);
$q = isset($_POST['q']) ? strval($_POST['q']) : '';
//$rs = mysql_query("SELECT * FROM unit_kompetensi");

echo json_encode($get_result);


?>