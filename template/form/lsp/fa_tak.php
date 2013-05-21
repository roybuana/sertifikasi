<?php
	require_once('../../../lib/fn_lib.php');
	session_start();
	isAjax();
	privilegesPage();
	$data = array();
    $data['content']="<script type='text/javascript'>
    
    $('#tgl_mulai,#tgl_akhir').datebox({
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
        <fieldset><legend>Form Input TAK</legend><table>

<td>Kode TAK :</td>
<td><input name='id' id='id'><input type='hidden' name='kode' id='kode'></td> 
</tr>
<tr>
<td>Nama TAK :</td>
<td><input name='tak' id='tak'></td> 
</tr>
<tr>
<td>NO Cabang :</td>
<td><input name='no_cab' id='no_cab'></td> 
</tr>
    
<tr>
<td>Kode Provinsi :</td>
<td><input name='kode_prov' id='kode_prov'></td> 
</tr>

<tr>
<td>Kode Kota:</td>
<td><input name='kode_kota' id='kode_kota'></td> 
</tr>
<tr>
<td>Alamat :</td>
<td><textarea name='alamat' id='alamat' rows=2 cols=25></textarea></td> 
</tr>
<tr>
<td>Ko Pos :</td>
<td><input name='kopos' id='kopos'></td> 
</tr>

<tr>
<td>Telp/HP:</td>
<td><input name='telp' id='telp'></td> 
</tr>
<tr>
<td>Fax:</td>
<td><input name='fax' id='fax'></td> 
</tr>
<tr>
<td>No Urut :</td>
<td><input name='prov' id='prov' /></td>
</tr>
<tr>
<tr>
<td>Tanggal  :</td>
<td>Start<input name='tgl_mulai' id='tgl_mulai' > End <input name='tgl_akhir' id='tgl_akhir' ></td>
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
                            
	$data['ftitle'] = 'Input Tempat Asesmen Kompetensi';
	$data['dtitle'] = '';
	echo json_encode($data);
?>