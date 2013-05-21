<?php require_once("../lib/fn_lib.php");
	session_start();
	isAjax();
	privilegesPage();
 ?>
  <script>
function tb_hapus_menu(){
            $.messager.confirm('Konfirmasi','Yakin untuk menghapus?',function(hapusOK){
			if (hapusOK){
			  var ids = [];  
            var rowss = $('#tt').datagrid('getSelections');  
             for(var i=0; i<rowss.length; i++){  
                ids.push(rowss[i].kode);  
            }
                $.ajax({
                  type: 'POST',
                  url: 'process/del_menu.php',
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
        url: 'data/menu_data.php',
       	rownumbers: true,
        pagination:true,
        striped:true,
        toolbar:'#toolbar',
        frozenColumns:[[ 
            {field:'ck',checkbox:'true',title:'all',width:75,align:'center'}, 
            {field:'nm_menu',title:'Nama Menu',width:180},  
            {field:'group_users',title:' Group menu',width:80},  
        ]],  
        columns:[[
        
            {field:'kode',title:'Kode',width:75,align:'center',hidden:'true'},
            {field:'module',title:'Menu Header',align:'center',width:100},
            {field:'no_urut',title:'No Urut',align:'center',width:100},
            {field:'id_tag',title:'ID Tag',align:'center',width:100},
            {field:'class_tag',title:'Class Tag',align:'center',width:100},
            {field:'icon_tag',title:'Icon Tag',align:'center',width:100},
            {field:'status_aktif',title:'Status Aktif',align:'center',width:100}
                        ]]              
    })
    $('#tb-tambah-menu').linkbutton({  
        iconCls: 'icon-add'  
    });
    $('#tb-edit-menu').linkbutton({  
        iconCls: 'icon-edit'  
    });
    $('#tb-hapus-menu').linkbutton({  
        iconCls: 'icon-remove'  
    });
    $("#tb-tambah-menu").live('click',function(){
        $('#dlg-buttons').show();   
    	var f_url = 'menu';
        buildForm(f_url);
    })
    $("#tb-edit-menu").live('click',function(){
      $('#dlg-buttons').show();   
    	var row = $('#tt').datagrid('getSelected');
    	if (row){
        		var f_url = 'menu';
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
<div id="toolbar">  
    <a href="#"  plain="true" id="tb-tambah-menu">Baru</a>  
    <a href="#"  plain="true" id="tb-edit-menu">Edit</a>  
    <a href="#"  plain="true" onclick="tb_hapus_menu()" id="tb-hapus-menu">Hapus</a>  
</div>  
    