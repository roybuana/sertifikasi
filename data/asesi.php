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
$(function(){
    $('#tt').datagrid({
        url: 'data/asesi_data.php',
       	rownumbers: true,
        pagination:true,
        pageList:[5,10,15,20],
        pageSize:5,
        singleSelect:true,
        striped:true,
        toolbar:'#toolbar_cari,#toolbar',
        frozenColumns:[[ 
            {field:'ck',checkbox:'true',title:'all',width:75,align:'center'}, 
            {field:'nama',title:'Nama',width:160},  
            {field:'tgl_daftar',title:'Tanggal Daftar',width:120,align:'center'},
            {field:'status_form',title:'Status',align:'center',width:60},
            {field:'tgl_asesmen',title:'Tgl Ases',align:'center',width:80},
            {field:'hasil',title:'Hasil',align:'center',width:80,
            formatter:function(val,rec){
                                if (val =="BK"){
                                    return '<div style="background-color: #FFFF00;">'+val+'</div>';
                                }else{
                                    return '<div style="background-color: #33FF33;">'+val+'</div>';
                                }
                                }
            },
              
        ]],  
        columns:[[
        
            {field:'kode',title:'Kode',width:75,align:'center',hidden:'true'},
            {field:'id_users',title:'Kode',width:75,align:'center',hidden:'true'},
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
            {field:'catatan',title:'catatan',align:'center',width:100},
                        ]]              
    })
     
    $('#tb-tambah-asesi').linkbutton({  
        iconCls: 'icon-add'  
    });
    $('#tb-edit-asesi,#tb-edit-online').linkbutton({  
        iconCls: 'icon-edit'  
    });
    $('#tb-hapus-asesi').linkbutton({  
        iconCls: 'icon-remove'  
    });
    $('#cari_button').linkbutton({  
        iconCls: 'icon-search'  
    });
    $('#ic').datebox({
        
    })
    $("#tb-edit-online").live('click',function(){
        row=$('#tt').datagrid('getSelected');
        if(row.type_form=='FR-APL-01' && row.jenis_form=='online'){
            $('#detail_div').html('<div  align="center"></div><img  src="images/loader.gif" /></div>').fadeIn();    
        $('#detail_div').load('data/detail/sertifikasi1.php?id='+row.kode+'&id_users='+row.id_users);    
        }else if(row.type_form=='FR-APL-02' && row.jenis_form=='online'){
        $('#detail_div').html('<div  align="center"></div><img  src="images/loader.gif" /></div>').fadeIn();
    $('#detail_div').load('data/detail/sertifikasi2.php?id='+row.kode+'&id_users='+row.id_users);
        }else{
            $('#detail_div').html('');
            $('#dlg-buttons').show();   
    	var row = $('#tt').datagrid('getSelected');
    	if (row){
        		var f_url = 'asesi';
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
        }
        
       
        })
    $("#tb-edit-asesi").live('click',function(){
      $('#dlg-buttons').show();   
    	var row = $('#tt').datagrid('getSelected');
    	if (row){
        		var f_url = 'asesi';
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

<table id='tt' width="auto">


</table>
<div style="height: 20px;"></div>
<div id="detail_div"></div>

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
    
      <a href="#"  plain="true" id="tb-edit-online">Input Penilaian</a>
</div>  
    