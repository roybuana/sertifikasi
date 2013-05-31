<?php
	require_once("../../lib/fn_lib.php");
	session_start();
	isAjax();
	privilegesPage();
	$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
	$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
    $ia = isset($_POST['ia']) ? mysql_real_escape_string($_POST['ia']) : '';
    $ib = isset($_POST['ib']) ? mysql_real_escape_string($_POST['ib']) : '';
    $ic = isset($_POST['ic']) ? mysql_real_escape_string($_POST['ic']) : '';
      
	$offset = ($page-1)*$rows;
    /**
     * $memcache = new Memcache;
     $key = md5("0612502526");
        $memcache->connect('localhost', 11211) or die ("Could not connect");
        $cek_memcache=$memcache->append($key,'a');
        if($cek_memcache){
            $a=1;
        }else{
            $kueri=mysql_query('SELECT id,unit_kompetensi FROM unit_kompetensi');
            $array=array();
            while($rows=mysql_fetch_object($kueri)){
            array_push($array,$rows);
            }   
            $memcache->set($key, $array);    
        }
     */
     
        
	$result = array();
	$where = "lsp.rlsp_nama  like '%$ib%' AND skema.skema like '%$ia%' AND skema.id_lsp='".cek_id_lsp()."'";
	$rs = mysql_query("select count(*) FROM skema
        JOIN lsp ON lsp.id=skema.id_lsp WHERE ".$where);
	$row = mysql_fetch_row($rs);
	$result["total"] = $row[0];
	if($result["total"]==0){
        $row2[] =	array("kode"=>"No Record");
        $result["rows"] = $row2;
        echo json_encode($result); 
	}else{
        $rs = mysql_query("SELECT skema.*,lsp.rlsp_nama FROM skema
        JOIN lsp ON lsp.id=skema.id_lsp
         WHERE ".$where." ORDER BY id ASC limit $offset,$rows");
        $row2=array();
        while($record = mysql_fetch_object($rs)){
        $record->kode=$record->id;
            unset($record->id);
    	   array_push($row2,$record); 
    	}
        $result["rows"] = $row2;
    
        echo json_encode($result);   
	}
?>