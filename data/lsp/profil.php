<?php require_once("../../lib/fn_lib.php");
	session_start();
	isAjax();
	privilegesPage();
    $sid=$_SESSION['id'];
    $kueri_user=mysql_fetch_array(mysql_query("SELECT * FROM users WHERE id=$sid"));
    $kueri_lsp=mysql_fetch_array(mysql_query("SELECT * FROM lsp WHERE id_users=$sid"));

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
var jml = 1;
    $('#tambah').click(function(){
                   	
					var row = jml;			
                    		
					var baris = '<tr><td>Jabatan :<input name=jabatan[]>Nama :<input name=nama[]></td></tr>';                    
					$('#upl > tbody:last').append(baris);					
					jml = row + 1;					
				});
    $('#hapus').click(function(){
       
					if(jml > 1){
						$('#upl > tbody:last tr:last').remove();
						jml = jml - 1;
					}					
				});
    $('.add_plus').click(function(e){
            e.preventDefault();
            var input=$('#first_clone');
            var clone=input.clone(true);
            clone.removeAttr('#id');
            clone.val('');
            clone.appendTo('.input_upload');
            })
        
    $('#ttab').tabs({  
        border:false
    });   
    $('#rlsp_doperasi,#rlsp_dberdiri,#rlsp_dlic').datebox({})
     $('#id_group_users').combogrid({
                
				panelWidth:450,
                width:300,
				url: 'template/json/combogrid/cb_group_users.php',
				idField:'id',
				textField:'group_users',
				mode:'remote',
    
				fitColumns:true,
				columns:[[
                        
					{field:'id',title:'Kode Group ',width:100,align:'center'},
					{field:'group_users',title:'Group Users',align:'left',width:340},
                    	
				]]
    });
     $('#status_aktif').combobox({  
                panelHeight:'auto',
                size:100,
                width:100
                });
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
    
        /*
         
    $("tr:odd").addClass("odd");
    $("tr:even").addClass("even");
    $("tr").not(":first").hover(function(){
        $(this).toggleClass('hover');
    });
    $("tr").click(function(){
        $(".selected").removeClass("selected");
        $(this).addClass("selected");
    })
         
         */
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
            url:'data/lsp/profil_change.php',  
            onSubmit:function(){  
                return $(this).form('validate');  
            },  
            success:function(data){  
                $.messager.alert('Info', data, 'info');
                $('#konten_menu').html('<div  align="center"></div><img  src="images/loader.gif" /></div>').fadeIn();  
                $('#konten_menu').load('data/lsp/profil.php');
                 
            }  
        }); 
         
        //  });
      });
   
</script>
<body>
<form method="POST" id="tesForm">
    <fieldset><legend>Profil LSP</legend>
 
    <table border="0" cellpadding="2" cellspacing="2" width="100%">
<tr>
<td width='100'>Kode LSP :</td>
<td><input name='id' id='id' value="<?php
echo $kueri_lsp['id'];
 ?>" type="hidden"><input value="<?php
echo $kueri_lsp['id'];
 ?>" </td> 
</tr>
<tr>
<td>Nama LSP :</td>
<td><input name='rlsp_nama' id='rlsp_nama' value="<?php
echo $kueri_lsp['rlsp_nama'];
 ?>" disabled="true" /><input  name='id_auto' id='id_auto' type='hidden'></td> 
</tr>
 <tr>
            <td>Password</td>
            <td ><input type="password" style="width: 200px;" name='password'   id='password'  /> <strong style="color: red;">* Kosongkan jika tidak ingin mengubah password</strong></td>
        </tr>
        <tr>
            <td>Konfirmasi Password</td>
            <td ><input type="password" style="width: 200px;" name='password2'   id='password2' /></td>
        </tr>   
<tr>
<td>Alamat :</td>
<td><textarea name='rlsp_alamat' id='rlsp_alamat' cols=30 rows=3>

<?php
echo $kueri_lsp['rlsp_alamat'];
 ?>
</textarea></td> 
</tr>

<tr>
<td>Website :</td>
<td><input name='rlsp_url' id='rlsp_url' value="<?php
echo $kueri_lsp['rlsp_url'];
 ?>" /></td> 
