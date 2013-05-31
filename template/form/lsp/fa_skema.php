<?php
	require_once('../../../lib/fn_lib.php');
	session_start();
	isAjax();
	privilegesPage();
	$data = array();
    $data['content']="<script type='text/javascript'>
    
    $('#tanggal_ketetapan,#tanggal_entry').datebox({
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
    
   
           
           
	$data['content'] .= "
        <fieldset><legend>Form Input Skema</legend><table>
<tr>
<td>Nama Skema :</td>
<td><input name='skema' id='skema'><input type='hidden' name='kode' id='kode'></td> 
</tr>
<tr>
<td>Tanggal Ketetapan :</td>
<td><input name='tanggal_ketetapan' id='tanggal_ketetapan'></td> 
</tr>
    
<tr>
<td>Tanggal Entry :</td>
<td><input name='tanggal_entry' id='tanggal_entry'></td> 
</tr>
<tr>
<td>Status Aktif:</td>
<td><select name='status_aktif' id='status_aktif'>
            <option value=''>Pilih</option>
            <option value='Y'>Y</option>
            <option value='N'>N</option>
         </select></td>
</tr>                          
                           
                            </table>
                            </fieldset>
                       ";
                            
	$data['ftitle'] = 'Input Skema';
	$data['dtitle'] = '';
	echo json_encode($data);
?>