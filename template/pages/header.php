<?php
	defined('START')||(header("HTTP/1.1 403 Forbidden")&die('403.14 - Directory listing denied.'));
?>

<style>
    a{
     text-decoration: none;   
    }
    a:hover{
     text-decoration: underline; 
    }
	.panel-body{
		background:#f0f0f0;
	}
	.panel-header{
		background:#fff url('template/images/panel_header_bg.gif') no-repeat top right;
	}
	.panel-tool-collapse{
		background:url('template/images/arrow_up.gif') no-repeat 0px -3px;
	}
	.panel-tool-expand{
		background:url('template/images/arrow_down.gif') no-repeat 0px -3px;
	}
	
    .formLayout{
		margin-top: 2px;
        height: auto;
        width: auto;
        position: static;
	}
	.formLayout label, .formLayout input, 
    {
        display: inline-block;
        width: auto;
        float: left;
        margin-bottom: 10px;
        padding-right: 0px;
    }
 
    .formLayout label
    {
        text-align: right;
        padding-right: 0px;
    }
 
    br
    {
        clear: left;
    }
    #td{
        
    }
</style>
<script type="text/javascript" >

   function addTab(title, url){  
    if ($('#tabhome').tabs('exists', title)){  
        $('#tabhome').tabs('select', title);  
    } else {  
        var content = '<iframe scrolling="auto" frameborder="0"  src="'+url+'" style="width:100%;height:100%;"></iframe>';  
        $('#tabhome').tabs('add',{  
            title:title,  
            content:content,  
            closable:true  
        });  
    }  
}  
    function buildForm(f_url){
        $("#fm").form("clear");
       	$.ajax({
		url: "template/form/fa_"+f_url+".php",
		dataType: 'json',
		timeout: 2000,
		error: function() {	
		},
        
		      success: function(xr){
        
			var ctn = xr.content;
			newUser(xr.ftitle,f_url+".php",ctn.replace(/\\/,""),xr.dtitle);
	       	}	
	   })
    }
    function C_Form(nm_folder,nm_file,lebar_form,lebar_dlg,var1,var2){
        $("#fm").form("clear");
        $('.formLayout').css('width',lebar_form);
        
        $('#dlg').dialog({
          width:lebar_dlg  
        })
        if(var1!==undefined){
            url1='?id='+var1;
        }else{
            url1='';
        }
       	$.ajax({
		url: "template/form/"+nm_folder+"/fa_"+nm_file+".php"+url1,
		dataType: 'json',
		timeout: 2000,
		error: function() {	
		},
        
		      success: function(xr){
        
			var ctn = xr.content;
			lForm(xr.ftitle,nm_folder,nm_file+".php",ctn.replace(/\\/,""),xr.dtitle);
	       	}	
	   })
    }
   
    
 	$(function(){
 	  
tanggalJS();
$("#m_guide").live('click',function(){
  //  addTab('Group User','data/group_user.php');
  
   // $('#konten_menu').load('panduan.php');
    addTab('Manual Guide','panduan.php');
})
$("#group_user").live('click',function(){
    $('#tabhome').tabs('select', 'Konten');
  //  addTab('Group User','data/group_user.php');
  $('#konten_menu').html('<div  align="center"></div><img  src="images/loader.gif" /></div>').fadeIn();
    $('#konten_menu').load('data/group_user.php');
})
$("#users").live('click',function(){
    $('#tabhome').tabs('select', 'Konten');
    $('#konten_menu').html('<div  align="center"></div><img  src="images/loader.gif" /></div>').fadeIn();
     $('#konten_menu').load('data/users.php');
})
$("#sertifikasi").live('click',function(){
    $('#tabhome').tabs('select', 'Konten');
    // addTab('Sertifikasi','data/sertifikasi.php');
    $('#konten_menu').html('<div  align="center"></div><img  src="images/loader.gif" /></div>').fadeIn();       
     $('#konten_menu').load('data/sertifikasi.php');
     //$.messager.progress('close'); 
})
$("#profil").live('click',function(){
    $('#tabhome').tabs('select', 'Konten');
$('#konten_menu').html('<div  align="center"></div><img  src="images/loader.gif" /></div>').fadeIn();
    $('#konten_menu').load('data/profil.php');
})
$("#menus").live('click',function(){
    $('#tabhome').tabs('select', 'Konten');

    $('#konten_menu').html('<div  align="center"></div><img  src="images/loader.gif" /></div>').fadeIn();
    $('#konten_menu').load('data/menu.php');
})
$("#c_asesmen").live('click',function(){
    $('#tabhome').tabs('select', 'Konten');
    $('#konten_menu').html('<div  align="center"></div><img  src="images/loader.gif" /></div>').fadeIn();
    $('#konten_menu').load('data/c_asesmen.php');
})
$("#c_formulir").live('click',function(){
    $('#tabhome').tabs('select', 'Konten');
    $('#konten_menu').html('<div  align="center"></div><img  src="images/loader.gif" /></div>').fadeIn();
    $('#konten_menu').load('data/c_formulir.php');
})				
$("#mahasiswa").live('click',function(){
    $('#tabhome').tabs('select', 'Konten');
    $('#konten_menu').html('<div  align="center"></div><img  src="images/loader.gif" /></div>').fadeIn();
    $('#konten_menu').load('data/mahasiswa.php');
})
$("#f_manual").live('click',function(){
    $('#tabhome').tabs('select', 'Konten');
    $('#konten_menu').html('<div  align="center"></div><img  src="images/loader.gif" /></div>').fadeIn();
    $('#konten_menu').load('data/f_manual.php');
})
$("#c_sertifikat").live('click',function(){
    $('#tabhome').tabs('select', 'Konten');
    $('#konten_menu').html('<div  align="center"></div><img  src="images/loader.gif" /></div>').fadeIn();
    $('#konten_menu').load('data/c_sertifikat.php');
})
$("#asesmen").live('click',function(){
    $('#tabhome').tabs('select', 'Konten');
    $('#konten_menu').html('<div  align="center"></div><img  src="images/loader.gif" /></div>').fadeIn();
    $('#konten_menu').load('data/asesmen.php');
})

$("#asesi").live('click',function(){
    $('#tabhome').tabs('select', 'Konten');
    $('#konten_menu').html('<div  align="center"></div><img  src="images/loader.gif" /></div>').fadeIn();
    $('#konten_menu').load('data/asesi.php');
})
$("#tak").live('click',function(){
    $('#tabhome').tabs('select', 'Konten');
    $('#konten_menu').html('<div  align="center"></div><img  src="images/loader.gif" /></div>').fadeIn();
    $('#konten_menu').load('data/lsp/tak.php');
})
$("#skema_lsp").live('click',function(){
    $('#tabhome').tabs('select', 'Konten');
    $('#konten_menu').html('<div  align="center"></div><img  src="images/loader.gif" /></div>').fadeIn();
    $('#konten_menu').load('data/lsp/skema_lsp.php');
})
$("#asesor").live('click',function(){
    $('#tabhome').tabs('select', 'Konten');
    $('#konten_menu').html('<div  align="center"></div><img  src="images/loader.gif" /></div>').fadeIn();
    $('#konten_menu').load('data/bnsp/asesor.php');
})

$("#d_asesor").live('click',function(){
    $('#tabhome').tabs('select', 'Konten');
    $('#konten_menu').html('<div  align="center"></div><img  src="images/loader.gif" /></div>').fadeIn();
    $('#konten_menu').load('data/bnsp/asesor.php');
})
$("#d_lsp").live('click',function(){
    $('#tabhome').tabs('select', 'Konten');
    $('#konten_menu').html('<div  align="center"></div><img  src="images/loader.gif" /></div>').fadeIn();
    $('#konten_menu').load('data/bnsp/lsp.php');
})
$("#sektor").live('click',function(){
    $('#tabhome').tabs('select', 'Konten');
    $('#konten_menu').html('<div  align="center"></div><img  src="images/loader.gif" /></div>').fadeIn();
    $('#konten_menu').load('data/bnsp/sektor.php');
})
$("#sub_sektor").live('click',function(){
    $('#tabhome').tabs('select', 'Konten');
    $('#konten_menu').html('<div  align="center"></div><img  src="images/loader.gif" /></div>').fadeIn();
    $('#konten_menu').load('data/bnsp/sektor_sub.php');
})
$("#bidang").live('click',function(){
    $('#tabhome').tabs('select', 'Konten');
    $('#konten_menu').html('<div  align="center"></div><img  src="images/loader.gif" /></div>').fadeIn();
    $('#konten_menu').load('data/bnsp/bidang.php');
})
$("#unit_kompetensi").live('click',function(){
    $('#tabhome').tabs('select', 'Konten');
    $('#konten_menu').html('<div  align="center"></div><img  src="images/loader.gif" /></div>').fadeIn();
    $('#konten_menu').load('data/bnsp/unit_kompetensi.php');
})
$("#profil_lsp").live('click',function(){
    $('#tabhome').tabs('select', 'Konten');
    $('#konten_menu').html('<div  align="center"></div><img  src="images/loader.gif" /></div>').fadeIn();
    $('#konten_menu').load('data/lsp/profil.php');
})
$("#hub_kami").live('click',function(){
    addTab('Hubungi Kami','data/hub_kami.php');
})
	})
 </script>
 <script type="text/javascript" src="js/fn_button.js"></script>