<?php
  // require_once("/home/k4475946/public_html/sertifikasi/config/database.php");
    require_once("C:/xampp/htdocs/sertifikasi/config/database.php");
	define('_URL_BASE_','sertifikasi');
	function checkIsLogin(){
		if(isset($_SESSION[md5('isLogin')])){
			return true;	
		}else{
			return false;	
		}
	}
    function cek_group(){
        //session_start();
        $id_session=$_SESSION['id'];
        $kueri=mysql_fetch_array(mysql_query("SELECT id_group_users FROM users WHERE id=$id_session"));
        $group=$kueri['id_group_users'];
        return $group;
    }
    function cek_id_lsp(){
        //session_start();
        $id_session=$_SESSION['id'];
        $kueri=mysql_fetch_array(mysql_query("SELECT id FROM lsp WHERE id_users=$id_session"));
        $id_lsp=$kueri['id'];
        return $id_lsp;
    }
    function cek_email($email){
        $kueri=mysql_query("SELECT email FROM users WHERE email='$email'");
        if(mysql_num_rows($kueri)==0){
            return true;
        }else{
            return false;
        }
    }
	function checkPass($user, $pass) {
		$query = mysql_query("SELECT * FROM users WHERE email='$user' and password=PASSWORD('$pass')");
		if(mysql_num_rows($query) == 1){
			$rec = mysql_fetch_assoc($query);
			return $rec['id'];
		}else{
			return false;	
		}		
	}
	function ajaxRequest() {
		return (isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
   	($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'));	
	}
	
   function isAjax() {
	   if (!ajaxRequest()){
   		header("HTTP/1.1 403 Forbidden");
			die('403.14 - Directory listing denied.');
   	};
	}
	
	function privilegesPage() {
		if(checkIsLogin() === false){
			header("HTTP/1.1 403 Forbidden");
			die('403.14 - Directory listing denied.');
		}
	}
	
	function success($table){
		$data['success'] = 'success';
		$data['msg'] = "Data $table saved";
		echo json_encode($data);	
	}	
	
	function error($msg){
		$data['msg'] = $msg;
		echo json_encode($data);	
	}	
	
	function paging($pages,$rows,$numrows) {
		
	}
    function tgl_indo($tgl){
      $tanggal = substr($tgl,8,2);
      $bulan    = getBulan(substr($tgl,5,2));
      $tahun    = substr($tgl,0,4);
      return $tanggal." ".$bulan." ".$tahun;        
    }    
    function getBulan($bln){
      switch ($bln){
        case 1:
          return "Januari";
          break;
        case 2:
          return "Februari";
          break;
        case 3:
          return "Maret";
          break;
        case 4:
          return "April";
          break;
        case 5:
          return "Mei";
          break;
        case 6:
          return "Juni";
          break;
        case 7:
          return "Juli";
          break;
        case 8:
          return "Agustus";
          break;
        case 9:
          return "September";
          break;
        case 10:
          return "Oktober";
          break;
        case 11:
          return "November";
          break;
        case 12:
          return "Desember";
          break;
    }
}
function tambahWaktu2($jam_mulai,$jam_selesai){
   // echo "Jam Mulai : ".$jam_mulai='08:30:09';
//echo "<br>";
//echo "Jam Selesai : ".$jam_selesai='09:45:01';
//echo "<br>";
    $times = array($jam_mulai,$jam_selesai);
//$times = array('08:30:22','09:45:53');
    $seconds = 0;
    foreach ( $times as $time )
    {
    	list( $g, $i, $s ) = explode( ':', $time );
    	$seconds += $g * 3600;
    	$seconds += $i * 60;
    	$seconds += $s;
                
                
    }
    $hours = floor( $seconds / 3600);
    if($hours<10){
        $hours='0'.$hours;
    }
    
    $seconds -= $hours * 3600;
    $minutes = floor( $seconds / 60);
    if($minutes<10){
        $minutes='0'.$minutes;
    }
    
    $seconds -= $minutes * 60;    
    if($seconds<10){
        $seconds='0'.$seconds;
    } 
    
    $waktu2="{$hours}:{$minutes}:{$seconds}";
    return $waktu2;
    
}
function tambahWaktu($jam_mulai2,$jam_selesai2){
    $times2 = array($jam_mulai2,$jam_selesai2);
//$times = array('08:30:22','09:45:53');
    $frame = 0;
    foreach ( $times2 as $time2 )
    {
    	list( $g, $i, $s, $a ) = explode( ':', $time2 );
    	$frame += $g * 3600 * 25;
    	$frame += $i * 60 * 25;
    	$frame += $s * 25;
        $frame += $a;        
                
    }
    $hours = floor( $frame / 3600 / 25 );
    if($hours<10){
        $hours='0'.$hours;
    }
    
    $frame -= $hours * 3600 * 25;
    $minutes = floor( $frame / 60 / 25 );
    if($minutes<10){
        $minutes='0'.$minutes;
    }
    
    $frame -= $minutes * 60 * 25;
    $seconds=floor( $frame / 25 );    
    if($seconds<10){
        $seconds='0'.$seconds;
    }
    $frame-=$seconds*25;    
    if($frame<10){
        $frame='0'.$frame;
    }
    $waktu2="{$hours}:{$minutes}:{$seconds}:{$frame}";
    return $waktu2;    
}
function selisihFrame($jam1,$jam2) {
	list($h,$m,$s,$n) = explode(":",$jam1);
    $FrameSecond=$s*25;
    $FrameMinute=$m*60*25;
    $FrameJam=$h*60*60*25;
    $FrameFrame=$n;
    //$totalFrame=$FrameJam+$FrameMinute+$FrameSecond+$FrameFrame;
    
    list($h2,$m2,$s2,$n2) = explode(":",$jam2);
    $FrameSecond2=$s2*25;
    $FrameMinute2=$m2*60*25;
    $FrameJam2=$h2*60*60*25;
    $FrameFrame2=$n2;
    //$totalFrame2=$FrameJam2+$FrameMinute2+$FrameSecond2+$FrameFrame2;
    
 //   echo "Hasil penjumlahan : {$hours}:{$minutes}:{$seconds}:{$frame}";
   $a=($FrameJam+$FrameMinute+$FrameSecond+$FrameFrame)-($FrameJam2+$FrameMinute2+$FrameSecond2+$FrameFrame2);
    return $a;
}

function KonversiFrameToTime($frame) {
    
    $hours = floor( $frame / 3600 / 25 );
    if($hours<10){
        $hours='0'.$hours;
    }
    
    $frame -= $hours * 3600 * 25;
    $minutes = floor( $frame / 60 / 25 );
    if($minutes<10){
        $minutes='0'.$minutes;
    }
    
    $frame -= $minutes * 60 * 25;
    $seconds=floor( $frame / 25 );    
    if($seconds<10){
        $seconds='0'.$seconds;
    }
    $frame-=$seconds*25;    
    if($frame<10){
        $frame='0'.$frame;
    }
    $waktu3="{$hours}:{$minutes}:{$seconds}:{$frame}"; 
    return $waktu3;
}
function validasi_frame($input_waktu){
    
    $array_frame=array('00','01','02','03','04','05','06','07','08','09','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24');
    $array_second=array('00','01','02','03','04','05','06','07','08','09','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27','28','29','30','31','32','33','34','35','36','37','38','39','40','41','42','43','44','45','46','47','48','49','50','51','52','53','54','55','56','57','58','59');
    $array_minute=array('00','01','02','03','04','05','06','07','08','09','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27','28','29','30','31','32','33','34','35','36','37','38','39','40','41','42','43','44','45','46','47','48','49','50','51','52','53','54','55','56','57','58','59');
    $array_jam=array('00','01','02','03','04','05','06','07','08','09','10','11','12','13','14','15','16','17','18','19','20','21','22','23');
   // $waktu= '';
    if(strlen($input_waktu) == 11){
        list($h,$m,$s,$f) = explode(":",$input_waktu);
      if (in_array($f, $array_frame) && in_array($s, $array_second) && in_array($m, $array_minute) && in_array($h, $array_jam)) {
        $waktu= $h.':'.$m.':'.$s.':'.$f;
        return $waktu;
        }else{
            return false;
        }   
    }else{
        return false;
    }
     
    
}
?>