<?php require_once("../lib/fn_lib.php");
	session_start();
	isAjax();
	privilegesPage();
 ?>
  <script>
function tb_hapus_users(){
            $.messager.confirm('Konfirmasi','Yakin untuk menghapus?',function(hapusOK){
			if (hapusOK){
			  var ids = [];  
            var rowss = $('#tt').datagrid('getSelections');  
             for(var i=0; i<rowss.length; i++){  
                ids.push(rowss[i].kode);  
            }
                $.ajax({
                  type: 'POST',
                  url: 'process/del_users.php',
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
        url: 'data/data_users.php',
       	rownumbers: true,
        pagination:true,
        striped:true,
        toolbar:'#toolbar',
        frozenColumns:[[ 
            {field:'ck',checkbox:'true',title:'all',width:75,align:'center'}, 
            {field:'kode',title:'Kode Users',width:80},  
            {field:'users',title:'Users',width:210},  
        ]],  
        columns:[[
        
            {field:'kode_user',title:'Kode',width:75,align:'center',hidden:'true'},
            {field:'group_users',title:'Group Users',align:'center',width:100},
            
            {field:'email',title:'Email',width:150},
            {field:'tgl_aktif',title:'Tanggal Aktif',align:'center',width:150},
            {field:'aktivasi',title:'Aktivasi',align:'center',width:100},
            {field:'status_aktif',title:'Status Aktif',align:'center',width:70}
                        ]]              
    })
    $('#tb-tambah-users').linkbutton({  
        iconCls: 'icon-add'  
    });
    $('#tb-edit-users').linkbutton({  
        iconCls: 'icon-edit'  
    });
    $('#tb-hapus-users').linkbutton({  
        iconCls: 'icon-remove'  
    });
    $("#tb-tambah-users").live('click',function(){
        $('#dlg-buttons').show();   
    	var f_url = 'users';
        buildForm(f_url);
    })
    $("#tb-edit-users").live('click',function(){
      $('#dlg-buttons').show();   
    	var row = $('#tt').datagrid('getSelected');
    	if (row){
        		var f_url = 'users';
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
    <a href="#"  plain="true" id="tb-tambah-users">Baru</a>  
    <a href="#"  plain="true" id="tb-edit-users">Edit</a>  
    <a href="#"  plain="true" onclick="tb_hapus_users()" id="tb-hapus-users">Hapus</a>  
</div>  
    