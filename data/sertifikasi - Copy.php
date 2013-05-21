<?php
session_start();
require_once('../lib/fn_lib.php');
$sid=$_SESSION['id'];
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
function downloadForm(){
    window.open("cetak/cetak_formulir.php?id="+k_id);
}
function setnegara(){
           $('#kebangsaan').combogrid('setValue', 'ID'); 
        }
$(function(){
    $('#list_kode').hide();
     $('#file_bukti_pendidikan').combogrid({
                    panelWidth:600,  
                    panelHeight:250,
                    idField:'id',  
                   
                    multiple:false,
                    columns:[[
                     {field:'ck',checkbox:'true',title:'all',width:25,align:'center'}, 
             
                        {field:'id',title:'Kode Bukti',width:80,align:'center'},  
                        {field:'tipe',title:'Keterangan',width:420,editor:'numberbox'},  
                       ]],
                    url:'template/json/combogrid/cb_bp.php', 
                    valueField:'id',  
                    textField:'tipe' ,
                     onHidePanel:function(){
                        $('#list_kode').show();
                         var list_bp= $('#file_bukti_pendidikan').combogrid('getValues');
                          $('#hasil_list').text(list_bp); 
                        }
        })
    $('#unit_komp').combogrid({  
            panelWidth:650,  
            idField:'id',  
            width:250,
            textField:'judul',  
            multiple:true,
            url:'template/json/combogrid/cb_unit_komp.php',  
            columns:[[  
                {field:'kode',title:'Kode Unit Komp',width:150,align:'center'},  
                {field:'judul',title:'Judul Unit Kompetensi',width:450},  
               ]],
               onHidePanel:function(){
                $('#tombol_simpan').show();
                $('#myDiv').remove();
                $('#div_uk').append("<div id='myDiv'><table id='tabelKu' border='1' width='auto'><tr><th>No</th><th>Unit Kompetensi</th><th>Kode Bukti</th></tr></table></div>");
                var list_uk= $('#unit_komp').combogrid('getValues');
                var list_uk_text= $('#unit_komp').combogrid('getText');
                var tess=list_uk.toString();
                var tess2=list_uk_text.toString();
               
                var myArray = tess.split(',');
                var myArray2 = tess2.split(',');


                // display the result in myDiv
                for(var i=0;i<myArray.length;i++){
                    var no=i + 1;
                   // var cetak=document.write(myArray2[i]);
                    $('#tabelKu').append("<tr><td>"+no+" </td><input type='text' value="+myArray[i]+" /><td>"+myArray2[i]+"</td><td><input  class='kode_bukti_pendukung' name='kode_bukti_pendukung[]'/></td></tr>");
                    
                    //("<table border=1><tr><th>NO</th><th>Nama UK</th><th>Kode File</th><th>File Pendukung</th></tr><tr><td>"+no +"</td><td>"+myArray2[i]+"</td><td></td><td></td></tr></table><div style'width=300px'>"+myArray2[i]+"</div><div><input type='file' name='array_uk["+myArray[i]+"]' /></div>");
                }
                $('.kode_bukti_pendukung').combogrid({
                    panelWidth:600,
                    panelHeight:255,  
                    idField:'id',  
                    width:220,
                    multiple:true,
                    columns:[[  
                        {field:'id',title:'Kode Bukti',width:80,align:'center'},  
                        {field:'tipe',title:'Keterangan',width:490},  
                       ]],
                    url:'template/json/combogrid/cb_bp.php', 
                    valueField:'id',  
                    textField:'id' 
        })
               }  
        }); 
        $('#show_uk').live('click',function(){
            $('#tombol_simpan').show();
                $('#myDiv').remove();
                $('#div_uk').append("<div id='myDiv'><table id='tabelKu' border='1' width='auto'><tr><th>No</th><th>Unit Kompetensi</th><th>Kode Bukti</th></tr></table></div>");
                var list_uk= $('#unit_komp').combogrid('getValues');
                var list_uk_text= $('#unit_komp').combogrid('getText');
                var tess=list_uk.toString();
                var tess2=list_uk_text.toString();
               
                var myArray = tess.split(',');
                var myArray2 = tess2.split(',');


                // display the result in myDiv
                for(var i=0;i<myArray.length;i++){
                    var no=i + 1;
                   // var cetak=document.write(myArray2[i]);
                    $('#tabelKu').append("<tr><td>"+no+" </td><input type='text' value="+myArray[i]+" /><td>"+myArray2[i]+"</td><td><input  class='kode_bukti_pendukung' name='kode_bukti_pendukung[]'/></td></tr>");
                    
                    //("<table border=1><tr><th>NO</th><th>Nama UK</th><th>Kode File</th><th>File Pendukung</th></tr><tr><td>"+no +"</td><td>"+myArray2[i]+"</td><td></td><td></td></tr></table><div style'width=300px'>"+myArray2[i]+"</div><div><input type='file' name='array_uk["+myArray[i]+"]' /></div>");
                }
                $('.kode_bukti_pendukung').combogrid({
                    panelWidth:600,
                    panelHeight:255,  
                    idField:'id',  
                    width:220,
                    multiple:true,
                    columns:[[  
                        {field:'id',title:'Kode Bukti',width:80,align:'center'},  
                        {field:'tipe',title:'Keterangan',width:490},  
                       ]],
                    url:'template/json/combogrid/cb_bp.php', 
                    valueField:'id',  
                    textField:'id' 
        })
        })
        
    $('#tutup_form').linkbutton({  
        iconCls: 'icon-cancel'  
    });
    $('#skema_sertifikasi,#kontak_asesmen,#acuan_pembanding,#tuk').combobox({  
    }); 
    $('#dialog_form').dialog({  
        title: 'Ringkasan Form Registrasi',  
        width: 900,  
        height: 550,  
        closed: true,  
        cache: false,  
        modal: true  
    }); 
    $('#fm_form').form({ 
        })
    $('#ttserta,#ttaa').tabs({  
        border:false,  
         
    }); 
       
// $("#nama_sekolah").mouseup(function(){
 //   $('#aa').accordion('select','Data permohonan sertifikasi'); 
 //});
        $('#aa').accordion({
            width:800,
            height:'auto'
        });
        $('#nama,#hp,#emailku,#lampiran').validatebox({
            required:true
        })
        $('#tgl_lahir').datebox({  
           
            panelWidth:200 
        });
        $('#kebangsaan').combogrid({  
            panelWidth:450,  
            idField:'ccode',  
            textField:'country',
            mode: 'remote', 
            url:'template/json/combogrid/cb_negara.php',  
            columns:[[  
                {field:'ccode',title:'Kode Negara',width:100},  
                {field:'country',title:'Nama Negara',width:300},  
               ]]  
        }); 
        
       
       
        $('#form_manual').form({
            url:'proses_form_manual.php', 
            onSubmit:function(){
            return $(this).form('validate');
            },success:function(pesan){
                alert(pesan);
                //$('#form_manual').form('clear');
           }
        });
        $('#form_registrasi').form({
            url:'data/proses_form.php', 
            onSubmit:function(){
                        
            var result =  $("#form_registrasi").form('validate');            
            if(result){               
              // $(":submit", this).attr("disabled", "disabled");
               $.messager.progress({
                
                text : 'Tunggu sampai form ini tertutup!',
                interval : 100
               });
            }
            return result;
            
            },success:function(xr){
               
                $.messager.progress('close'); 
               // alert(xr);               
                    $("#fm_form").html(xr); 
                    $('#dialog_form').dialog('open').dialog('settsertitle','Ringkasan Form Registrasi Sertifikasi');
                        $('#form_registrasi').form('clear');
               
            }
        });
      
        
    })
    </script>
