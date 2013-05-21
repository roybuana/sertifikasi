//CONTOH FORMNYA
<form method="post" id="form_import" enctype="multipart/form-data">
        <table>
            <tr>
            <td>LSP :</td>
            <td><input name='id_lsp' id='id_lsp'></td> 
            </tr>
            <tr>
            <td>File Excel  :</td>
            <td><input name='file_input' id='file_input' type='file'  /></td>
            </tr>
            <tr>
            <td colspan="2"><input type="submit" value="Kirim"</td>
            </tr>
        </table>
    </form>
    
    //CONTOH FILE PROSESNYA
<?PHP    
    if ($_FILES)
{
    $tmp = $_FILES['file_input']['tmp_name'];
    $type = $_FILES['file_input']['type'];
    $size = $_FILES['file_input']['size'];
    $filename = $_FILES['file_input']['name'];
    $path = pathinfo($_SERVER['PHP_SELF']);
    //$destination = $path['dirname'] . '/excel/' . $filename;
    $extensionList = array("xls");
    $eks=substr($filename,-3);
    //$pecah = explode('.',$fileName);
    $ekstensi = $pecah[1];
    if(in_array($eks, $extensionList)){
        include "excel_reader2.php"; // INI FILE UNTUK MEMBACA EXCEL NYA
            $data_log = new Spreadsheet_Excel_Reader($tmp);
            $baris_log = $data_log->rowcount($sheet_index=0);
             for ($i=2; $i<=$baris_log; $i++)//artinya di mulai dari baris ke dua
            {
            $id = $data_log->val($i, 1);// artinya data yang ada di baris kedua kolom ke 1
            $rasesor_nama = $data_log->val($i, 2);
            $id_asesor_type= $data_log->val($i, 3);
            $rprop_kode = $data_log->val($i, 4);
            $rkota_kode = $data_log->val($i, 5);
            $rgender_kode = $data_log->val($i, 6);
            $rasesor_lhrtgl = $data_log->val($i, 7);
            $rasesor_lhrt4 = $data_log->val($i, 8);
            $rasesor_alamat = $data_log->val($i, 9);
            $rasesor_kdpos = $data_log->val($i, 10);
            $rasesor_telp = $data_log->val($i, 11);
            $rasesor_email = $data_log->val($i, 12);
            $rasesor_dstart = $data_log->val($i, 13);
            $rasesor_dend = $data_log->val($i, 14);
            $rasesor_jkom = $data_log->val($i, 15);
            $status_aktif = $data_log->val($i, 16);
            
            
            
            
            $max=mysql_fetch_array(mysql_query("SELECT MAX(id) as besar FROM users"));
            $id_use=$max['besar']+1;
             mysql_query("INSERT INTO users SET id=$id_use,email='$rasesor_email',id_group_users=4,users='$rasesor_nama',hp='$rasesor_telp'");    
           $query = "INSERT INTO asesor SET
             id='$id',
             id_users='$id_use',
             rasesor_nama='$rasesor_nama',
            id_asesor_type='$id_asesor_type',
            id_lsp='$id_lsp',
            rgender_kode='$rgender_kode',
            rasesor_alamat='$rasesor_alamat',
            rasesor_telp='$rasesor_telp',
            rasesor_email='$rasesor_email',
            rasesor_dstart='$rasesor_dstart',
            rasesor_dend='$rasesor_dend',
            status_aktif='$status_aktif',
            rprop_kode='$rprop_kode',
            rkota_kode='$rkota_kode'";
            mysql_query($query);
            }
           // $pesan=printf("Records deleted: %d\n", mysql_affected_rows());
        //mysql_query("INSERT INTO log_tayang(id,id_channel,tanggal_tayang) VALUES ($no_auto,$id_channel,'$tanggal')");
       //printf("Records Inserted: %d\n", mysql_affected_rows());
       echo ($baris_log - 1 ).' Record telah ditambahkan';
    }else{
       echo"NO"; 
    }
    
    
}else{
        echo"Kosong"; 
}