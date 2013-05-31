<?php require_once("../../lib/fn_lib.php");
	session_start();
	isAjax();
	privilegesPage();
 ?>
  <script>
function tb_hapus_asesor(){
            $.messager.confirm('Konfirmasi','Yakin untuk menghapus?',function(hapusOK){
			if (hapusOK){
			  var ids = [];  
            var rowss = $('#tt').datagrid('getSelections');  
             for(var i=0; i<rowss.length; i++){  
                ids.push(rowss[i].id_users);  
            }
                $.ajax({
                  type: 'POST',
                  url: 'process/bnsp/del_asesor.php',
                  data:{ var_array:ids },
                 
                  success: function(result){
                			var result = eval('('+result+')');
                			if (result.success){
                				$.messager.show({
                					title: 'Success',
                					msg: result.msg
                				});
                				$('#tt').datagrid('reload');
                			} else {
                				$.messager.show({
                					title: 'Error',
                					msg: result.msg
                				});
                			}
                		}
                });
                }
                })
    } 
   
$(function(){
    $('#tt').datagrid({
        url: 'data/bnsp/asesor_data.php',
       	rownumbers: true,
        pagination:true,
        striped:true,
        toolbar:'#toolbar_cari,#toolbar',
        frozenColumns:[[ 
            {field:'ck',checkbox:'true',title:'all',width:75,align:'center'}, 
            {field:'kode',title:'Kode',width:80},  
            {field:'rasesor_nama',title:'Nama',width:160},
            {field:'rlsp_nama',title:'LSP',width:290},
            {field:'asesor_type',title:'Type Asesor',width:110},    
        ]],  
        columns:[[
        
            {field:'id_users',title:'Kode Propinsi',width:75,align:'center',hidden:'true'},
            
            {field:'rprop_kode',title:'Kode Propinsi',width:75,align:'center'},
            {field:'rkota_kode',title:'Kode Kota',align:'center',width:100},
            
            {field:'rgender_kode',title:'Sex',width:50},
            {field:'rasesor_alamat',title:'Alamat',align:'left',width:150},
            {field:'rasesor_kdpos',title:'Ko Pos',align:'center',width:100},
            {field:'rasesor_telp',title:'Telp',align:'center',width:70},
            {field:'rasesor_email',title:'Email',align:'center',width:70},
            {field:'rasesor_dstart',title:'Tanggal Start',align:'center',width:70},
            {field:'rasesor_dend',title:'Tanggal End',align:'center',width:70},
            {field:'status_aktif',title:'Status Aktif',align:'center',width:70}
                        ]]              
    })

    $('#tb-tambah-asesor').linkbutton({  
        iconCls: 'icon-add'  
    });
    $('#tb-edit-asesor').linkbutton({  
        iconCls: 'icon-edit'  
    });
    $('#tb-hapus-asesor').linkbutton({  
        iconCls: 'icon-remove'  
    });
    
    $('#cari_button').linkbutton({
                iconCls:'icon-search',
                plain:true
            })
    $("#tb-tambah-asesor").live('click',function(){
        $('#dlg-buttons').show();   
    	var nm_file = 'asesor';
        var nm_folder='bnsp';        
        C_Form(nm_folder,nm_file);
    })
    $("#import_excel").live('click',function(){
  
        $('#tabhome').tabs('select', 'Konten');
        $('#konten_menu').html('<div  align="center"></div><img  src="images/loader.gif" /></div>').fadeIn();
        $('#konten_menu').load('data/bnsp/import_excel.php');
    })

     $("#tb-edit-asesor").live('click',function(){
      $('#dlg-buttons').show();   
    	var row = $('#tt').datagrid('getSelected');
        var nm_folder='bnsp';
    	if (row){
        		var f_url = 'asesor';
        		$.ajax({
        			url: "template/form/"+nm_folder+"/fa_"+f_url+".php?id="+row.kode,
        			dataType: 'json',
        			timeout: 2000,
        			error: function() {
        						
        			},
        			success: function(xr){
        				var ctn = xr.content;
        				editUser2(nm_folder,xr.ftitle,f_url+".php?id="+row.kode,ctn.replace(/\\/,""),xr.dtitle);
        			}	
        		})
        	}
        	
        })
})
</script>
<table id='tt'>
</table>
<div id="toolbar_cari" style="padding:3px">
        <span>Nama Asesor :</span>
		<input id="ia" style="width:75px;line-height:18px;border:1px solid #ccc">
         <span>Nama LSP :</span>
		<input id="ib" style="width:75px;line-height:18px;border:1px solid #ccc">
        <span>Type Asesor:</span>
		<select id='ic'>
            <option value=''>Pilih</option>
            <option value='AK'>Asesor Kompetensi</option>
            <option value='AL'>Asesor Lisensi</option>
            <option value='MA'>Master Asesor</option>
            <option value='VA'>Verifikator</option>
         </select>
		<span>Status Aktif :</span>
		<select id='ic'>
            <option value=''>Pilih</option>
            <option value='Y'>Y</option>
            <option value='N'>N</option>
         </select>
       
        	<a href="#" id="cari_button" onclick="doSearch()">Search</a>
	</div>
<div id="toolbar">  
    <a href="#"  plain="true" id="tb-tambah-asesor">Baru</a>  
    <a href="#"  plain="true" id="tb-edit-asesor">Edit</a>  
    <a href="#"  plain="true" onclick="tb_hapus_asesor()" id="tb-hapus-asesor">Hapus</a>  
    <a href="#"  plain="true" id="import_excel" >Import Excel</a>  
</div>  
    