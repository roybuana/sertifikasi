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
        url: 'data/c_formulir_data.php',
       	rownumbers: true,
        pagination:true,
        striped:true,
        toolbar:'#toolbar_cari,#toolbar',
        frozenColumns:[[ 
            {field:'ck',checkbox:'true',title:'all',width:75,align:'center'}, 
            {field:'nama',title:'Nama',width:160},  
            {field:'tgl_daftar',title:'Tanggal Daftar',width:120,align:'center'},
            {field:'status_form',title:'Status',align:'center',width:60,
            formatter:function(val,rec){
                                if (val =="Pending"){
                                    return '<div style="background-color: #FFFF00;">'+val+'</div>';
                                }else{
                                    return '<div style="background-color: #33FF33;">'+val+'</div>';
                                }
                                }},
            {field:'tgl_asesmen',title:'Tgl Ases',align:'center',width:80},
            
              
        ]],  
        columns:[[
        
            {field:'kode',title:'Kode',width:75,align:'center',hidden:'true'},
            {field:'nm_asesor',title:'Asesors',align:'center',width:160},
            {field:'type_form',title:'Type Form',align:'center',width:70},
            {field:'jenis_form',title:'Jenis Form',align:'center',width:70},
            {field:'lampiran',title:'Lampiran',align:'center',width:120},
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
     
    $('#tb-cetak-formulir').linkbutton({  
        iconCls: 'icon-print'  
    });
    $('#tb-hapus-formulir').linkbutton({  
        iconCls: 'icon-remove'  
    });
    $('#cari_button').linkbutton({  
        iconCls: 'icon-search'  
    });
    $('#ic').datebox({
        
    })
   
})
</script>
<table id='tt'>
</table>

	<div id="toolbar_cari" style="padding:3px">
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
    <a href="#"  plain="true" id="tb-cetak-formulir">Cetak</a>  
      
    <a href="#"  plain="true" onclick="tb_hapus_formulir()" id="tb-hapus-formulir">Hapus</a>  
</div>  
    