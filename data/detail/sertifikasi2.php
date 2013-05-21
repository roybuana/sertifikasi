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
    $('#fm_apl2').form({
            url:'data/detail/proses_form2.php', 
            onSubmit:function(){
                        
            $("#fm_apl2").form('validate');
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
    <div title="FR-APL-02" style="overflow:auto;padding:5px;" >
    <form method="post" id="fm_apl2" enctype="multipart/form-data">
    <input type="hidden" value="<?php echo $id ?>" name="id" />  
    <?php
    $kueri_apl2=mysql_query("SELECT * FROM unit_komp WHERE id_bidang=1");
    while($array_apl2=mysql_fetch_array($kueri_apl2)){
        echo"<fieldset><legend>";
        echo"Nomor :".$array_apl2['kode'];
        echo"<br/>";
        echo"Judul :".$array_apl2['judul'];
        echo"</legend>";
         $kueri_elemen=mysql_query("SELECT * FROM unit_komp_elemen WHERE id_unit_komp=$array_apl2[id]");
         while($array_elemen=mysql_fetch_array($kueri_elemen)){
            echo"<table border='1' cellpadding='2' cellspacing='2' class='grid_rpl2' width='85%'>";
    
            echo"<tr><td colspan=5>Elemen Kompetensi : $array_elemen[elemen]</td></tr>";
            echo"<tr><td align='center' vertical-align: middle; width='40%'>Kriteria Unjuk Kerja</td>
            <td align='center'  vertical-align: middle; width='40%'>Daftar Pertanyaan(Asesmen Mandiri/ Self Assessment)</td>
            
            <td  align='center' vertical-align: middle;>Bukti-bukti Pendukung<br/>
            <strong style='color: red;'>(jika Kompeten)</strong>
             </td>
            </tr>";
            
$kueri_uk=mysql_query("SELECT * FROM unit_komp_unjuk_kerja WHERE id_elemen=$array_elemen[id]");
while($array_unjuk=mysql_fetch_array($kueri_uk)){
    //$name_radio=$array_unjuk['id'];
    //$name_bp=$array_unjuk['id'];
    $arr=$array_unjuk['id'];
    $a=mysql_query("SELECT * FROM cps_elemen WHERE id_cps=$id AND id_elemen=$arr");
    if(mysql_num_rows($a)==1){
        $arr=mysql_fetch_array($a);
        $b="style='background-color: #33FF33;'";
        $k=$arr['id_bukti'];
    }else{
        $k='';
        $b='';
    }
                echo"<tr><td>$array_unjuk[unjuk_kerja]</td><td>$array_unjuk[pertanyaan]</td>
                
                
                <td align='center' vertical-align: middle; $b>$k</td></tr>";
            }      
                
            echo"</table>";
            echo"<p></p>";    
         }
        echo"</fieldset>";
         echo"<br/>";
         
    }
    ?> 
    <table border="1" style="border-style: dotted;">
    
    
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
<tr><td></td><td><input type="submit" value="Simpan" /> *Klik Untuk Menyimpan</td></tr>
    <tr><td colspan="2"><img src="images/kode_bukti.jpg" /></td></tr>
    
   </table>
    </form>
    </div>
    <p></p>
    <p></p>
    </div>
    
</div>
        
        