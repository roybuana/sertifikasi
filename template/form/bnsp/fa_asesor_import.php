<?php
	require_once('../../../lib/fn_lib.php');
	session_start();
	isAjax();
	privilegesPage();
	$data = array();
    $data['content']="<script type='text/javascript'>
    $('#rasesor_dstart,#rasesor_dend').datebox({
        width:90
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
    </script>";
	$data['content'] .= "<fieldset><legend>Form Asesor</legend><table>


<tr>
<td>LSP :</td>
<td><input name='id_lsp' id='id_lsp'></td> 
</tr>
    

<tr>
<td>File Excel  :</td>
<td><input name='file' id='file' type='file'  /></td>
</tr>
                       
                           
                            </table></fieldset>
                       ";
                            
	$data['ftitle'] = 'Input Asesor';
	$data['dtitle'] = '';
	echo json_encode($data);
?>