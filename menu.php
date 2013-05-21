<?php
$sid=$_SESSION['id'];
 $kueri_user=mysql_fetch_array(mysql_query("SELECT * FROM users WHERE id=$sid"));

?>
<div style="padding:5px;border:1px solid #ddd">
		<a href="index.php" class="easyui-linkbutton" data-options="plain:true,iconCls:'icon-home'">Home</a>
<?php
    if($kueri_user['id_group_users']==1 || $kueri_user['id_group_users']==15){
    $kueri_module=mysql_query("SELECT * FROM module ORDER BY no_urut");
    }else{
    $kueri_module=mysql_query("SELECT * FROM module WHERE id_group_users=2 ORDER BY no_urut");
    }
    $no_module=1;
    while($array_module=mysql_fetch_array($kueri_module)){
        echo"<a href='#' class=easyui-menubutton data-options=menu:'#mm$no_module',iconCls:'icon-grid'>$array_module[module]</a>";
        echo"<div id='mm$no_module' style='width:150px;'>";
        if($kueri_user['id_group_users']==1){
            $kueri_menu=mysql_query("SELECT * FROM menu WHERE id_module=$array_module[id] ORDER BY no_urut");
        }else{
        $kueri_menu=mysql_query("SELECT * FROM menu WHERE id_module=$array_module[id] AND id_group_users=$kueri_user[id_group_users] ORDER BY no_urut");    
        }
        
        while($array_menu=mysql_fetch_array($kueri_menu)){
            echo'<div data-options='."iconCls:'".$array_menu['icon_tag']."'".' id="'.$array_menu['id_tag'].'" class="'.$array_menu['class_tag'].'">'.$array_menu['nm_menu'].'</div>';
            }
        echo"</div>";                
        $no_module++;
    }
?>
		
        	<a href="logout.php" class="easyui-linkbutton" data-options="plain:true,iconCls:'icon-off'"><?php echo $kueri_user['users'] ?> / Logout</a>
 </div>
 