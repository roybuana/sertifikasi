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
$(function(){
    $('#tutup_form').linkbutton({  
        iconCls: 'icon-cancel'  
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
        $('#jenis_formulir').combobox({
            multiple:true,
            width:200,
            required:true,
            panelHeight:'auto'
        }); 
        
       
       
        $('#fm_apl2').form({
             url:'data/proses_form_apl2.php',
            onSubmit:function(){
                        
            var result =  $("#fm_apl2").form('validate');            
            if(result){               
              // $(":submit", this).attr("disabled", "disabled");
               $.messager.progress({
                
                text : 'Tunggu sampai form ini tertutup!',
                interval : 100
               });
               return result;
             // return result;
             }
            },success:function(xr){
            $.messager.progress('close');
                //$("#fm_form").html(xr); 
                   // $('#dialog_form').dialog('open').dialog('settsertitle','Ringkasan Form APL 02');
                     //   $('#fm_apl2').form('clear');
                     alert(xr);
           }
        });
        $('#form_upload_manual').form({
            url:'data/proses_form_lampiran_manual.php', 
            onSubmit:function(){
                        
            var result =  $("#form_registrasi").form('validate');            
            if(result){               
              // $(":submit", this).attr("disabled", "disabled");
               $.messager.progress({
                
                text : 'Tunggu sampai form ini tertutup!',
                interval : 100
               });
               return result;
             }
           
            // return result;
            },success:function(xr){
               
                $.messager.progress('close'); 
                alert(xr);               
               
            }
        });
      
        
    })
    </script>
</head>

<div id="ttserta"  style="width: auto;">  
    <div title="Upload Formulir Manual" style="overflow:auto;padding:5px;">
    
        <form id="form_upload_manual" enctype="multipart/form-data" method="post"  name="form_upload_manual">
        <table border="1" cellpadding="3" cellspacing="3" style="margin-bottom: 20px;">
        <tr><td colspan="2">Download Formulir di sini <a href="images/Formulir_APL_01 dan APL_02.zip">link download</a></td></tr>
        <tr><td colspan="2"><div style="margin-right: 3px; height: 300px; background-color: white;">
        Aturan dalam mengirimkan file lampiran
        <ul>
        
        <li>Setiap Jenis bukti dokumen dan Formulir di masukkan ke dalam folder dengan diberi nama depan sesuai dengan kode bukti </li>
        <li><img border="1" style="border-bottom-style: dotted;" src="images/form_upload_manual.jpg" /></li>
        <li>Kemudian beberapa folder tersebut di jadikan satu folder dengan nama anda kemudian di kompres dengan zip/rar</li>
        <li><img src="images/lampiran2.jpg" style="border-bottom: dotted;" border="1" /></li>
        <li>Batas Maksimal File adalah 5 MB</li>
        <li><a href="http://www.filehippo.com/download_7zip_32/" target="_blank">Download Aplikasi Compress(zip)</a></li>
        
        </ul>
        </td></tr>
        
        <tr><td>Jenis Formulir</td><td>
        <input type="hidden" value="<?php echo $sid ?>" name="id_user" />
        <select name="jenis_formulir[]" id="jenis_formulir" >
        
        <option value="FR-APL-01">FR-APL-01</option>
        <option value="FR-APL-02">FR-APL-02</option>
        </select><strong style="color: red;"> Boleh lebih dari satu opsi</strong>
        <tr><td>Lampiran File Bukti</td><td><input id="lampiran_manual" type="file"  name="lampiran_manual" />
        <strong style="color: red;">***</strong></td></tr>
        
        <tr><td></td><td><input type="submit" value="Simpan" />
        Klik untuk menyimpan Data</td></tr>
        </table>
        </form>
 
        <p></p>
       
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

        