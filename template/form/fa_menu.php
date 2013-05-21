<?php
	require_once('../../lib/fn_lib.php');
	session_start();
	isAjax();
	privilegesPage();
	$data = array();
    $data['content']="<script type='text/javascript'>
    $('#id_group_users').combogrid({
                
				panelWidth:270,
                width:300,
				url: 'template/json/combogrid/cb_group_users.php',
				idField:'id',
				textField:'group_users',
				mode:'remote',
    
				fitColumns:true,
				columns:[[
                        
					{field:'group_users',title:'Group Users',align:'left',width:140},
    	            
				]],
                onChange:function(newValue,oldValue){
                    var modul=$('#id_module').combogrid('getValue');
                    $('#id_menu').combogrid({
                
                				panelWidth:370,
                                width:300,
                				url: 'template/json/combogrid/cb_menu.php?level='+newValue+'&modul='+modul,
                				idField:'id',
                				textField:'nm_menu',
                				mode:'remote',
                               	fitColumns:true,
                				columns:[[
                                        
                					{field:'id',title:'Kode',width:50,align:'center'},
                					{field:'nm_menu',title:'Nama Menu',align:'left',width:160},
                                    {field:'no_urut',title:'No Urut',align:'left',width:50},
                                    	
                				]]
                    });
                    }
    });
    $('#id_menu').combogrid({
				panelWidth:270,
                width:300,
    });
    $('#status_aktif').combobox({
       panelHeight:'auto'
        });
      $('#id_module').combogrid({
                
				panelWidth:270,
                width:300,
				url: 'template/json/combogrid/cb_module.php',
				idField:'id',
				textField:'module',
				mode:'remote',
               	fitColumns:true,
				columns:[[
                        
					{field:'id',title:'Kode',width:50,align:'center'},
					{field:'module',title:'Module',align:'left',width:160}
				]]
    });  
    </script>";
	$data['content'] .= "<fieldset><legend>Form Menu</legend><table>
<tr><td>Module :</td><td><input name='id_module' id='id_module'></td></tr>
<tr><td>Group Users  :</td><td><input type='hidden' name='kode' id='kode' /><input name='id_group_users' id='id_group_users'></td></tr>
<tr><td>Ordered   :</td><td><input name='id_menu' id='id_menu'></td></tr>
<tr><td>Nama Menu :</td><td><input name='nm_menu' id='nm_menu'></td></tr>
<tr><td>ID Tag :</td><td><input name='id_tag' id='id_tag'></td></tr>
<tr><td>Class Tag :</td><td><input name='class_tag' id='class_tag'></td></tr>
<tr><td>Icon Tag :</td><td><input name='icon_tag' id='icon_tag'></td></tr>                           
 <tr ><td>Status Aktif :</td><td><select id='status_aktif' name='status_aktif'>
 <option value='Y'>Y</option>
 <option value='N'>N</option>
 </select> </td></tr>
                            
                           
                            </table></fieldset>
                       ";
                            
	$data['ftitle'] = 'Input Menu';
	$data['dtitle'] = '';
	echo json_encode($data);
?>