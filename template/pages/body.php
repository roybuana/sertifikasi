<?php
	defined('START')||(header("HTTP/1.1 403 Forbidden")&die('403.14 - Directory listing denied.'));
?> <strong style="color: white; margin-left: 4px;">APLIKASI Siskomtek v.01(Sistem Informasi Sertifikasi Tenaga Kerja)</strong>
 <div class="easyui-layout" style="width:100%;height:100%;">
	<div data-options="region:'north'" style="height:auto">
    <?php include "menu.php" ?>
       
    </div>
		<div data-options="region:'east',collapsed:'true',split:true" title="Iklan" style="width:180px;"></div>
		<div data-options="region:'west',collapsed:'true',split:true" title="Berita" style="width:100px;"></div>
		<div data-options="region:'center',iconCls:'icon-layout'" style="padding: 2px;">
        <div id="tabhome" class="easyui-tabs" style="width:auto;" >  
            	<div id="konten_menu" title="Konten" style="padding: 2px;">
                <?php
                    include"data/beranda.php";   
                ?>
                
            </div> 
             
        </div> 
    		  	     
		</div>
	</div>
 
     <div id="dlg" class="easyui-dialog" style="width:427px;height:auto;top:30px;"  
            closed="true" buttons="#dlg-buttons" draggable="true" modal="true">  
        <div class="ftitle" id="f_title"></div>  
        <form id="fm" method="post" class="formLayout">  
              
        </form>  
    </div>  
    <div id="dlg-buttons">  
        <a class="easyui-linkbutton" iconCls="icon-ok" onclick="saveUser()">Save</a>  
        <a class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg').dialog('close')">Cancel</a>  
    </div>
    
    <div id="dlg2" class="easyui-dialog" style="width:427px;height:350px;top:10px;"  
            closed="true" buttons="#dlg-buttons2" draggable="false" modal="true">  
        <div class="ftitle" id="f_title2"></div>  
        <form id="fm2" method="post" class="formLayout">  
              
        </form>  
    </div>  
    <div id="dlg-buttons2">  
        <a class="easyui-linkbutton" iconCls="icon-ok" onclick="saveUser2()">Save</a>  
        <a class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg2').dialog('close')">Cancel</a>  
    </div>
    <div id="p" style="width:400px;"></div>  
    