</tr>

<tr>
<td>Kode Pos  :</td>
<td><input name='rlsp_kodepos' id='rlsp_kodepos' value="<?php
echo $kueri_lsp['rlsp_kodepos'];
 ?>" /></td>
</tr>
<tr>
<td>HP / Telp:</td>
<td><input name='rlsp_telp' id='rlsp_telp' value="<?php
echo $kueri_lsp['rlsp_telp'];
 ?>" /></td> 
</tr>
<tr>
<td>FAX:</td>
<td><input name='rlsp_fax' id='rlsp_fax' value="<?php
echo $kueri_lsp['rlsp_fax'];
 ?>" /></td> 
</tr>
<tr>
<td>Email :</td>
<td><input name='rlsp_email' id='rlsp_email' value="<?php
echo $kueri_lsp['rlsp_email'];
 ?>" /></td> 
</tr>
<tr> 
<td width='170'>No Lisensi :</td>
<td ><input name='rlsp_nolis' id='rlsp_nolis' value="<?php
echo $kueri_lsp['rlsp_nolis'];
 ?>" /></td> 
</tr>
<tr>
<td>No Surat Keputusan Lisensi :</td>
<td><input name='surat_kep_lisiensi' id='surat_kep_lisiensi' value="<?php
echo $kueri_lsp['surat_kep_lisiensi'];
 ?>" /></td> 
</tr>
<tr>
<td>Tgl Berdiri :</td>
<td><input name='rlsp_dberdiri' id='rlsp_dberdiri' value="<?php
echo $kueri_lsp['rlsp_dberdiri'];
 ?>" /></td> 
</tr>
<tr>
<td>Tgl Operasi :</td>
<td><input name='rlsp_doperasi' id='rlsp_doperasi' value="<?php
echo $kueri_lsp['rlsp_doperasi'];
 ?>" /></td> 
</tr>
<tr>
<td>Tgl Kep Lisensi :</td>
<td><input name='rlsp_dlic' id='rlsp_dlic' value="<?php
echo $kueri_lsp['rlsp_dlic'];
 ?>" /></td> 
</tr>
<tr>
<td>No Surat keputusan penambahan ruang lingkup :</td>
<td><input name='penambahan_rl' id='penambahan_rl' value="<?php
echo $kueri_lsp['penambahan_rl'];
 ?>" /></td> 
</tr>
<tr>
<td>Asosiasi Pendukung :</td>
<td><input name='asosiasi_pendukung' id='asosiasi_pendukung' value="<?php
echo $kueri_lsp['asosiasi_pendukung'];
 ?>" /></td> 
</tr>
<tr>
<td>Kementrian/Instansi Pendukung:</td>
<td><input name='instansi_pendukung' id='instansi_pendukung' value="<?php
echo $kueri_lsp['instansi_pendukung'];
 ?>" /></td> 
</tr>
                 
    </table>
      <fieldset ><legend>Susunan Kepengurusan</legend>
       <div>
            <input type='button' value='Tambah' id='tambah'>	
            <input type='button' value='Hapus' id='hapus'>	
        </div>
     
         <table id='upl' >
		  
                <tbody>   
<?php
$kueri_pengurus=mysql_query("SELECT * FROM lsp_pengurus WHERE id_lsp='$kueri_lsp[id]'");
if(mysql_num_rows($kueri_pengurus) != 0){
    while($rows_pengurus=mysql_fetch_array($kueri_pengurus)){
        echo "<tr>
					   <td>Jabatan  :<input name='jabatan[]' value='$rows_pengurus[jabatan]'>Nama :<input name=nama[] value='$rows_pengurus[nama]'></td>
				   </tr>";
      // echo mysql_num_rows($kueri_pengurus);
    }
 }else{
    echo"<tr>
					   <td>Jabatan :<input name=jabatan[]>Nama :<input name=nama[]></td>
				   </tr>";
}

?>		   
				   
                  
		   		</tbody>
                </table>
                
                </fieldset>
                <input type="submit" value="Simpan Perubahan" style="margin-bottom: 50px;" /> <strong style="color: red;">* Klik untuk update data LSP</strong>
                             </form>
                             

 </body>