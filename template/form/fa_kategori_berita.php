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
	$data['content'] .= "<fieldset><legend>Form Kategori Berita</legend><table>
                            <tr><td>Kategori :</td><td><input name='kategori_berita' id='kategori_berita'></td></tr>
                            
                            
 <tr ><td>Status Aktif :</td><td><select name='status_aktif' id='status_aktif'>
            <option value=''>Pilih</option>
            <option value='Y'>Y</option>
            <option value='N'>N</option>
         </select></td></tr>
                            
                           
                            </table></fieldset>
                       ";
                            
	$data['ftitle'] = 'Input Kategori Berita';
	$data['dtitle'] = '';
	echo json_encode($data);
?>