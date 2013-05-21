<?php
	require_once('../../lib/fn_lib.php');
	session_start();
	isAjax();
	privilegesPage();
	$data = array();
    $data['content']="<script type='text/javascript'>
    $('#tgl_asesmen').datebox({})
     $('#id_asesor').combogrid({
                
				panelWidth:450,
                width:300,
				url: 'template/json/combogrid/cb_asesor.php',
				idField:'id',
				textField:'users',
				mode:'remote',
                multiple:true,
				fitColumns:true,
				columns:[[
                        
					{field:'id',title:'Kode Asesor ',width:100,align:'center'},
					{field:'users',title:'Nama Asesor',align:'left',width:340},
                    	
				]]
    });
     $('#status_aktif').combobox({  
                panelHeight:'auto',
                size:100,
                width:100
                });
    </script>";
	$data['content'] .= "<fieldset><legend>Form Asesi</legend><table>
    
<tr>
<td>Nama User :</td>
<td><input name='users' id='users_input'><input type='hidden' name='kode' id='kode'></td> 
</tr>
<tr>
<td>Status Form :</td>
<td>
<select name='status_form' id='status_form'>
<option value='Pending'>Pending</option>
<option value='Proses'>Proses</option>
<option value='Finish'>Finish</option>
</select>
</td>
</tr>
<tr>
<td>Status Aktif:</td>
<td><select name='status_aktif' id='status_aktif'>
            <option value=''>Pilih</option>
            <option value='Y'>Y</option>
            <option value='N'>N</option>
         </select></td>
</tr>
<tr>
<td>Nama Asesor:</td>
<td><input id='id_asesor' name='id_asesor[]'</td>
</tr>                          
     <tr>
<td>Tanggal Asesmen:</td>
<td><input id='tgl_asesmen' name='tgl_asesmen'</td>
</tr>                      
                            </table></fieldset>
                       ";
                            
	$data['ftitle'] = 'Edit Asesmen';
	$data['dtitle'] = '';
	echo json_encode($data);
?>