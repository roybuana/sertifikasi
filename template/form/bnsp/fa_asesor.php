<?php
	require_once('../../../lib/fn_lib.php');
	session_start();
	isAjax();
	privilegesPage();
    if(cek_group()==15){
        $id_lsp_txt="<input name='id_lsp' id='id_lsp'>";
    }else{
        $kode_lsp=cek_id_lsp();
        $id_lsp_txt="$kode_lsp <input type='hidden' name='id_lsp' value='$kode_lsp'>";
    }
	$data = array();
    $data['content']="<script type='text/javascript'>
    
    $('#rasesor_dstart,#rasesor_dend').datebox({
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
    <fieldset><legend>Form Asesor</legend><table>

<td>Kode Asesor :</td>
<td><input name='id' id='id'><input type='hidden' name='kode' id='kode'></td> 
</tr>
<tr>
<td>Type Asesor :</td>
<td><input name='id_asesor_type' id='id_asesor_type'></td> 
</tr>
<tr>
<td>LSP :</td>
<td>$id_lsp_txt</td> 
</tr>
    
<tr>
<td>Nama Asesor :</td>
<td><input name='rasesor_nama' id='rasesor_nama'></td> 
</tr>

<tr>
<td>SEX:</td>
<td><div>P<input type='radio' name='rgender_kode' id='rgender_kode' value='P'>W<input value='W' type='radio' name='rgender_kode' id='rgender_kode'></div></td> 
</tr>
<tr>
<td>Alamat :</td>
<td><input name='rasesor_alamat' id='rasesor_alamat'></td> 
</tr>
<tr>
<td>Email :</td>
<td><input name='rasesor_email' id='rasesor_email'></td> 
</tr>

<tr>
<td>HP:</td>
<td><input name='rasesor_telp' id='rasesor_telp'></td> 
</tr>
<tr>
<td>Masa Berlaku:</td>
<td>Start<input name='rasesor_dstart' id='rasesor_dstart' > End <input name='rasesor_dend' id='rasesor_dend' ></td> 
</tr>
<tr>
<td>Profinsi  :</td>
<td><input name='rprop_kode' id='rprop_kode' /></td>
</tr>
<tr>
<tr>
<td>Kota  :</td>
<td><input name='rkota_kode' id='rkota_kode'  /></td>
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
                            
	$data['ftitle'] = 'Input Asesor';
	$data['dtitle'] = '';
	echo json_encode($data);
?>