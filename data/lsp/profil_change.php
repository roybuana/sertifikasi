<?php require_once("../../lib/fn_lib.php");
	session_start();
	//isAjax();
	//privilegesPage();
    $sid=$_SESSION['id'];
    $id = isset($_POST['id']) ? mysql_real_escape_string(trim($_POST['id'])) : false;
    $rlsp_nama = isset($_POST['rlsp_nama']) ? mysql_real_escape_string(trim($_POST['rlsp_nama'])) : false;
    $rlsp_nolis = isset($_POST['rlsp_nolis']) ? mysql_real_escape_string(trim($_POST['rlsp_nolis'])) : false;
    $rlsp_dberdiri = isset($_POST['rlsp_dberdiri']) ? mysql_real_escape_string(trim($_POST['rlsp_dberdiri'])) : false;
    $rlsp_doperasi = isset($_POST['rlsp_doperasi']) ? mysql_real_escape_string(trim($_POST['rlsp_doperasi'])) : false;
    $rlsp_dlic= isset($_POST['rlsp_dlic']) ? mysql_real_escape_string(trim($_POST['rlsp_dlic'])) : false;
    $rlsp_alamat= isset($_POST['rlsp_alamat']) ? mysql_real_escape_string(trim($_POST['rlsp_alamat'])) : false;
    $rlsp_telp= isset($_POST['rlsp_telp']) ? mysql_real_escape_string(trim($_POST['rlsp_telp'])) : false;
    $rlsp_fax= isset($_POST['rlsp_fax']) ? mysql_real_escape_string(trim($_POST['rlsp_fax'])) : false;
    $rlsp_email= isset($_POST['rlsp_email']) ? mysql_real_escape_string(trim($_POST['rlsp_email'])) : false;
    $rlsp_url= isset($_POST['rlsp_url']) ? mysql_real_escape_string(trim($_POST['rlsp_url'])) : false;
    $rlsp_kodepos= isset($_POST['rlsp_kodepos']) ? mysql_real_escape_string(trim($_POST['rlsp_kodepos'])) : false;
    $asosiasi_pendukung = isset($_POST['asosiasi_pendukung']) ? mysql_real_escape_string(trim($_POST['asosiasi_pendukung'])) : false;
    $instansi_pendukung = isset($_POST['instansi_pendukung']) ? mysql_real_escape_string(trim($_POST['instansi_pendukung'])) : false;
    $nama=$_POST['nama'];
    $jabatan=$_POST['jabatan'];
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
         $kueri=mysql_query("UPDATE lsp SET 
          rlsp_nolis='$rlsp_nolis',
             rlsp_dberdiri='$rlsp_dberdiri',
             rlsp_doperasi='$rlsp_doperasi',
             rlsp_dlic='$rlsp_dlic',
             rlsp_alamat='$rlsp_alamat',
             rlsp_telp='$rlsp_telp',
             rlsp_fax='$rlsp_fax',
             rlsp_email='$rlsp_email',
             rlsp_url='$rlsp_url',
             rlsp_kodepos='$rlsp_kodepos',
             asosiasi_pendukung='$asosiasi_pendukung',
             instansi_pendukung='$instansi_pendukung'
          WHERE id_users=$sid");
          mysql_query("DELETE FROM lsp_pengurus WHERE id_lsp='$id'");
          foreach($jabatan as $key=> $value){
          mysql_query("INSERT INTO lsp_pengurus SET id_lsp='$id',jabatan='$value',nama='$nama[$key]'");  
          }
          
          echo "Data berhasil di update ";
           
    }
 ?>