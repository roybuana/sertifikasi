<?php require_once("../lib/fn_lib.php");
	session_start();
	isAjax();
	privilegesPage();
 ?>
  <script>
function tb_hapus_gu(){
            $.messager.confirm('Konfirmasi','Yakin untuk menghapus?',function(hapusOK){
			if (hapusOK){
			  var ids = [];  
            var rowss = $('#tt').datagrid('getSelections');  
             for(var i=0; i<rowss.length; i++){  
                ids.push(rowss[i].kode);  
            }
                $.ajax({
                  type: 'POST',
                  url: 'process/del_group_users.php',
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
        url: 'data/data_group_user.php',
       	rownumbers: true,
        pagination:true,
        striped:true,
        toolbar:'#toolbar',
        columns:[[
            {field:'kode',title:'Kode',width:75,align:'center'},
            {field:'group_users',title:'Group User',align:'center',width:100},
            {field:'status_aktif',title:'Status Aktif',align:'center',width:100}
                        ]]              
    })
    $('#tb-tambah-gu').linkbutton({  
        iconCls: 'icon-add'  
    });
    $('#tb-edit-gu').linkbutton({  
        iconCls: 'icon-edit'  
    });
    $('#tb-hapus-gu').linkbutton({  
        iconCls: 'icon-remove'  
    });
    $("#tb-tambah-gu").live('click',function(){
        $('#dlg-buttons').show();   
    	var f_url = 'group_users';
        buildForm(f_url);
    })
    $("#tb-edit-gu").live('click',function(){
      $('#dlg-buttons').show();   
    	var row = $('#tt').datagrid('getSelected');
    	if (row){
        		var f_url = 'group_users';
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
    <a href="#"  plain="true" id="tb-tambah-gu">Baru</a>  
    <a href="#"  plain="true" id="tb-edit-gu">Edit</a>  
    <a href="#"  plain="true" onclick="tb_hapus_gu()" id="tb-hapus-gu">Hapus</a>  
</div>  
    