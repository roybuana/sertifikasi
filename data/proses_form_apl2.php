<?php
session_start();
require_once("../lib/fn_lib.php");
$nama=$_POST['uk'];
$bape=$_POST['bape'];
$id_user=$_POST['id_user'];
//
$tmp_lampiran_apl2 = $_FILES['lampiran_apl2']['tmp_name'];
$type_lampiran_apl2 = $_FILES['lampiran_apl2']['type'];
$size_lampiran_apl2 = $_FILES['lampiran_apl2']['size'];
$filename_lampiran_apl2 = $_FILES['lampiran_apl2']['name'];
$mimetype_lampiran_apl2 = array('application/zip','application/octet-stream'); // Tambahkan mime sesuai kebutuhan
//'application/octet-stream',$mimetype_lampiran_apl2 = array('application/octet-stream','application/msword','application/x-zip-compressed','application/pdf'); // Tambahkan mime sesuai kebutuhan
$path = '../file_lampiran_apl2/'; //Tempat file yg akan di letakkan
$max_file_size = 10485760; // Maksimal file yg diupload (100Kb)

	// jika tedapat file yg diupload
if($filename_lampiran_apl2 != ''){
if($size_lampiran_apl2 <= $max_file_size){ // cek besar ukuran yg diupload
	if(in_array($type_lampiran_apl2,$mimetype_lampiran_apl2,TRUE)){ // cocokkan dengan tipe mime yang telah di tentukan
		if(move_uploaded_file($tmp_lampiran_apl2,$path.$filename_lampiran_apl2)){
$kueri_id=mysql_fetch_array(mysql_query("SELECT MAX(id) as besar FROM cps"));
$no_urut=$kueri_id['besar']+1;
 
$kueri_database=mysql_query("INSERT INTO cps SET id=$no_urut,lampiran='".$no_urut."_".$filename_lampiran_apl2."',type_form='FR-APL-02'
     ,tgl_daftar=SYSDATE(),id_users=$id_user"); 
if($kueri_database){
    foreach($nama as $key => $value){
    if($bape[$key] != ""){
       mysql_query("INSERT INTO cps_elemen SET id_cps=$no_urut,id_elemen=$value,id_bukti='$bape[$key]'"); 
    //    echo $value.' - ';
    //echo $bape[$key].' - ';

   // echo"<br/>";    
    }
    
}
		$pesan="File ".$type_lampiran_apl2." sukses diupload.";
}else{
    $pesan="File ".$type_lampiran_apl2." GAGAL diupload.";
}
				
				}else{
					$pesan="File ".$filename_lampiran_apl2." tidak bisa diupload.";
				}
			}else{
				$pesan="Files yang anda upload (<b>".$type_lampiran_apl2."</b>) tidak sesuai dengan format yg ditentukan, yang diijinkan (.zip)";
			}
		}else{
			$pesan="Terdapat file yg lebih besar dari ".($max_file_size/1024)." Kb.";
		}
        }else{
            $pesan="Tidak Ada File.";
        }
        echo $pesan;
     ?>
