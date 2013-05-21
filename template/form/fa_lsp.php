<?php
	require_once('../../lib/fn_lib.php');
	session_start();
	isAjax();
	privilegesPage();
	$data = array();
    $data['content']="<script type='text/javascript'>
    var jml = 1;
    $('#tambah').click(function(){
                   	
					var row = jml;			
                    		
					var baris = '<tr><td>Jabatan :<input name=jabatan[]>Nama :<input name=nama_pengurus[]></td></tr>';                    
					$('#upl > tbody:last').append(baris);					
					jml = row + 1;					
				});
    $('#hapus').click(function(){
       
					if(jml > 1){
						$('#upl > tbody:last tr:last').remove();
						jml = jml - 1;
					}					
				});
    $('.add_plus').click(function(e){
            e.preventDefault();
            var input=$('#first_clone');
            var clone=input.clone(true);
            clone.removeAttr('#id');
            clone.val('');
            clone.appendTo('.input_upload');
            })
        
    $('#ttab').tabs({  
        border:false
    });   
    $('#rlsp_doperasi,#rlsp_dberdiri,#rlsp_dlic').datebox({})
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
	$data['content'] .= "
    <div id='ttab'>  
    <div title='Data LSP' style='padding:1px;'> 
    
    <fieldset><legend>Form LSP</legend><table>
    
<tr>
<td width='100'>Kode LSP :</td>
<td><input name='id' id='id'></td> 
</tr>
<tr>
<td>Nama LSP :</td>
<td><input name='rlsp_nama' id='rlsp_nama'><input  name='id_auto' id='id_auto' type='hidden'></td> 
</tr>

<tr>
<td>Alamat :</td>
<td><textarea name='rlsp_alamat' id='rlsp_alamat' cols=30 rows=3></textarea></td> 
</tr>

<tr>
<td>Website :</td>
<td><input name='rlsp_url' id='rlsp_url'></td> 
</tr>

<tr>
<td>Kode Pos  :</td>
<td><input name='rlsp_kodepos' id='rlsp_kodepos' /></td>
</tr>
<tr>
<td>HP / Telp:</td>
<td><input name='rlsp_telp' id='rlsp_telp'></td> 
</tr>
<tr>
<td>FAX:</td>
<td><input name='rlsp_fax' id='rlsp_fax'></td> 
</tr>
<tr>
<td>Email :</td>
<td><input name='rlsp_email' id='rlsp_email' ></td> 
</tr>
<tr></table>
</fieldset>
</div>
<div title='Surat Keputusan LSP' style='padding:1px;'>
<table> 
<td width='170'>No Lisensi :</td>
<td ><input name='rlsp_nolis' id='rlsp_nolis'></td> 
</tr>
<tr>
<td>No Surat Keputusan Lisensi :</td>
<td><input name='surat_kep_lisiensi' id='surat_kep_lisiensi'></td> 
</tr>
<tr>
<td>Tgl Berdiri :</td>
<td><input name='rlsp_dberdiri' id='rlsp_dberdiri'></td> 
</tr>
<tr>
<td>Tgl Operasi :</td>
<td><input name='rlsp_doperasi' id='rlsp_doperasi'></td> 
</tr>
<tr>
<td>Tgl Kep Lisensi :</td>
<td><input name='rlsp_dlic' id='rlsp_dlic'></td> 
</tr>
<tr>
<td>No Surat keputusan penambahan ruang lingkup :</td>
<td><input name='penambahan_rl' id='penambahan_rl'></td> 
</tr>
<tr>
<td>Asosiasi Pendukung :</td>
<td><input name='asosiasi_pendukung' id='asosiasi_pendukung'></td> 
</tr>
<tr>
<td>Kementrian/Instansi Pendukung:</td>
<td><input name='Instansi_pendukung' id='Instansi_pendukung'></td> 
</tr>


<tr>
<td>Status Aktif:</td>
<td><select name='status_aktif' id='status_aktif'>
            <option value=''>Pilih</option>
            <option value='Y'>Y</option>
            <option value='N'>N</option>
         </select></td>
</tr>                          
                           
                            </table></div>
                             <div title='Pengurus'>
                             <div>
            <input type='button' value='Tambah' id='tambah'>	
            <input type='button' value='Hapus' id='hapus'>	
        </div>
        
         <table id='upl' >
		  
                <tbody>   		   
				   <tr>
					   <td>Jabatan :<input name=jabatan[]>Nama :<input name=nama_pengurus[]></td>
				   </tr>
		   		</tbody>
                </table>
                    	   
                             
                             </div></div>
                       ";
                            
	$data['ftitle'] = 'Input Data LSP';
	$data['dtitle'] = '';
	echo json_encode($data);
?>