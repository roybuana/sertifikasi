<?php require_once("../../lib/fn_lib.php");
	session_start();
	isAjax();
	privilegesPage();
 ?>
  <script>
function tb_hapus_sektor(){
            $.messager.confirm('Konfirmasi','Yakin untuk menghapus?',function(hapusOK){
			if (hapusOK){
			  var ids = [];  
            var rowss = $('#tt').datagrid('getSelections');  
             for(var i=0; i<rowss.length; i++){  
                ids.push(rowss[i].kode);  
            }
                $.ajax({
                  type: 'POST',
                  url: 'process/del_sektor.php',
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
        url: 'data/bnsp/sektor_sub_data.php',
       	rownumbers: true,
        pagination:true,
        striped:true,
        toolbar:'#toolbar',
        columns:[[ 
            {field:'ck',checkbox:'true',title:'all',width:75,align:'center'}, 
            {field:'kode',title:'Kode Sub',width:80,align:'center'},
            {field:'sektor_sub',title:'Sub Sektor',width:300},
            {field:'id_sektor',title:'Kode Sektor',width:80,align:'center'},  
            {field:'sektor',title:'Sektor',width:300},
             
        ]]              
    })

    $('#tb-tambah-sektor').linkbutton({  
        iconCls: 'icon-add'  
    });
    $('#tb-edit-sektor').linkbutton({  
        iconCls: 'icon-edit'  
    });
    $('#tb-hapus-sektor').linkbutton({  
        iconCls: 'icon-remove'  
    });
    $("#tb-tambah-sektor").live('click',function(){
        $('#dlg-buttons').show();   
    	var f_url = 'sektor';
        buildForm(f_url);
    })
    $("#tb-edit-sektor").live('click',function(){
      $('#dlg-buttons').show();   
    	var row = $('#tt').datagrid('getSelected');
    	if (row){
        		var f_url = 'sektor';
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
    <a href="#"  plain="true" id="tb-tambah-sektor">Baru</a>  
    <a href="#"  plain="true" id="tb-edit-sektor">Edit</a>  
    <a href="#"  plain="true" onclick="tb_hapus_sektor()" id="tb-hapus-sektor">Hapus</a>  
</div>  
    