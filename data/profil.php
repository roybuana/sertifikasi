<?php require_once("../lib/fn_lib.php");
	session_start();
	isAjax();
	privilegesPage();
    $sid=$_SESSION['id'];
    $kueri_user=mysql_fetch_array(mysql_query("SELECT * FROM users WHERE id=$sid"));

 ?>
<style>
		.p-search{
			background:#fafafa;
			padding:5px;
			border:1px solid #ccc;
			border-bottom:0;
			overflow:hidden;
		}
		.p-search input{
			width:300px;
			border:1px solid #ccc;
			background: #fff url('images/search.png') no-repeat right top;
		}
		.p-right{
			text-align:center;
			border:1px solid #ccc;
			border-left:0;
			width:150px;
			background:#fafafa;
			padding-top:10px;
		}
	</style>
<style type="text/css">
.odd{
    background-color: #E5E5E5;
}
.even{
    background-color: #D5D5D5;
}
.hover{
    background-color: white;
    color: black;
    cursor:hand;
}
.selected{
    background-color: #CCFF99;
}
#header{
    background-color: gray;
}
</style>
<script type="text/javascript">

    $('#i-update,#i-update2,#i-update3').linkbutton({
        iconCls:'icon-save',
        plain:true  
    })
    $('#i-edit').linkbutton({
        iconCls:'icon-edit',
        plain:true  
    })
    
    $('#aktif').combobox({  
                required:true,
                panelHeight:'auto',
                width:80,
                size:50,
                missingMessage:'Data Harus Dipilih',
                editable: false
                })
    
    $('#nama').validatebox({  
                required:true,
                missingMessage:'Data Harus Diisi'
                })
    $('#kode').validatebox({  
               disable:true
                })
    $('#hp').validatebox({  
                required:true,
                missingMessage:'Data Harus Diisi'
                })
    $('#tlahir').validatebox({  
                required:false,
                })
    $('#tab').tabs({
        
    })
    $('#cal').datebox({
        
        });
    $("tr:odd").addClass("odd");
    $("tr:even").addClass("even");
    $("tr").not(":first").hover(function(){
        $(this).toggleClass('hover');
    });
    $("tr").click(function(){
        $(".selected").removeClass("selected");
        $(this).addClass("selected");
    })
    $(document).ready(function() {
        $('#tes2').datagrid({
                url:'profil/beranda.php',
                pagination:true,
                loadMsg:'Tunggu Sedang Proses',
                rownumbers:true,
                fit:true,
                title:'Data Peserta',
                singleSelect:false,
                striped:true,
                border:true,
                //idField:'kode',
                columns:[[
                {field:'ck',checkbox:true},
                 {field:'kode',title:'ID',width:125,align:'center'},
                {field:'nama',title:'nama',width:125,align:'center'},
                
                ]]
    });
    $('#win').dialog({
        
    })
    $('#email').validatebox({
        width:200
    })
      //$("#i-update").click(function(event){
        $('#tesForm').form({  
            url:'data/profil_change.php',  
            onSubmit:function(){  
                return $(this).form('validate');  
            },  
            success:function(data){  
                $.messager.alert('Info', data, 'info');  
                 
            }  
        }); 
         
        //  });
      });
   
</script>
<body>

    
                        <fieldset><legend>Form Profil Pribadi</legend>
     
    
    <form method="POST" id="tesForm">
    <table border="0" cellpadding="2" cellspacing="2" width="100%">
        
      <tr>
            <td>Nama Lengkap</td>
            <td colspan='2'><input value="<?php echo $kueri_user['users']; ?>" style="width: 200px;"  name='nama' class='easyui-validatebox' size='30' id='nama' required='true'></td>
        </tr>
       
        
        <tr>
            <td>E-mail</td>
            <td colspan='2'><input value="<?php echo $kueri_user['email']; ?>" style="width: 200px;" validType='email' name='email' class='easyui-validatebox'   id='email' required='true' ></td>
        </tr>
        <tr>
            <td>Password</td>
            <td colspan='2'><input type="password" style="width: 200px;" name='password'   id='password'  /></td>
        </tr>
        <tr>
            <td>Konfirmasi Password</td>
            <td colspan='2'><input type="password" style="width: 200px;" name='password2'   id='password2' /></td>
        </tr>     
        <tr><td></td><td><input type="submit" value="save" /></td></tr>
 </table>
 </form>
 </fieldset>
              
    
 

 </body>