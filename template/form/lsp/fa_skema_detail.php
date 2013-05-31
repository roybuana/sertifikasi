<?php
	require_once('../../../lib/fn_lib.php');
	session_start();
	isAjax();
	privilegesPage();
   
    $nama_skema=mysql_fetch_array(mysql_query("SELECT skema FROM skema WHERE id=$_GET[id]"));
	$data = array();
    $id_hidden="<input type=hidden value=$_GET[id] id='id_skema_hidden' />";
    
    $data['content']="<script type='text/javascript'>
    function doSearch_unit(){
			$('#tb_uk').datagrid('load',{
			    ia_unit: $('#ia_unit').val(),
                ib_unit: $('#ib_unit').val(),
                
              
			});
		}
    function tb_hapus_unit_k_detail(){
        $.messager.confirm('Konfirmasi','Yakin untuk menghapus?',function(hapusOK){
			if (hapusOK){
			  var ids = [];  
            var rowss = $('#tb_uk_detail').datagrid('getSelections');  
             for(var i=0; i<rowss.length; i++){  
                ids.push(rowss[i].kode);  
            }
                $.ajax({
                  type: 'POST',
                  url: 'process/lsp/hapus_skema_del.php',
                  data:{ var_array:ids },
                 
                  success: function(result){
                			var result = eval('('+result+')');
                			if (result.success){
                				$.messager.show({
                					title: 'Success',
                					msg: result.msg
                				});
                				$('#tb_uk_detail').datagrid('reload');
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
    var id_skema=$('#id_skema_hidden').val();
    function tambah_unit_k(){
        var ids = [];  
        var rows = $('#tb_uk').datagrid('getSelections');  
        for(var i=0; i<rows.length; i++){  
            ids.push(rows[i].id_uk);  
        } 
        
			$.ajax({
              type: 'POST',
              url: 'process/lsp/tambah_skema_sv.php?id_skema='+id_skema,
              data:{ data_array:ids },
              success: function(result){
            			var result = eval('('+result+')');
            			if (result.success){
            				//$('#dlg').dialog('close');	
            				$.messager.show({
            					title: 'Success',
            					msg: result.msg
            				});
            				$('#tb_uk_detail').datagrid('reload');
            			} else {
            				$.messager.show({
            					title: 'Error',
            					msg: result.msg
            				});
            			}
            		}
            });
        }
    
    $('#tanggal_ketetapan,#tanggal_entry').datebox({
        width:90
    })
     $('#status_aktif').combobox({  
                panelHeight:'auto',
                size:100,
                width:100
                });
     $(function(){
        $('#tb_tambah_unit_k').linkbutton({  
            iconCls: 'icon-add'  
        });
        $('#tb_hapus_unit_k_detail').linkbutton({  
            iconCls: 'icon-remove'  
        });
    $('#cari_button_unit').linkbutton({
                iconCls:'icon-search',
                plain:true
            })
       $('#tab_skema').tabs({});
        $('#tb_uk').datagrid({
        url: 'data/lsp/unit_kompetensi_data_cache.php',
       	rownumbers: true,
        pagination:true,
         toolbar:'#toolbar_cari_skema,#toolbar_skema',
        striped:true,
        frozenColumns:[[ 
            {field:'ck',checkbox:'true',title:'all',width:75,align:'center'},
            {field:'id_uk',title:'Kode UK',width:130,align:'center'},
            {field:'unit_kompetensi',title:'Unit Kompetensi',width:450}, 
            
        ]],
        columns:[[ 
            {field:'bid_id',title:'Kode Bidang',width:80,align:'center'},
            {field:'bidang',title:'Bidang Kompetensi',width:300}, 
            {field:'kode',title:'Kode Sub',width:80,align:'center'},
            {field:'sektor_sub',title:'Sub Sektor',width:300},
            {field:'id_sektor',title:'Kode Sektor',width:80,align:'center'},  
            {field:'sektor',title:'Sektor',width:300},
            
             
        ]]              
    })
    $('#tb_uk_detail').datagrid({
        url: 'data/lsp/unit_kompetensi_detail.php?id_skema='+id_skema,
       	rownumbers: true,
        pagination:true,
        toolbar:'#toolbar_skema_detail',
        striped:true,
        columns:[[ 
        {field:'ck',checkbox:'true',title:'all',width:75,align:'center'},
            {field:'kode',title:'Kode',width:80,align:'center'},
            {field:'id_unit_kompetensi',title:'Unit Kompetesi',width:300}, 
            {field:'id_skema',title:'Kode Skema',width:80,align:'center'}, 
        ]]              
    })
        })
     </script>";
    
   
           
           
	$data['content'] .= "
    <div id='tab_skema'>
    <div title='Tambah Unit' >
      <table id='tb_uk'>
</table>
<div id='toolbar_cari_skema' style='padding:3px;'>
        <span>Kode Unit :</span>$id_hidden
		<input id='ia_unit' style='width:75px;line-height:18px;border:1px solid #ccc'>
         <span>Nama Unit :</span>
		<input id='ib_unit' style='width:75px;line-height:18px;border:1px solid #ccc'>
	
       
        	<a href='#' id='cari_button_unit' onclick='doSearch_unit()'>Search</a>
	</div>
    <div id='toolbar_skema' >  
    <a href='#'  plain='true' id='tb_tambah_unit_k' onclick='tambah_unit_k()'>Tambah</a>  
</div>  
</div>
<div title='Detail Unit' style='padding:3px;margin:3px;'>
<table id='tb_uk_detail'>
</table>
<div id='toolbar_skema_detail' >  
    <a href='#'  plain='true' id='tb_hapus_unit_k_detail' onclick='tb_hapus_unit_k_detail()'>Hapus</a>  
</div> </div>

  
                       ";
                            
	$data['ftitle'] = 'Input Unit Kompetensi';
	$data['dtitle'] = '';
	echo json_encode($data);
?>