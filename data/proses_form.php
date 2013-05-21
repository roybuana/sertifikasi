<?php
session_start();
require_once("../lib/fn_lib.php");


$nama=$_POST['nama'];
$tmp_lahir=$_POST['tmp_lahir'];
$tgl_lahir=$_POST['tgl_lahir'];
$jen_kel=$_POST['jen_kel'];
if(isset($_POST['kebangsaan'])){
    $kebangsaan=mysql_fetch_array(mysql_query("SELECT * FROM countries WHERE ccode='$_POST[kebangsaan]'"));
    $kebang=$kebangsaan['country'];
}  
$alamat=$_POST['alamat'];
$ko_pos=$_POST['ko_pos'];
$hp=$_POST['hp'];
$email=$_POST['emailku'];
 
 //step dua
$nama_sekolah=$_POST['nama_sekolah'];
$jurusan=$_POST['jurusan'];
$strata=$_POST['strata'];
$thn_lulus=$_POST['thn_lulus'];
  
 //step tiga
$nama_perusahaan=$_POST['nama_perusahaan'];
$jabatan=$_POST['jabatan'];
$alamat_kantor=$_POST['alamat_kantor'];
$ko_pos_kantor=$_POST['ko_pos_kantor'];
$telp_kantor=$_POST['telp_kantor'];
$fax=$_POST['fax'];
$email_kantor=$_POST['email_kantor'];
 $id_user=$_POST['id_user'];
 //step empat
$tmp_lampiran = $_FILES['lampiran']['tmp_name'];
$type_lampiran = $_FILES['lampiran']['type'];
$size_lampiran = $_FILES['lampiran']['size'];
$filename_lampiran = $_FILES['lampiran']['name'];
$mimetype_lampiran = array('application/zip','application/octet-stream'); // Tambahkan mime sesuai kebutuhan
//'application/octet-stream',$mimetype_lampiran = array('application/octet-stream','application/msword','application/x-zip-compressed','application/pdf'); // Tambahkan mime sesuai kebutuhan
$path = '../file_lampiran/'; //Tempat file yg akan di letakkan
$max_file_size = 10485760; // Maksimal file yg diupload (100Kb)

	// jika tedapat file yg diupload
