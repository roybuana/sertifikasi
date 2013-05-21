<?php
	require_once('../../lib/fn_lib.php');
	session_start();
	isAjax();
	privilegesPage();
	$data = array();
    $data['content']="<script type='text/javascript'>
   
   $('#status_aktif').combobox({  
    
                panelHeight:'auto',
                size:100,
                width:100
                });
                
				     $('#id_jabatan').combogrid({
                
				panelWidth:370,
                width:300,
				url: 'template/json/combogrid/cb_jabatan.php',
				idField:'id_jabatan',
				textField:'jabatan',
				mode:'remote',
               	fitColumns:true,
				columns:[[
                        
					{field:'jabatan',title:'Nama Jabatan',align:'left',width:360},
                    
				]]
                    
    });
                   
                
    </script>";
	$data['content'] .= "<fieldset><legend>Form Job Desk</legend><table>
    
    <tr>
<td>Jabatan  :</td>
<td><input name='id_jabatan' id='id_jabatan' /></td>
</tr> 
                            <tr><td>Detail Job Desk :</td><td><textarea name=detail id=detail rows=4 cols=30></textarea></td></tr>
                            <input type='hidden' name='kode' id='kode' />
                   
 <tr ><td>Status Aktif :</td><td><select name='status_aktif' id='status_aktif'>
            <option value=''>Pilih</option>
            <option value='Y'>Y</option>
            <option value='N'>N</option>
         </select></td></tr>
                            
                           
                            </table></fieldset>
                       ";
                            
	$data['ftitle'] = 'Input Job Desk';
	$data['dtitle'] = '';
	echo json_encode($data);
?>