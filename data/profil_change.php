<?php require_once("../lib/fn_lib.php");
	session_start();
	//isAjax();
	//privilegesPage();
    $sid=$_SESSION['id'];
    $kueri_user=mysql_fetch_array(mysql_query("SELECT * FROM users WHERE id=$sid"));
    if($_POST['password']!=""){
    if(isset($_POST['password'])){
        if($_POST['password']!=$_POST['password2']){
            echo("Password Tidak Sama");
        }else{
            $password=$_POST['password'];
            $kueri=mysql_query("UPDATE users SET password=PASSWORD('$password') WHERE id=$sid");
            if($kueri){
                echo "Password berhasil di update silahkan Logout dan Login Kembali";
            }else{
                echo "Password gagal di update";
            }
        }
    }else{
        echo"Tidak ada perubahan";
    }
    }else{
        echo"Tidak ada perubahan";
    }
 ?>