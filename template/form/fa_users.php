<?php
	require_once('../../lib/fn_lib.php');
	session_start();
	isAjax();
	privilegesPage();
	$data = array();
    $data['content']="<script type='text/javascript'>
    $('#tgl_aktif').datebox({})
     $('#id_group_users').combogrid({
                
				panelWidth:450,
                width:300,
				url: 'template/json/combogrid/cb_group_users.php',
				idField:'id',
				textField:'group_users',
				mode:'remote',
    
				fitColumns:true,
				columns:[[
                        
					{field:'id',title:'Kode Group ',width:100,align:'center'},
					{field:'group_users',title:'Group Users',align:'left',width:340},
                    	
				]]
    });
     $('#status_aktif').combobox({  
                panelHeight:'auto',
                size:100,
                width:100
                });
    </script>";
	$data['content'] .= "<fieldset><legend>Form Users</legend><table>
    
<tr>
<td>Nama User :</td>
<td><input name='users' id='users_input'><input type='hidden' name='kode' id='kode'></td> 
</tr>
<tr>
<td>Email :</td>
<td><input name='email' id='email'></td> 
</tr>
<tr>
<td>HP:</td>
<td><input name='hp' id='hp'></td> 
</tr>
<tr>
<td>Password :</td>
<td><input name='password' id='password' type='password'></td> 
</tr>
<tr>
<td>Group User  :</td>
<td><input name='id_group_users' id='id_group_users' /></td>
</tr>
<tr>
<td>Tanggal Aktif  :</td>
<td><input name='tgl_aktif' id='tgl_aktif' /></td>
</tr>
<tr>
<td>Status Aktif:</td>
<td><select name='status_aktif' id='status_aktif'>
            <option value=''>Pilih</option>
            <option value='Y'>Y</option>
            <option value='N'>N</option>
         </select></td>
</tr>                          
                           
                            </table></fieldset>
                       ";
                            
	$data['ftitle'] = 'Input Users';
	$data['dtitle'] = '';
	echo json_encode($data);
?>