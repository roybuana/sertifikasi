<?php
	require_once('../lib/fn_lib.php');
	session_start();
	privilegesPage();
	session_destroy();
	header("location: /"._URL_BASE_);
?>