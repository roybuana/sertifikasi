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
        $('#ia,#ib').keyup(function(e){
            if(e.keyCode == 13){
                doSearch();
            }
        })
function tb_hapus_tak(){
            $.messager.confirm('Konfirmasi','Yakin untuk menghapus?',function(hapusOK){
			if (hapusOK){
			  var ids = [];  
            var rowss = $('#tt').datagrid('getSelections');  
             for(var i=0; i<rowss.length; i++){  
                ids.push(rowss[i].kode);  
            }
                $.ajax({
                  type: 'POST',
                  url: 'process/lsp/del_tak.php',
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
        url: 'data/lsp/tak_data.php',
       	rownumbers: true,
        pagination:true,
        striped:true,
        toolbar:'#toolbar_cari,#toolbar',
        frozenColumns:[[ 
            {field:'ck',checkbox:'true',title:'all',width:75,align:'center'}, 
            {field:'kode',title:'Kode TAK',width:80},  
             {field:'tak',title:'Nama TAK',width:190},
            {field:'rlsp_nama',title:'Nama LSP',width:190},  
            {field:'no_cab',title:'No Cabang',align:'center',width:150},
            
        ]],  
        columns:[[
        
            {field:'kode_prov',title:'Kode Prov',width:175,align:'center'},
            {field:'kode_kota',title:'Kode Kota',width:75,align:'center',hidden:'true'},
            
            {field:'alamat',title:'Alamat',align:'center',width:100},
            
            {field:'kopos',title:'Kode Pos',width:150},
            {field:'telp',title:'Telp',align:'center',width:150},
            {field:'fax',title:'Fax',align:'center',width:100},
            {field:'no_urut',title:'No Urut',align:'center',width:70},
            {field:'tgl_mulai',title:'Tgl Mulai',align:'center',width:100},
            {field:'tgl_akhir',title:'Tgl Akhir',align:'center',width:100},
                        ]]              
    })
    $("#tb-tambah-lsp").live('click',function(){
        $('#dlg-buttons').show();   
    	var f_url = 'lsp';
        buildForm(f_url);
    })
    $('#tb-tambah-tak').linkbutton({  
        iconCls: 'icon-add'  
    });
    $('#tb-edit-tak').linkbutton({  
        iconCls: 'icon-edit'  
    });
    $('#tb-hapus-lsp').linkbutton({  
        iconCls: 'icon-remove'  
    });
    $('#cari_button').linkbutton({
                iconCls:'icon-search',
                plain:true
            })
    $("#tb-tambah-tak").live('click',function(){
        $('#dlg-buttons').show();   
    	var nm_file = 'tak';
        var nm_folder='lsp';        
        C_Form(nm_folder,nm_file);
    })
    $("#tb-edit-tak").live('click',function(){
      $('#dlg-buttons').show();   
    	var row = $('#tt').datagrid('getSelected');
        var nm_folder='lsp';
    	if (row){
        		var f_url = 'tak';
        		$.ajax({
        			url: "template/form/lsp/fa_"+f_url+".php?id="+row.kode,
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
        <span>Nama LSP :</span>
		<input id="ia" style="width:75px;line-height:18px;border:1px solid #ccc">
         <span>Nama TAK :</span>
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
    <a href="#"  plain="true" id="tb-tambah-tak">Baru</a>  
    <a href="#"  plain="true" id="tb-edit-tak">Edit</a>  
    <a href="#"  plain="true" onclick="tb_hapus_tak()" id="tb-hapus-lsp">Hapus</a>  
</div>  