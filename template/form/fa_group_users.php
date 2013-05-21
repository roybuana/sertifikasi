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
    </script>";
	$data['content'] .= "<fieldset><legend>Form Group User</legend><table>
                            <tr><td>Group Users :</td><td><input name='group_users' id='group_users'></td></tr>
                                    <tr>
<td>Parent  :</td>
<td><input name='parent' id='parent' /><input type='hidden' name='kode' id='kode' /></td>
</tr> 
                                           
 <tr ><td>Status Aktif :</td><td><select name='status_aktif' id='status_aktif'>
            <option value=''>Pilih</option>
            <option value='Y'>Y</option>
            <option value='N'>N</option>
         </select></td></tr>
                            
                           
                            </table></fieldset>
                       ";
                            
	$data['ftitle'] = 'Input Group User';
	$data['dtitle'] = '';
	echo json_encode($data);
?>