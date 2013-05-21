<?php require_once("../lib/fn_lib.php");
	session_start();
	isAjax();
	privilegesPage();
    $sid=$_SESSION['id'];
 ?>
  <script>
function tb_hapus_formulir(){
            $.messager.confirm('Konfirmasi','Yakin untuk menghapus?',function(hapusOK){
			if (hapusOK){
			  var ids = [];  
            var rowss = $('#tt').datagrid('getSelections');  
             for(var i=0; i<rowss.length; i++){  
                ids.push(rowss[i].kode);  
            }
                $.ajax({
                  type: 'POST',
                  url: 'process/del_formulir.php',
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
        url: 'data/asesmen_data.php',
       	rownumbers: true,
        pagination:true,
        striped:true,
        toolbar:'#toolbar',
        
        frozenColumns:[[ 
            {field:'ck',checkbox:'true',title:'all',width:75,align:'center'}, 
            {field:'no',title:'No Formulir',width:140,align:'center'},  
            {field:'id_users',title:' Kode User',width:130,align:'center'},  
        ]],  
        columns:[[
        
            {field:'kode',title:'Kode',width:75,align:'center',hidden:'true'},
            {field:'jenis_form',title:'Jenis Formulir',width:110,align:'center'},
            {field:'status_form',title:'Status Formulir',width:110,align:'center'},
            {field:'lampiran',title:'Status Formulir',width:110},
            
                        ]]              
    })
    $('#tb-tambah-formulir').linkbutton({  
        iconCls: 'icon-add'  
    });
    
    $('#tb-cetak-formulir').linkbutton({  
        iconCls: 'icon-print'  
    });
    $('#tb-edit-formulir').linkbutton({  
        iconCls: 'icon-edit'  
    });
    $('#tb-hapus-formulir').linkbutton({  
        iconCls: 'icon-remove'  
    });
    $("#tb-tambah-formulir").live('click',function(){
        $('#dlg-buttons').show();   
    	var f_url = 'formulir';
        buildForm(f_url);
    })
    $("#tb-edit-formulir").live('click',function(){
      $('#dlg-buttons').show();   
    	var row = $('#tt').datagrid('getSelected');
    	if (row){
        		var f_url = 'formulir';
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
    <a href="#"  plain="true" id="tb-cetak-formulir">Cetak</a>  
      
    <a href="#"  plain="true" onclick="tb_hapus_formulir()" id="tb-hapus-formulir">Hapus</a>  
</div>  
    