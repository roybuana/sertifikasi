<?php
	require_once('../../lib/fn_lib.php');
	session_start();
	isAjax();
	privilegesPage();
    ?>
<script type='text/javascript'>
    $(function(){
        $('#form_import').form({
            url:'data/bnsp/import_excel_proses.php', 
            onSubmit:function(){
                        
            var result =  $("#form_import").form('validate');            
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
     $('#id_lsp').combogrid({
                
				panelWidth:450,
                width:300,
				url: 'template/json/combogrid/cb_lsp.php',
				idField:'id',
				textField:'rlsp_nama',
				mode:'remote',
    
				fitColumns:true,
				columns:[[
                        
					{field:'id',title:'Kode LSP ',width:100,align:'center'},
					{field:'rlsp_nama',title:'Nama LSP',align:'left',width:340},
                    	
				]]
    });
    $('#status_aktif').combobox({  
                panelHeight:'auto',
                size:100,
                width:100
                });
     $('#id_asesor_type').combobox({ 
    	       url: 'template/json/cb_asesor_type.php',
                panelHeight:'auto',
                valueField:'id',
                textField:'text',
                width:300
                });
    </script>
	<fieldset><legend>Form Asesor</legend>
    <form method="post" id="form_import" enctype="multipart/form-data">
        <table>
            <tr>
            <td>LSP :</td>
            <td><input name='id_lsp' id='id_lsp'></td> 
            </tr>
            <tr>
            <td>File Excel  :</td>
            <td><input name='file_input' id='file_input' type='file'  /></td>
            </tr>
            <tr>
            <td colspan="2"><input type="submit" value="Kirim"</td>
            </tr>
        </table>
    </form>
    </fieldset>
    