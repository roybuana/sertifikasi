function newUser(ftitle,n_url,content,dtitle){
	$("#f_title").text(dtitle);
   	$("#fm").html(content);
	$('#dlg').dialog('open').dialog('setTitle',ftitle);
	url = 'process/fse_'+n_url;
}
function lForm(ftitle,nm_folder,n_url,content,dtitle){
	$("#f_title").text(dtitle);
   	$("#fm").html(content);
	$('#dlg').dialog('open').dialog('setTitle',ftitle);
	url = 'process/'+nm_folder+'/fse_'+n_url;
}

function editUser(ftitle,n_url,content,dtitle){
      
		$("#f_title").text(dtitle);
		$("#fm").html(content);
		$('#dlg').dialog('open').dialog('setTitle',ftitle);
		$('#fm').form('load','template/form/fe_'+n_url);
		url = "process/fse_"+n_url;
}
function saveUser(){
          $('#fm').form('submit',{
		url: url,
		onSubmit: function(){
			return $(this).form('validate');
		},
		success: function(result){
			var result = eval('('+result+')');
			if (result.success){
				$('#dlg').dialog('close');	
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
       
   // $('#dlg-buttons').show();    
	
}
 
$("#i-print").live('click',function(){
 menu = $(".menu-selected").attr("url");
     var row = $('#tt').datagrid('getSelected') ;
     if(row){
        window.open("cetak/cetak_kurikulum.php?kurikulum_id="+row.kode);
      }else{    
    
    window.open("cetak/cetak_all.php?id="+menu);
    }    
     
})
function tanggalJS(){
    $.extend($.fn.datebox.defaults,{
	formatter:function(date){
		var y = date.getFullYear();
		var m = date.getMonth()+1;
		var d = date.getDate();
		return y+'-'+(m<10?('0'+m):m)+'-'+(d<10?('0'+d):d);
	},
	parser:function(s){
		if (!s) return new Date();
		var ss = s.split('/');
		var d = parseInt(ss[0],10);
		var m = parseInt(ss[1],10);
		var y = parseInt(ss[2],10);
		if (!isNaN(y) && !isNaN(m) && !isNaN(d)){
			return new Date(y,m-1,d);
		} else {
			return new Date();
		}
	}
});
}

function pressEnter(idElemen){
    $(idElemen).keypress(function(e) {
                if(e.which == 13) {
                    doSearch();
                }
            });
}
      