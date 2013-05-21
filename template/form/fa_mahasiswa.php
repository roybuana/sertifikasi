<?php
	require_once('../../lib/fn_lib.php');
	session_start();
	isAjax();
	privilegesPage();
	$data = array();
    $data['content']="<script type='text/javascript'>
   
     
      $('#nim').validatebox({
            required:true
        })
    </script>";
	$data['content'] .= "<fieldset><legend>Form Mahasiswa</legend><table>
    
<tr>
<td>Nim :</td>
<td><input name='nim' id='nim' ><input type=hidden name='id' id='id'></td> 
</tr>
<tr>
<td>Nama :</td>
<td><input name='nama' id='nama'></td> 
</tr>
<tr>
<td>HP:</td>
<td><input name='hp' id='hp'></td> 
</tr>
<tr>
<td>Alamat :</td>
<td><input name='alamat' id='alamat' ></td> 
</tr>
                   
                           
                            </table></fieldset>
                       ";
                            
	$data['ftitle'] = 'Input Mahasiswa';
	$data['dtitle'] = '';
	echo json_encode($data);
?>