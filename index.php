<?php
	session_start(); 
	require("lib/fn_lib.php");
	define('START',microtime());
    error_reporting(E_ALL);
	if(checkIsLogin()){
		$page_header = "template/pages/header.php";//1
		$page_body = "template/pages/body.php";//2
        $r = "beranda.php";
	}else{		
		$page_header = "template/login/header.php";
		$page_body = "template/login/body.php";	
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html style="width:100%;height:100%;overflow:hidden">
<link rel="shortcut icon" href="images/webicon.ico" type="image/x-icon" />
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Aplikasi Registrasi Sertifikasi v0.1</title>
	<link rel="stylesheet" type="text/css" href="themes/metro-orange/easyui.css">
	<link rel="stylesheet" type="text/css" href="themes/icon.css">
   
<script type="text/javascript" src="js/jquery-1.8.0.min.js"></script>
	<script type="text/javascript" src="js/jquery.easyui.min.js"></script>  
	
	<?php include($page_header); ?>
</head>
<body style="height:100%;width:100%;overflow:hidden;border:none;background-color:#99BBE8;padding:0;spacing:0;margin:0;" >
	<?php include($page_body); ?>
</body>
</html>