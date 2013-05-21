<?php
session_start();
require_once('../../lib/fn_lib.php');
$sid=$_SESSION['id'];
$id_users=intval($_GET['id_users']);
$id=intval($_GET['id']);
$array=mysql_fetch_array(mysql_query("SELECT * FROM cps WHERE id=$id"));
?><head>
<meta httsertp-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Formulir Pendaftaran Sertifikat</title>
  <style type="text/css">
        a{
         text-decoration: none;   
        }
        a:hover{
         text-decoration: underline; 
        }
        #field_form {
        	background:#EBF4FB none repeat scroll 0 0;
        	border:2px solid #B7DDF2;
        	width: 900px;
            margin-bottom: 10px;
        }
        .field_form_confirm {
        
        	border:2px solid #B7DDF2;
        	width: 700px;
            margin-bottom: 10px;
        }
        legend {
        	color: #fff;
        	background: #80D3E2;
        	border: 1px solid #781351;
        	padding: 2px 6px
        }
    </style>
  <script type="text/javascript">
$(function(){
    $('#hasil').combobox({
        panelHeight:'auto'
    });
    $('#form_registrasi').form({
            url:'data/detail/proses_form.php', 
            onSubmit:function(){
                        
            $("#form_registrasi").form('validate');
            }
            ,success:function(xr){
                alert(xr);
                $('#tt').datagrid('reload');
            }
        });
    $('#ttserta,#ttaa').tabs({  
        border:false,  
         
    }); 
       
    })
    </script>
</head>

<div id="ttserta"  style="width: auto;">  
    <div title="FR-APL-01" style="overflow:auto;padding:5px;">
        <form id="form_registrasi" method="post"  name="form_registrasi">
        <input type="hidden" value="<?php echo $id ?>" name="id" />  
        <fieldset id="field_form"><legend>Data permohonan sertifikasi</legend>
        <table>
        <tr><td width="14%">Tujuan asesmen :</td><td>
        <?php
        $kueri_tujuan=mysql_query("SELECT * FROM cps_tujuan_asesmen WHERE id_cps=$id");
        if(mysql_num_rows($kueri_tujuan) >= 1){
            echo"<ul>";
            while($array=mysql_fetch_array($kueri_tujuan)){
                echo "<li>".$array['tujuan_asesmen']."</li>";
            }
            echo"</ul>";
        }
        ?>
         </td></tr>
        <tr><td>Kontek asesmen :</td><td>
         <?php
        $kontek_asesmen=mysql_query("SELECT * FROM cps_kontek_asesmen WHERE id_cps=$id");
        if(mysql_num_rows($kontek_asesmen) >= 1){
            echo"<ul>";
            while($arraykontek_asesmen=mysql_fetch_array($kontek_asesmen)){
                echo "<li>".$arraykontek_asesmen['kontek_asesmen']."</li>";
            }
            echo"</ul>";
        }
        ?>
        
        </td></tr>
        
        <tr><td>Acuan pembanding :</td><td>
        <?php
        $acuan_pembanding=mysql_query("SELECT * FROM cps_acuan_pembanding WHERE id_cps=$id");
        if(mysql_num_rows($acuan_pembanding) >= 1){
            echo"<ul>";
            while($arrayacuan_pembanding=mysql_fetch_array($acuan_pembanding)){
                echo "<li>".$arrayacuan_pembanding['acuan_pembanding']."</li>";
            }
            echo"</ul>";
        }
        ?>
        </td></tr>
         <tr><td>Skema Sertifikasi </td><td>Instruktur Junior</td></tr>
          <tr><td>Unit Kompetensi :</td><td>
        <?php
        $unit_kompetensi=mysql_query("SELECT cps_unit_kompetensi.id_cps,unit_komp.judul,cps_unit_kompetensi.id_kode_pendukung,kode_bukti_pendukung.tipe
FROM cps_unit_kompetensi
JOIN unit_komp ON unit_komp.id=cps_unit_kompetensi.id_unit_komp
JOIN kode_bukti_pendukung ON kode_bukti_pendukung.id=cps_unit_kompetensi.id_kode_pendukung
WHERE cps_unit_kompetensi.id_cps=$id");
        if(mysql_num_rows($unit_kompetensi) >= 1){
            echo"<table border=1 cellpadding=2 cellspacing=2>";
            echo"<tr><th>Unit Kompetensi</th><th>Kode</th><th>Keterangan Bukti</th>";
            while($arrayunit_kompetensi=mysql_fetch_array($unit_kompetensi)){
                echo "<tr><td>".$arrayunit_kompetensi['judul']."</td><td>".$arrayunit_kompetensi['id_kode_pendukung']."</td><td>
                ".$arrayunit_kompetensi['tipe']."</td>";
            }
            echo"</table>";
        }
        ?>
        </td></tr>
        <tr><td colspan="2">Download File Bukti Pendukung
         <?php
         $array2=mysql_fetch_array(mysql_query("SELECT * FROM cps WHERE id=$id"));
         
          echo "<a href='file_lampiran/$array2[lampiran]'>--Download--</a>"; ?></td></tr>
          <tr>
<td>Catatan:</td>
<td><textarea rows='5' cols='35' name='catatan' id='catatan'></textarea>
</td>
</tr>  
          <tr><td>Hasil Asesmen</td><td>
          <select name='hasil' id='hasil'>
            <option value=''>Pilih</option>
            <option value='1'>Kompeten</option>
            <option value='2'>Tidak Kompeten</option>
         </select>
          </td></tr>
        <tr><td></td><td><input type="submit" value="Simpan" />
        Klik untuk menyimpan Data</td></tr>
        </table>
        </fieldset>
       
    </div>
    </form>
    </div>
    
</div>
        
 

        