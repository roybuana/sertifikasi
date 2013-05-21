<?php require_once("../../lib/fn_lib.php");
	session_start();
	isAjax();
	privilegesPage();
 ?>
  <script>
  function doSearch(){
			$('#tt').datagrid('load',{
			    ia: $('#ia').val(),
                ib: $('#ib').val(),
                ic: $('#ic').val(),
              
			});
		}
function tb_hapus_lsp(){
            $.messager.confirm('Konfirmasi','Yakin untuk menghapus?',function(hapusOK){
			if (hapusOK){
			  var ids = [];  
            var rowss = $('#tt').datagrid('getSelections');  
             for(var i=0; i<rowss.length; i++){  
                ids.push(rowss[i].id_users);  
            }
                $.ajax({
                  type: 'POST',
                  url: 'process/del_lsp.php',
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
        url: 'data/bnsp/lsp_data.php',
       	rownumbers: true,
        pagination:true,
        striped:true,
        toolbar:'#toolbar_cari,#toolbar',
        frozenColumns:[[ 
            {field:'ck',checkbox:'true',title:'all',width:75,align:'center'}, 
            {field:'kode',title:'Kode lsp',width:80},  
            {field:'rlsp_nama',title:'Nama LSP',width:290},  
            {field:'rlsp_nolis',title:'No Lisensi',align:'center',width:150},
            
        ]],  
        columns:[[
        
            {field:'rlsp_alamat',title:'Alamat',width:175,align:'center'},
            {field:'id_users',title:'Alamat',width:75,align:'center',hidden:'true'},
            
            {field:'rlsp_kodepos',title:'Ko Pos',align:'center',width:100},
            
            {field:'rlsp_telp',title:'Telp',width:150},
            {field:'rlsp_fax',title:'FAX',align:'center',width:150},
            {field:'rlsp_email',title:'Email',align:'center',width:100},
            {field:'rlsp_url',title:'Website',align:'center',width:70},
            {field:'rlsp_dberdiri',title:'Berdiri',align:'center',width:100},
            {field:'rlsp_doperasi',title:'Tanggal Operasi',align:'center',width:100},
            {field:'rlsp_dlic',title:'Tgl Lisensi',align:'center',width:100},
            {field:'status_aktif',title:'Status Aktif',align:'center',width:100},
                        ]]              
    })
    $("#tb-tambah-lsp").live('click',function(){
        $('#dlg-buttons').show();   
    	var f_url = 'lsp';
        buildForm(f_url);
    })
    $('#tb-tambah-lsp').linkbutton({  
        iconCls: 'icon-add'  
    });
    $('#tb-edit-lsp').linkbutton({  
        iconCls: 'icon-edit'  
    });
    $('#tb-hapus-lsp').linkbutton({  
        iconCls: 'icon-remove'  
    });
    $('#cari_button').linkbutton({
                iconCls:'icon-search',
                plain:true
            })
    $("#tb-tambah-lsp").live('click',function(){
        $('#dlg-buttons').show();   
    	var f_url = 'lsp';
        buildForm(f_url);
    })
    $("#tb-edit-lsp").live('click',function(){
      $('#dlg-buttons').show();   
    	var row = $('#tt').datagrid('getSelected');
    	if (row){
        		var f_url = 'lsp';
        		$.ajax({
        			url: "template/form/fa_"+f_url+".php?id="+row.kode,
        			dataType: 'json',
        			timeout: 2000,
        			error: function() {
        						
        			},
        			success: function(xr){
        				var ctn = xr.content;
        				editUser(xr.ftitle,f_url+".php?id="+row.kode,ctn.replace(/\\/,""),xr.dtitle);
        			}	
        		})
        	}
        	
        })
})
</script>
<table id='tt'>
</table>

	<div id="toolbar_cari" style="padding:3px">
        <span>Kode LSP :</span>
		<input id="ia" style="width:75px;line-height:18px;border:1px solid #ccc">
         <span>Nama LSP :</span>
		<input id="ib" style="width:75px;line-height:18px;border:1px solid #ccc">
		<span>Status Aktif :</span>
		<select id='ic'>
            <option value=''>Pilih</option>
            <option value='Y'>Y</option>
            <option value='N'>N</option>
         </select>
       
        	<a href="#" id="cari_button" onclick="doSearch()">Search</a>
	</div>
    <div id="toolbar">  
    <a href="#"  plain="true" id="tb-tambah-lsp">Baru</a>  
    <a href="#"  plain="true" id="tb-edit-lsp">Edit</a>  
    <a href="#"  plain="true" onclick="tb_hapus_lsp()" id="tb-hapus-lsp">Hapus</a>  
</div>  