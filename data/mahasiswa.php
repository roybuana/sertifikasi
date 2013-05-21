<?php require_once("../lib/fn_lib.php");
	session_start();
	isAjax();
	privilegesPage();
 ?>
  <script>
function tb_hapus_mahasiswa(){
            $.messager.confirm('Konfirmasi','Yakin untuk menghapus?',function(hapusOK){
			if (hapusOK){
			  var ids = [];  
            var rowss = $('#tt').datagrid('getSelections');  
             for(var i=0; i<rowss.length; i++){  
                ids.push(rowss[i].kode);  
            }
                $.ajax({
                  type: 'POST',
                  url: 'process/del_mahasiswa.php',
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
        url: 'data/mahasiswa_data.php',
       	rownumbers: true,
        pagination:true,
        striped:true,
        toolbar:'#toolbar',
        columns:[[ 
            {field:'ck',checkbox:'true',title:'all',width:75,align:'center'}, 
            {field:'kode',title:'NIM',width:80},  
            {field:'roy',title:'Nama',width:80},
            {field:'hp',title:'HP',width:80},
            {field:'alamat',title:'Alamat',width:90},  
        ]],  
                     
    })
    $('#tb-tambah-mahasiswa').linkbutton({  
        iconCls: 'icon-add'  
    });
    $('#tb-edit-mahasiswa').linkbutton({  
        iconCls: 'icon-edit'  
    });
    $('#tb-hapus-mahasiswa').linkbutton({  
        iconCls: 'icon-remove'  
    });
    $("#tb-tambah-mahasiswa").live('click',function(){
        $('#dlg-buttons').show();   
    	var f_url = 'mahasiswa';
        buildForm(f_url);
    })
    $("#tb-edit-mahasiswa").live('click',function(){
      $('#dlg-buttons').show();   
    	var row = $('#tt').datagrid('getSelected');
    	if (row){
        		var f_url = 'mahasiswa';
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
    <a href="#"  plain="true" id="tb-tambah-mahasiswa">Baru</a>  
    <a href="#"  plain="true" id="tb-edit-mahasiswa">Edit</a>  
    <a href="#"  plain="true" onclick="tb_hapus_mahasiswa()" id="tb-hapus-mahasiswa">Hapus</a>  
</div>  
    