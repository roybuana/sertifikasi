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
                 $('#id_golongan').combogrid({
                
				panelWidth:500,
                width:300,
				url: 'template/json/combogrid/cb_golongan.php',
				idField:'id_golongan',
				textField:'nm_golongan',
				mode:'remote',
    
				fitColumns:true,
				columns:[[
                        
					{field:'nm_golongan',title:'Divisi',align:'left',width:300},
    	            {field:'gol',title:'Parent',align:'left',width:200},
				]],onChange:function(newValue,oldValue){
				     $('#id_parent').combogrid({
                
				panelWidth:570,
                width:300,
				url: 'template/json/combogrid/cb_jabatan.php',
				idField:'id_jabatan',
				textField:'jabatan',
				mode:'remote',
               	fitColumns:true,
				columns:[[
                        
					{field:'jabatan',title:'Nama Jabatan',align:'left',width:260},
                    {field:'parent',title:'Parent',align:'left',width:260},
                       	
				]]
                    
    });
                    }
                })
                
    </script>";
	$data['content'] .= "<fieldset><legend>Form Jabatan</legend><table>
    <tr><td>Divisi :</td><td><input name='id_golongan' id='id_golongan'></td></tr>
    <tr>
<td>Parent  :</td>
<td><input name='id_parent' id='id_parent' /></td>
</tr> 
                            <tr><td>Jabatan :</td><td><input name='jabatan' id='jabatan'></td></tr>
                            <input type='hidden' name='kode' id='kode' />
                   
 <tr ><td>Status Aktif :</td><td><select name='status_aktif' id='status_aktif'>
            <option value=''>Pilih</option>
            <option value='Y'>Y</option>
            <option value='N'>N</option>
         </select></td></tr>
                            
                           
                            </table></fieldset>
                       ";
                            
	$data['ftitle'] = 'Input Jabatan';
	$data['dtitle'] = '';
	echo json_encode($data);
?>