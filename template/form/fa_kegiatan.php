<?php
	require_once('../../lib/fn_lib.php');
	session_start();
	isAjax();
	privilegesPage();
	$data = array();
    $data['content']="<script type='text/javascript'>
    $('#tr_notulen').hide();
     tanggalJS();
    $('#tgl_akhir,#tgl_mulai').datebox({
        width:100
        })
    $('#id_category_kegiatan').combogrid({
                
				panelWidth:220,
                width:300,
				url: 'template/json/combogrid/cb_kegiatan.php',
				idField:'id_category_kegiatan',
				textField:'category_kegiatan',
				mode:'remote',
    
				fitColumns:true,
				columns:[[
                        
					{field:'id_category_kegiatan',title:'Kode Kegiatan ',width:120,align:'center'},
					{field:'category_kegiatan',title:'Nama Kegiatan',align:'left',width:140},
                    	
				]],onChange:function(newValue,oldValue){
				    if(newValue==5){
				     $('#tr_notulen').show();   
                     $('#id_notulen').combogrid({
                				panelWidth:220,
                                width:300,
                				url: 'template/json/combogrid/cb_users.php',
                				idField:'id_user',
                				textField:'nm_user',
                				mode:'remote',
                    
                				fitColumns:true,
                				columns:[[
                                        
                					{field:'id_user',title:'Kode User ',width:120,align:'center'},
                					{field:'nm_user',title:'Nama User',align:'left',width:140},
                                    	
                				]]
                    }); 
                        }else{
                            $('#tr_notulen').hide();
                            }
				     
                    }
    });
    $('#id_sop').combogrid({
                
				panelWidth:220,
                width:300,
				url: 'template/json/combogrid/cb_sop.php',
				idField:'id_sop',
				textField:'detail',
				mode:'remote',
    
				fitColumns:true,
				columns:[[
                        
				
					{field:'detail',title:'Job Desk',align:'left',width:190},
                    	
				]]
    });
    $('#pic_bnsp').combogrid({
                
				panelWidth:220,
                width:300,
				url: 'template/json/combogrid/cb_users.php',
				idField:'id_user',
				textField:'nm_user',
				mode:'remote',
    
				fitColumns:true,
				columns:[[
                        
					{field:'id_user',title:'Kode User ',width:120,align:'center'},
					{field:'nm_user',title:'Nama User',align:'left',width:140},
                    	
				]]
    }); 
    $('#pic_sekretariat').combogrid({
                
				panelWidth:220,
                width:300,
				url: 'template/json/combogrid/cb_users.php',
				idField:'id_user',
				textField:'nm_user',
				mode:'remote',
    
				fitColumns:true,
				columns:[[
                        
					{field:'id_user',title:'Kode User ',width:120,align:'center'},
					{field:'nm_user',title:'Nama User',align:'left',width:140},
                    	
				]]
    }); 
     $('#status_aktif').combobox({  
                panelHeight:'auto',
               
                width:100
                });
    </script>";
     $p=mysql_fetch_array(mysql_query("select * from user where id_user='$_SESSION[id]'"));
     if($p['id_level']==1){
        $data['content'] .= "<fieldset><legend>Form Kegiatan</legend><table>
<tr>
<td>Kategori  :</td>
<td><input name='id_category_kegiatan' id='id_category_kegiatan'><input type='hidden' name='kode' id='kode'></td> 
</tr>
<tr id='tr_notulen'>
<td>Notulen  :</td>
<td><input name='id_notulen' id='id_notulen'></td> 
</tr>
<tr>
<td>Judul  :</td>
<td><input name='nm_kegiatan' id='nm_kegiatan' size=46></td> 
</tr>
<tr>
<td>Tanggal :</td>
<td>Dari : <input name='tgl_mulai' id='tgl_mulai' /> Sampai : <input name='tgl_akhir' id='tgl_akhir' /></td> 
</tr>
<tr>
<td>PIC BNSP  :</td>
<td><input name='pic_bnsp' id='pic_bnsp'></td> 
</tr>
<tr>
<td>PIC Sek  :</td>
<td><input name='pic_sekretariat' id='pic_sekretariat'></td> 
</tr>
<tr>
<td>Tempat  :</td>
<td><input name='tempat' id='tempat' size=46></td> 
</tr>
<tr>
<td>Detail :</td>
<td><textarea rows='7' cols='34' id='detail' name='detail'></textarea></td> 
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
   }else{
    $data['content'] .= "<fieldset><legend>Form Kegiatan</legend><table>
<tr>
<td>Job Desk :</td>
<td><input name='id_sop' id='id_sop'></td> 
</tr>


<tr>
<td>Judul  :</td>
<td><input name='nm_kegiatan' id='nm_kegiatan' size=46></td> 
</tr>
<tr>
<td>Tanggal :</td>
<td>Dari : <input name='tgl_mulai' id='tgl_mulai' /> Sampai : <input name='tgl_akhir' id='tgl_akhir' /></td> 
</tr>

<tr>
<td>Tempat  :</td>
<td><input name='tempat' id='tempat' size=46></td> 
</tr>
<tr>
<td>Detail :</td>
<td><textarea rows='7' cols='34' id='detail' name='detail'></textarea></td> 
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
   }
	
                            
	$data['ftitle'] = 'Input Kegiatan';
	$data['dtitle'] = '';
	echo json_encode($data);
?>