if($filename_lampiran != ''){
if($size_lampiran <= $max_file_size){ // cek besar ukuran yg diupload
	if(in_array($type_lampiran,$mimetype_lampiran,TRUE)){ // cocokkan dengan tipe mime yang telah di tentukan
    $kueri_id=mysql_fetch_array(mysql_query("SELECT MAX(id) as besar FROM cps"));
$no_urut=$kueri_id['besar']+1;

		if(move_uploaded_file($tmp_lampiran,$path.$no_urut.'_'.$filename_lampiran)){
			$pesan="<font color=\"green\">File ".$type_lampiran." sukses diupload.</font><br />";
            $dokumen='ok';
            $tuk=$_POST['tuk'];

//$link='<a href="cetak/cetak_formulir.php?id='.$no_urut.'" target="_blank" /><h2>Download Dalam Bentuk PDF</h2></a>';
//echo $link;
 
                    $kueri_database=mysql_query("INSERT INTO cps SET id=$no_urut
                    ,lampiran='".$no_urut."_".$filename_lampiran."',
                    nama='$nama',
                    tmp_lahir='$tmp_lahir',tgl_lahir='$tgl_lahir',jen_kel='$jen_kel',kebangsaan='$kebang',alamat='$alamat',ko_pos='$ko_pos',
                    hp='$hp',email='$email',nama_sekolah='$nama_sekolah',jurusan='$jurusan',strata='$strata',
                    thn_lulus='$thn_lulus',dokumen_pendidikan='$filename_lampiran',
                    nama_perusahaan='$nama_perusahaan',jabatan='$jabatan',alamat_kantor='$alamat_kantor',ko_pos_kantor='$ko_pos_kantor',
                    telp_kantor='$telp_kantor',type_form='FR-APL-01',fax='$fax',email_kantor='$email_kantor',tuk='$tuk',tgl_daftar=SYSDATE(),id_users=$id_user");
				//	unlink($path.$file[$i]);
				}else{
					$pesan="<font color=\"red\">File ".$filename_lampiran." tidak bisa diupload.</font><br />";
				}
			}else{
				$pesan="<font color=\"red\">Files yang anda upload (<b>".$type_lampiran."</b>) tidak sesuai dengan format yg ditentukan, yang diijinkan (.zip)</font><br />";
			}
		}else{
			$pesan="<font color=\"red\">Terdapat file yg lebih besar dari ".($max_file_size/1024)." Kb.</font><br />";
		}
        }else{
            $pesan="<font color=\"red\">Tidak Ada File.</font><br />";
        }
 ?>
 <?php if($dokumen=='ok'){?>
 <fieldset class="field_form_confirm">
<legend><strong>Rincian Data Peserta</strong></legend>
<table border="0" cellpadding="2" cellspacing="2" width="710px">
<tr style="background-color: #f0f0f0;"><td width="30%">Nama lengkap :</td><td>
<input type="hidden" id="kode_cps" name="kode_cps" type="hidden" value="<?php echo $no_urut ?>"/>
<?php echo $nama ?></td></tr>
<tr><td>Jenis kelamin  :</td><td><?php echo $jen_kel ?></td></tr>
<tr style="background-color: #f0f0f0;"><td>Tempat / tgl. lahir :</td><td><?php echo $tmp_lahir.",".$tgl_lahir ?></td></tr>
<tr><td>Kebangsaan :</td><td><?php echo $kebang ?></td></tr>
<tr style="background-color: #f0f0f0;"><td>Alamat rumah :</td><td><?php echo $alamat ?></td></tr>
<tr><td>Kode pos :</td><td><?php echo $ko_pos ?></td></tr>
<tr style="background-color: #f0f0f0;"><td>No. Telepon/HP :</td><td><?php echo $hp ?></td></tr>
<tr><td>E-mail :</em></td><td><?php echo $email ?></td></tr>
</table>
</fieldset>

<fieldset class="field_form_confirm">
<legend><strong>Rincian Data Pendidikan</strong></legend>
<table border="0" cellpadding="2" cellspacing="2" width="710px">
<tr style="background-color: #f0f0f0;"><td width="30%">Nama Sekolah/Lembaga : </td><td><?php echo $nama_sekolah ?></td></tr>
<tr><td>Jurusan/Program : </td><td><?php echo $jurusan ?></td></tr>
<tr style="background-color: #f0f0f0;"><td>Strata (Untuk S1 keatas)  : </td><td><?php echo $strata ?></td></tr>
<tr><td>Tahun lulus : </td><td><?php echo $thn_lulus ?></td></tr>
</table> 
</fieldset>
<fieldset class="field_form_confirm">

<legend><strong>Rincian Data Pekerjaan Sekarang</strong></legend>
<table border="0" cellpadding="2" cellspacing="2" width="710px">
<tr style="background-color: #f0f0f0;"><td width="30%">Nama Lembaga/ Perusahaan :</td><td><?php echo $nama_perusahaan ?></td></tr>
<tr><td>Jabatan :</td><td><?php echo $jabatan ?></td></tr>
<tr style="background-color: #f0f0f0;"><td>Alamat  :</td><td><?php echo $alamat_kantor ?></td></tr>
<tr><td>Kode pos :</td><td><?php echo $ko_pos_kantor ?></td></tr>
<tr style="background-color: #f0f0f0;"><td>No. Telepon/HP :</td><td><?php echo $telp_kantor ?></td></tr>
<tr ><td>Fax :</td><td><?php echo $fax ?></td></tr>

<tr style="background-color: #f0f0f0;"><td>E-mail Kantor:</td><td><?php echo $email_kantor ?></td></tr>
</table>
</fieldset>			

	 
<fieldset class="field_form_confirm">
<legend><strong>Rincian Data Permohonan Sertifikasi</strong></legend>
<table border="0" cellpadding="2" cellspacing="2" width="710px">
<tr style="background-color: #f0f0f0;"><td width="30%">Tujuan asesmen	:</td><td><?php

if(isset($_POST['t_asesmen'])){
    foreach($_POST['t_asesmen'] as $k=>$tujuan_asesmen){
    echo $k + 1 .". ".$tujuan_asesmen;
    mysql_query("INSERT INTO cps_tujuan_asesmen SET tujuan_asesmen='$tujuan_asesmen',id_cps=$no_urut");
    echo("<br>");  
    } 
    if(isset($_POST['t_asesmen_1']) && $_POST['t_asesmen_1']!=""){
     echo "Lainnya : ".$_POST['t_asesmen_1'];
     mysql_query("INSERT INTO cps_tujuan_asesmen SET tujuan_asesmen='$_POST[t_asesmen_1]',id_cps=$no_urut");
    }    
}


 ?></td></tr>
<tr><td>Skema sertifikasi :</td><td><?php

if(isset($_POST['skema_sertifikasi'])){
    foreach($_POST['skema_sertifikasi'] as $key=>$value){
        echo $key + 1 .". ".$value;
        echo("<br>");    
        mysql_query("INSERT INTO cps_skema_sertifikasi SET skema_sertifikasi='$value',id_cps=$no_urut");   
    }    
}

  ?></td></tr>
<tr style="background-color: #f0f0f0;"><td>Kontek asesmen  :</td><td><?php

if(isset($_POST['kontak_asesmen'])){
    foreach($_POST['kontak_asesmen'] as $key=>$value){
        if($value==1){
            $isi='TUK Simulasi';
        }else{
            $isi='Tempat Kerja';
        }
        echo $key + 1 .". ".$isi;
        echo("<br>");
         mysql_query("INSERT INTO cps_kontek_asesmen SET kontek_asesmen='$isi',id_cps=$no_urut");       
    }    
}


?></td></tr>
<tr><td>Acuan pembanding : </td><td><?php

if(isset($_POST['acuan_pembanding'])){
    foreach($_POST['acuan_pembanding'] as $key2=>$value2){
        if($value2==1){
            $isi2='Standar kompetensi';
        }else if($value2==2){
            $isi2='Standar produk';
        }else if($value2==3){
            $isi2='Standar sistem';
        }else if($value2==4){
            $isi2='Regulasi teknis';
        }else{
            $isi2='SOP';
        }
        echo $key2 + 1 .". ".$isi2;
        echo("<br>");       
        mysql_query("INSERT INTO cps_acuan_pembanding SET acuan_pembanding='$isi2',id_cps=$no_urut");
    }    
}

 
  ?></td></tr>
  <tr style="background-color: #f0f0f0;"><td>TUK :</td><td>
<?php

if(isset($_POST['tuk'])){
        if($_POST['tuk']==1){
            echo 'PIKI';
        }else if($_POST['tuk']==2){
            echo"BBPLKLN Cavest";
        }else{
            echo"BPPLKDN Bandung";
        }
}

?>
</td></tr>
</table>
</fieldset>
<fieldset class="field_form_confirm">
<legend><strong>Daftar Unit Kompetensi yg di Pilih</strong></legend>


<?php

if(isset($_POST['unit_komp'])){
    $implode_array=implode(',',$_POST['unit_komp']);
    $kueri=mysql_query("SELECT * FROM unit_komp WHERE id IN($implode_array)");
    echo"<table border='1' width='auto'><tr><th>No</th><th>Kode UK</th><th>Unit Kompetensi</th>
    <th>Kode Bukti</th></tr>";
    $no=1;
    $aray_kode=0;
    while($aray_kueri=mysql_fetch_array($kueri)){
        $bukti=$_POST['kode_bukti_pendukung'][$aray_kode];
        //file upload
        
        		
        //
        echo "<tr><td>$no</td><td>$aray_kueri[kode]</td><td>$aray_kueri[judul]</td><td>$bukti</td></tr>";
        mysql_query("INSERT INTO cps_unit_kompetensi SET id_unit_komp='$aray_kueri[id]',id_cps=$no_urut,
        id_kode_pendukung='$bukti'");      
        
        $no++;
        $aray_kode++;
     }    
    echo"</table>";
//    echo $link;
   

}
?>				 
</fieldset>

 <?php 
    }else{
        echo $pesan;
    }
     ?>
