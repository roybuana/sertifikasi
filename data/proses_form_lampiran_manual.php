<?php
session_start();
require_once("../lib/fn_lib.php");

$jenis_formulir=$_POST['jenis_formulir'];
$id_user=$_POST['id_user'];
$tmp_lampiran_manual = $_FILES['lampiran_manual']['tmp_name'];
$type_lampiran_manual = $_FILES['lampiran_manual']['type'];
$size_lampiran_manual = $_FILES['lampiran_manual']['size'];
$filename_lampiran_manual = $_FILES['lampiran_manual']['name'];
$mimetype_lampiran_manual = array('application/zip','application/octet-stream'); // Tambahkan mime sesuai kebutuhan
//'application/octet-stream',$mimetype_lampiran_manual = array('application/octet-stream','application/msword','application/x-zip-compressed','application/pdf'); // Tambahkan mime sesuai kebutuhan
$path = '../file_lampiran_manual/'; //Tempat file yg akan di letakkan
$max_file_size = 10485760; // Maksimal file yg diupload (100Kb)

	// jika tedapat file yg diupload

if($filename_lampiran_manual != ''){
if($size_lampiran_manual <= $max_file_size){ // cek besar ukuran yg diupload
	if(in_array($type_lampiran_manual,$mimetype_lampiran_manual,TRUE)){ // cocokkan dengan tipe mime yang telah di tentukan
    $kueri_id=mysql_fetch_array(mysql_query("SELECT MAX(id) as besar FROM cps"));
$no_urut=$kueri_id['besar']+1;

		if(move_uploaded_file($tmp_lampiran_manual,$path.$no_urut.'_'.$filename_lampiran_manual)){
		  $no=$no_urut;
foreach($jenis_formulir as $key=>$value){
    
    mysql_query("INSERT INTO cps SET id=$no,type_form='$value'
     ,tgl_daftar=SYSDATE(),id_users=$id_user,lampiran='".$no_urut."_".$filename_lampiran_manual."',jenis_form='manual'");
     $no++;
} 
 					$pesan="File ".$filename_lampiran_manual." Sukses diupload, Registrasi berhasil!";

				
				}else{
					$pesan=$filename_lampiran_manual." tidak bisa diupload.";
				}
			}else{
				$pesan="Files yang anda upload (<b>".$type_lampiran_manual."</b>) tidak sesuai dengan format yg ditentukan, yang diijinkan (.zip)";
			}
		}else{
			$pesan="Terdapat file yg lebih besar dari ".($max_file_size/1024)." Kb";
		}
        }else{
            $pesan="Tidak Ada File.";
        }
        echo $pesan;
     ?>
