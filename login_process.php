<?php
	require_once("config/database.php");
	require_once("lib/fn_lib.php");
	if(checkIsLogin()){
		header("location: index.php");	
	}else{
		if(isset($_POST['username']) && isset($_POST['password'])){
			$user = mysql_real_escape_string($_POST['username']);
			$password = mysql_real_escape_string($_POST['password']);
			$check = checkPass($user,$password);
			if($check !== FALSE){
				session_start();
				$_SESSION[md5('isLogin')] = md5(1);	
				$_SESSION[md5('UID')] = $check;	
                $_SESSION['id'] = $check;
				header("location: index.php");
			}else{
				header("location: index.php");
			}
		}else{
			header("location: index.php");	
		}
	}	
?>
