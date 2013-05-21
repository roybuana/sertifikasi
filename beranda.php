<?php
 require_once("lib/fn_lib.php");
 //session_start();
	
 
 ?>
  <style type="text/css">
  @media screen and (min-width: 400px) and (max-width: 700px) {
	.konten_beranda{float:left; width:60%;}
    
}
@media screen and (min-width: 701px) and (max-width: 1700px) {
   	.konten_beranda{float:left; width:45%;}
   
}
a{
 text-decoration: none;   
}
a:hover{
 text-decoration: underline; 
}

    
</style>
	<script type="text/javascript">
//var resolusi=window.screen.availHeight;    
   
    
		$(function(){
		  
         
		  $('#tta').tabs({  
                border:false
            });
		 
		
    });
		   
                     
	</script>
</head>
<body>   
<div id="konten">
<div id="tta" class="easyui-tabs" style="width: auto;" >  
        <div title="Agenda Utama" style="overflow:auto;padding:5px;">  
             <?php
require_once("lib/fn_lib.php");
 
$batas=6;
if(isset($_GET['halaman'])){
$halaman=$_GET['halaman'];    
}

if(empty($halaman))
{
    $posisi=0;
    $halaman=1;
}
else
{
    $posisi = ($halaman-1) * $batas;
}

$tampil="SELECT * FROM kegiatan WHERE id_user=6 AND status_aktif='Y' limit $posisi,$batas";
$kueri_kegiatan=mysql_query($tampil);
///

while($row_berita=mysql_fetch_array($kueri_kegiatan)){
?>
<div id="div_kegiatan" class="konten_beranda">
<?php echo tgl_indo($row_berita['tgl_mulai']) ?>
<div style="height:8px"></div>
<fieldset style=" background-color: #e5dbdb;">
<legend><strong><?php echo $row_berita['nm_kegiatan'] ?></strong></legend>
<table>
<tr>
<td>Tanggal</td><td>:</td><td><?php echo tgl_indo($row_berita['tgl_mulai']).' s/d '.tgl_indo($row_berita['tgl_berakhir']) ;?></td>
</tr>
<tr>
<td>Tempat</td><td>:</td><td><?php echo $row_berita['tempat'] ;?></td>
</tr>
<tr>
<td>PIC BNSP</td><td>:</td><td><?php $nama=mysql_fetch_array(mysql_query("SELECT * FROM user WHERE id_user=$row_berita[pic_bnsp]"));
echo $nama['nm_user'];
?></td>
</tr>
<tr>
<td>PIC SEKRETARIAT</td><td>:</td><td><?php $nama=mysql_fetch_array(mysql_query("SELECT * FROM user WHERE id_user=$row_berita[pic_sekretariat]"));
echo $nama['nm_user'];
?></td>
</tr>
<tr></tr>
</table>




</fieldset>

</div> 

<?php
}
?>
<br />
<?php
$file="index.php";

$tampil2="SELECT * FROM kegiatan WHERE id_user=6 AND status_aktif='Y'";
$hasil2=mysql_query($tampil2);
$jmldata=mysql_num_rows($hasil2);

$jmlhalaman=ceil($jmldata/$batas);


//link ke halaman sebelumnya (previous)
if($halaman > 1)
{
    $previous=$halaman-1;
    echo "<A href=$file?halaman=1><< First</A> |
        <A href=$file?halaman=$previous>< Previous</A> | ";
}
else
{
    echo "<< First | < Previous | ";
}

$angka=($halaman > 3 ? " ... " : " ");
for($i=$halaman-2;$i<$halaman;$i++)
{
  if ($i < 1)
      continue;
  $angka .= "<a href=$file?halaman=$i>$i</A> ";
}

$angka .= " <b>$halaman</b> ";
for($i=$halaman+1;$i<($halaman+3);$i++)
{
  if ($i > $jmlhalaman)
      break;
  $angka .= "<a href=$file?halaman=$i>$i</A> ";
}

$angka .= ($halaman+2<$jmlhalaman ? " ...  
          <a href=$file?halaman=$jmlhalaman>$jmlhalaman</A> " : " ");

echo "$angka";

//link kehalaman berikutnya (Next)
if($halaman < $jmlhalaman)
{
    $next=$halaman+1;
    echo " | <A href=$file?halaman=$next>Next ></A> |
  <A href=$file?halaman=$jmlhalaman>Last >></A> ";
}
else
{
    echo " | Next > | Last >>";
}
//echo "<p>Total Kegiatan : <b>$jmldata</b> orang</p>";

?>
	    </div>  
      
          
        
        <div title="Berita Pilihan">  
        </div> 
       
    </div>
   
</body>
</html><style>
#div_kegiatanX{
    background-color: fuchsia;
}
</style>
    