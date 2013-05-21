<?php
	require_once('../../lib/fn_lib.php');
	session_start();
	isAjax();
	privilegesPage();
	$data = array();
    $data['content']="<script type='text/javascript'>
     $('#id_kategori_berita').combogrid({
                
				panelWidth:270,
                width:300,
				url: 'template/json/combogrid/cb_kategori_berita.php',
				idField:'id_kategori_berita',
				textField:'kategori_berita',
				mode:'remote',
    
				fitColumns:true,
				columns:[[
                        
					{field:'id_kategori_berita',title:'Kode  ',width:120,align:'center'},
					{field:'kategori_berita',title:'Kategori',align:'left',width:140},
                    	
				]]
    });
     $('#status_aktif').combobox({  
                panelHeight:'auto',
                size:100,
                width:100
                });
    </script>";
	$data['content'] .= "<fieldset><legend>Form Berita</legend><table>
<tr>
<td>Kategori :</td>
<td><input name='id_kategori_berita' id='id_kategori_berita'><input type='hidden' name='kode' id='kode'></td> 
</tr>
<tr>
<td>Judul :</td>
<td><input name='judul_berita' id='judul_berita'></td> 
</tr>
<tr>
<td>Berita :</td>
<td><textarea rows=4 cols=30 name='berita' id='berita'></textarea> 
</tr>
<td>Beranda:</td>
<td><select name='front' id='front'>
            <option value=''>Pilih</option>
            <option value='Y'>Y</option>
            <option value='N'>N</option>
         </select></td>
</tr>     
<tr>
<td>status aktif:</td>
<td><select name='status_aktif' id='status_aktif'>
            <option value=''>Pilih</option>
            <option value='Y'>Y</option>
            <option value='N'>N</option>
         </select></td>
</tr>                          
                           
                            </table></fieldset>
                       ";
                            
	$data['ftitle'] = 'Input Berita';
	$data['dtitle'] = '';
	echo json_encode($data);
?>