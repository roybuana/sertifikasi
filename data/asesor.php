<?php require_once("../lib/fn_lib.php");
	session_start();
	isAjax();
	privilegesPage();
 ?>
  <script>
  function doSearch(){
			$('#tt').datagrid('load',{
			    ia: $('#ia').val(),
                ib: $('#ib').val(),
                ic: $('#ic').datebox('getValue'),  
			});
		}
function tb_hapus_asesor(){
            $.messager.confirm('Konfirmasi','Yakin untuk menghapus?',function(hapusOK){
			if (hapusOK){
			  var ids = [];  
            var rowss = $('#tt').datagrid('getSelections');  
             for(var i=0; i<rowss.length; i++){  
                ids.push(rowss[i].kode);  
            }
                $.ajax({
                  type: 'POST',
                  url: 'process/del_asesor.php',
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
        url: 'data/c_asesmen_data.php',
       	rownumbers: true,
        pagination:true,
        striped:true,
        toolbar:'#toolbar_cari,#toolbar',
        frozenColumns:[[ 
            {field:'ck',checkbox:'true',title:'all',width:75,align:'center'}, 
            {field:'nama',title:'Nama',width:180},  
            {field:'tgl_daftar',title:'Tanggal Daftar',width:120},
            {field:'status_aktif',title:'Status Aktif',align:'center',width:100}  
        ]],  
        columns:[[
        
            {field:'kode',title:'Kode',width:75,align:'center',hidden:'true'},
            {field:'tgl_lahir',title:'Tanggal Lahir',align:'center',width:100},
            {field:'jen_kel',title:'Jenkel',align:'center',width:100},
            {field:'kebangsaan',title:'Kebangasan',align:'center',width:100},
            {field:'alamat',title:'Alamat',align:'center',width:100},
            {field:'ko_pos',title:'Ko Pos',align:'center',width:100},
            {field:'hp',title:'No HP',align:'center',width:100},
            {field:'email',title:'Email',align:'center',width:100},
            {field:'nama_sekolah',title:'Nama Sekolah',align:'center',width:100},
            {field:'jurusan',title:'Jurusan',align:'center',width:100},
            {field:'strata',title:'Strata',align:'center',width:100},
            {field:'thn_lulus',title:'Tahun Lulus',align:'center',width:100},
            {field:'nama_perusahaan',title:'Nama Perusahaan',align:'center',width:100},
            {field:'jabatan',title:'Jabatan',align:'center',width:100},
            {field:'alamat_kantor',title:'Alamat Kantor',align:'center',width:100},
            {field:'ko_pos_kantor',title:'Ko Pos',align:'center',width:100},
            {field:'telp_kantor',title:'Telp Kantor',align:'center',width:100},
            {field:'fax',title:'Fax Kantor',align:'center',width:100},
            {field:'email_kantor',title:'Email Kantor',align:'center',width:100},
            {field:'tuk',title:'TUK',align:'center',width:100},
            
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
        iconCls: 'icon-search'  
    });
    $('#ic').datebox({
        
    })
    $("#tb-tambah-asesor").live('click',function(){
        $('#dlg-buttons').show();   
    	var f_url = 'asesor';
        buildForm(f_url);
    })
    $("#tb-edit-asesor").live('click',function(){
      $('#dlg-buttons').show();   
    	var row = $('#tt').datagrid('getSelected');
    	if (row){
        		var f_url = 'asesor';
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
        <span>Nama :</span>
		<input id="ia" style="width:75px;line-height:20px;border:1px solid #ccc">
         <span>Status:</span>
		<select id="ib">
            <option value="">Pilih</option>
            <option value="Y">Y</option>
            <option value="N">N</option>
        </select>
		<span>Tanggal Daftar :</span>
		<input id="ic" style="width:100px;line-height:20px;border:1px solid #ccc">
		
        	<a href="#" id="cari_button" onclick="doSearch()">Search</a>
	</div>
    <div id="toolbar">  
    <a href="#"  plain="true" id="tb-tambah-asesor">Baru AS</a>  
    <a href="#"  plain="true" id="tb-edit-asesor">Edit</a>  
    <a href="#"  plain="true" onclick="tb_hapus_asesor()" id="tb-hapus-asesor">Hapus</a>  
</div>  
    