</head>

<div id="ttserta"  style="width: auto;">  
    <div title="Formulir Online" style="overflow:auto;padding:5px;">
        <form id="form_registrasi" enctype="multipart/form-data" method="post"  name="form_registrasi">
        <input type="hidden" value="<?php echo $sid ?>" name="id_user" />  
        <fieldset id="field_form"><legend>Data Pribadi</legend>
        <table>
        <tr ><td>Nama Lengkap :</td><td><input name='nama' id='nama'  style="width: 350px;" /><strong style="color: red;">*</strong></td></tr>
        <tr><td>Tempat  :</td><td> <div><input id="tmp_lahir" name="tmp_lahir" style="width: 150px;"/> Tgl Lahir : <input style="width: 143px;" id="tgl_lahir" name="tgl_lahir"  /></div></td></tr>
        <tr><td>Jenis Kelamin :</td><td><input value="Laki-laki" type="radio" id="jen_kel" name="jen_kel"/>Laki-laki<input type="radio" id="jen_kel" name="jen_kel" value="Perempuan"/>Perempuan</td></tr>
        <tr><td>Kebangsaan :</td><td><input style="width: 352px;"  id="kebangsaan"  name="kebangsaan" size="40"/><a href="#" onclick="setnegara()">Indonesia</a></td></tr>
        <tr><td>Alamat Rumah:</td><td><textarea name="alamat" id="alamat" rows="3" cols="41"></textarea></td></tr>
        <tr><td></td><td>Kode Pos : <input id="ko_pos"  name="ko_pos" size="10"/></td></tr>
        <tr><td>No Telepon / HP:</td><td><input style="width: 147px;" id="hp"  name="hp" size="21"/><strong style="color: red;">*</strong></td></tr>
        <tr><td>Email :</td><td><input style="width: 350px;" id="emailku"   name="emailku" size="40" data-options="validType:'email'" /><strong style="color: red;">*</strong></td></tr>    
        <tr><td></td><td></td></tr>
        </table>
        </fieldset> 
        
        <fieldset id="field_form"><legend>Data Pendidikan (Hanya diisi dengan pendidikan formal terakhir dan dilampiri bukti dokumen)</legend>
        <table>
        <tr><td width="130px">Nama Sekolah/Lembaga :</td><td><input style="width: 306px;"  name='nama_sekolah' id='nama_sekolah'  size="40" /></td></tr>
        <tr><td>Jurusan/Program :</td><td> <div><input style="width: 306px;" id="jurusan" name="jurusan" size="40"/></div></td></tr>
        <tr><td>Strata (Untuk S1 keatas) :</td><td><input id="strata" name="strata" size="1"/> Tahun Lulus <input id="thn_lulus" name="thn_lulus" size="4"/></td></tr>
         <tr><td>Bukti Dokumen Pendidikan:</td><td><input style="width: 306px;" id="file_bukti_pendidikan" name="file_bukti_pendidikan"/>
         
          </td></tr>
        
        <tr><td></td><td>
        </table>
        </fieldset>
        
        <fieldset id="field_form"><legend>Data Pekerjaan Sekarang</legend>
        <table>
        <tr><td width="150px">Nama Lembaga/ Perusahaan  :</td><td><input style="width: 290px;" name='nama_perusahaan' id='nama_perusahaan'  size="40" /></td></tr>
        <tr><td>Jabatan :</td><td> <div><input style="width: 290px;" id="jabatan" name="jabatan" size="40"/> </div></td></tr>
        <tr><td>Alamat :</td><td><textarea id="alamat_kantor" name="alamat_kantor" rows="3" cols="34"></textarea></td></tr>
        <tr><td></td><td>Kode Pos : <input id="ko_pos_kantor"  name="ko_pos_kantor" size="10"/></td></tr>
        <tr><td>No Telepon / HP:</td><td><input style="width: 130px;" id="telp_kantor"  name="telp_kantor" size="21"/> Fax : <input style="width: 130px;" id="fax" name="fax" /></td></tr>
        <tr><td>Email :</td><td><input id="email_kantor"  name="email_kantor" style="width: 294px;" /></td></tr>    
        <tr><td></td><td></td></tr>
        </table>
        </fieldset>
        
        <fieldset id="field_form"><legend>Data permohonan sertifikasi</legend>
        <table>
        <tr><td></td><td><strong style="color: red;">* Data harus Diisi</strong></td></tr>
        <tr><td></td><td><strong style="color: red;">** Klik tanda <img border="1" style="border-color: red;" src="images/panduan/combo.png" /> Untuk Menutup pilihan Dan Dapat memilih lebih dari 1 opsi</strong></td></tr>
        <tr><td></td><td><strong style="color: red;">*** File harus berbentuk zip</strong></td></tr>
        <tr><td>Tujuan asesmen :</td><td>
        <input type="checkbox" name='t_asesmen[]' id='t_asesmen' value="Pencapaian  Proses pembelajaran"/> Pencapaian  Proses pembelajaran
        <input type="checkbox" name='t_asesmen[]' id='t_asesmen' value="RPL"/> RPL
        <input type="checkbox" name='t_asesmen[]' id='t_asesmen' value="RCC"/> RCC
        <input type="checkbox" name='t_asesmen[]' id='t_asesmen' value="Sertifikasi"/> Sertifikasi
        <input type="text" name='t_asesmen_1' id='t_asesmen'/> Lainnya
        </td></tr>
        
        <tr><td>Kontek asesmen :</td><td>
        <select id="kontak_asesmen"  name="kontak_asesmen[]" style="width:200px;" multiple="true" panelHeight="auto">  
        <option value="1">TUK Simulasi</option>  
        <option value="2">Tempat Kerja</option>  
        
        </select> <strong style="color: red;">**</strong>
        
        
        </td></tr>
        <tr><td>Acuan pembanding :</td><td>
        <select id="acuan_pembanding" class="easyui-combobox" name="acuan_pembanding[]" style="width:200px;" multiple="true" panelHeight="auto">  
        <option value="1">Standar kompetensi</option>  
        <option value="2">standar produk</option>  
        <option value="3">standar sistem</option>  
        <option value="4">regulasi teknis</option>
        <option value="5">SOP</option>  
        </select> <strong style="color: red;">**</strong>
        </td></tr>
        <tr><td>TUK :</td><td>
        <select id="tuk"  name="tuk" style="width:200px;" panelHeight="auto">  
        <option value="1">PIKI</option>  
        <option value="2">BBPLKLN Cavest</option>  
        <option value="3">BPPLKDN Bandung</option> 
        </select><strong style="color: red;"> **</strong> </td></tr>
         <tr><td>Skema Sertifikasi :</td><td>Instruktur Junior</td></tr>
          <tr><td>Unit Kompetensi :</td><td>
          
           <input id="unit_komp"  name="unit_komp[]"/><strong style="color: red;">**</strong> </td></tr>
        
       
        <tr><td>Unit Kompetensi yg di Pilih :</td><td> <div id="div_uk"><a href="#" id="show_uk">Klik Untuk Menampilkan Unit Kompetensi</a></div><div id="myDiv"></div></div></td></tr>
        <tr><td></td><td><div style="margin-right: 3px; height: 250px; background-color: white;">
        Aturan dalam mengirimkan file lampiran
        <ul>
            <li>Setiap Jenis bukti dokumen di masukkan ke dalam folder dengan diberi nama depan sesuai dengan kode bukti </li>
            <li><img border="1" style="border-bottom-style: dotted;" src="images/lampiran.jpg" /></li>
            <li>Kemudian beberapa folder tersebut di jadikan satu folder dengan nama anda kemudian di kompres dengan zip/rar</li>
            <li><img src="images/lampiran2.jpg" style="border-bottom: dotted;" border="1" /></li>
            <li>Batas Maksimal File adalah 5 MB</li>
            <li><a href="http://www.filehippo.com/download_7zip_32/" target="_blank">Download Aplikasi Compress(zip)</a></li>
            
        </ul>
        </div></td></tr>
        <tr><td>Lampiran File Bukti</td><td><input id="lampiran" type="file"  name="lampiran" />
        <strong style="color: red;">***</strong></td></tr>
        
        <tr><td></td><td><input type="submit" value="Simpan" />
        Klik untuk menyimpan Data</td></tr>
        </table>
        </fieldset>
       
    </div>
    </form>
    <div title="Formulir Manual" style="overflow:auto;padding:5px;" >
    <form id="form_manual" enctype="multipart/form-data" method="post"  name="form_manual">

        <h3>Download Formulir Manual</h3>
        <ul style="list-style: lower-latin;">
            <li><a href="FR-APL-01.doc" target="_blank">Form FR-APL-01</a></li>
            <li><a href="FR-APL-02.doc" target="_blank">Form FR-APL-02</a></li>
        </ul>
        <table>
        <tr><td>Email</td><td><input id="email_manual"  name="email_manual" size="40" /></td></tr>
        <tr><td>Formulir Pendaftaran Manual :</td><td><input id="file_input_manual" type="file" name="file_input_manual" required="true" class="easyui-validatebox" /></td></tr>
        <tr><td></td><td><input type="submit" value="Upload" />*Klik untuk menyimpan</td></tr>
         </table>
</form>
    </div>
    <div title="Petunjuk" style="overflow:auto;padding:5px;background-color: green;" >
        <img src="images/panduan/1.png" />
         <br />
         <div id="ttaa" class="easyui-tabs" style="width: auto;">  
            <div title="Petunjuk Formulir Online" style="overflow:auto;padding:5px; ">
            <img src="images/panduan/2.png" />
            <br />
            <img src="images/panduan/3.png" />
            <br />
            <img src="images/panduan/4.png" />
            </div>
            <div title="Petunjuk Formulir Manual" style="overflow:auto;padding:5px;">
            <img src="images/panduan/5.png" />
            <br />
            </div>
         </div>
    </div>
</div>
        
<div id="dialog_form"  style="width:750px;height:auto;top:5px;"  
            closed="true" buttons="#dlg-buttons" draggable="true" modal="true">  
        <!-- 
        <div class="ftitle" id="f_title"></div>
         -->  
        <form id="fm_form" method="post" class="formLayout">  
              
        </form>  
    </div> 
     <div id="dlg-buttons">  
        
        <a id="tutup_form" onclick="javascript:$('#dialog_form').dialog('close')">Tutup Form</a>  
    </div>      

        