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
function tb_hapus_skema(){
            $.messager.confirm('Konfirmasi','Yakin untuk menghapus?',function(hapusOK){
			if (hapusOK){
			  var ids = [];  
            var rowss = $('#tt').datagrid('getSelections');  
             for(var i=0; i<rowss.length; i++){  
                ids.push(rowss[i].kode);  
            }
                $.ajax({
                  type: 'POST',
                  url: 'process/lsp/del_skema.php',
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
        url: 'data/lsp/skema_lsp_data.php',
       	rownumbers: true,
        pagination:true,
        striped:true,
        toolbar:'#toolbar_cari,#toolbar',
        frozenColumns:[[ 
            {field:'ck',checkbox:'true',title:'all',width:75,align:'center'}, 
            {field:'kode',title:'Kode Skema',width:80},  
             {field:'skema',title:'Nama Skema',width:190},
            {field:'rlsp_nama',title:'Nama LSP',width:190},   
           
        ]],  
        columns:[[
        
            {field:'tanggal_ketetapan',title:'Tanggal Ketetapan',width:75,align:'center'},
            {field:'tanggal_entry',title:'Tanggal Entry',width:75,align:'center'},
             {field:'status_aktif',title:'Status Aktif',width:90,align:'center'},
            ]]              
    })
    $('#tb-tambah-skema,#tb-tambah-skema-detail').linkbutton({  
        iconCls: 'icon-add'  
    });
    $('#tb-edit-skema').linkbutton({  
        iconCls: 'icon-edit'  
    });
    $('#tb-hapus-skema').linkbutton({  
        iconCls: 'icon-remove'  
    });
    $('#cari_button').linkbutton({
                iconCls:'icon-search',
                plain:true
            })
    $("#tb-tambah-skema").live('click',function(){
        $('#dlg-buttons').show();   
    	var nm_file = 'skema';
        var nm_folder='lsp';    
        lebar_form='400px';
        lebar_dlg=420;    
        C_Form(nm_folder,nm_file,lebar_form,lebar_dlg);
    })
    $("#tb-tambah-skema-detail").live('click',function(){
        $('#dlg-buttons').show();   
    	var nm_file = 'skema_detail';
        var nm_folder='lsp';
        var datagrid_seleted=$('#tt').datagrid('getSelected');
        var var1=datagrid_seleted.kode; 
       // var var2=true;   
        lebar_form='800px';
        lebar_dlg=820;    
        C_Form(nm_folder,nm_file,lebar_form,lebar_dlg,var1);
    })
    
    $("#tb-edit-skema").live('click',function(){
      $('#dlg-buttons').show();   
    	var row = $('#tt').datagrid('getSelected');
        var nm_folder='lsp';
    	if (row){
        		var f_url = 'skema';
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
        <span>Nama skema :</span>
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
    <a href="#"  plain="true" id="tb-tambah-skema">Baru</a>  
    <a href="#"  plain="true" id="tb-edit-skema">Edit</a>  
    <a href="#"  plain="true" onclick="tb_hapus_skema()" id="tb-hapus-skema">Hapus</a>
    <a href="#"  plain="true" id="tb-tambah-skema-detail">Tambah Detail Skema</a>  
</div>  
