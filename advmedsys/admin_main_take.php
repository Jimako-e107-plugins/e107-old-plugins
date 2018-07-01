<?php

/*
#######################################
#     e107 website system plguin     	 #
#     Advanced Medal System V1.2     	 #
#     by Marc Peppler                 	#
#     http://www.marc-peppler.at 	#
#     mail@marc-peppler.at            	#
#    Updated version 1.3, 1.4, 1.42 by garyt  #
#######################################
*/
require_once("../../class2.php");
if(!getperms("P")) {
echo AMS_ADMIN_S1;
exit;
}
require_once(e_ADMIN."auth.php");
require_once(e_HANDLER."form_handler.php"); 
require_once(e_HANDLER."file_class.php");
$lan_file = e_PLUGIN."advmedsys/languages/Admin/".e_LANGUAGE.".php";
require_once(file_exists($lan_file) ? $lan_file :  e_PLUGIN."advmedsys/languages/Admin/English.php");
require_once(e_PLUGIN."advmedsys/advmedsys_ver.php");

	$pageid = "admin_menu_05";

$rs = new form;
$selecteduserid = $_POST['user_sel_id'];
function getmedcount($medcuid) {
	$mcount = 0;
    $sql0000001 = new db;
    $sql0000001->db_Select("advmedsys_awarded","*", "WHERE awarded_user_id='".$medcuid."'", "");
    while($row0000001 = $sql0000001->db_Fetch()) {
        $mcount++;
	}
    return $mcount;
}
//-----------------------------------------------------------------------------------------------------------+
if (isset($_POST['medal_delete'])) {
        $delete_id = array_keys($_POST['medal_delete']);
        $message = ($sql->db_Delete("advmedsys_awarded", "awarded_id ='".$delete_id[0]."' ")) ? AMS_ADMIN_S23 : AMS_ADMIN_S24 ;
}
if (isset($message)) {
        $ns->tablerender("", "<div style='text-align:center'><b>".$message."</b></div>");
}
//-----------------------------------------------------------------------------------------------------------+
//-----------------------------------------------------------------------------------------------------------+
$text ="
<form method='POST' action='admin_main_take.php'>
<br>
<center>
<div style='width:100%'>
<table style='width:60%' class='fborder' cellspacing='0' cellpadding='0'>
	<tr>
		<td style='width:30%; text-align:right' class='forumheader3'>".AMS_ADMIN_S2.":</td>
		<td style='width:70%' class='forumheader3'>
		<select name='user_sel_id' size='1' class='tbox' style='width:100%'>";
	        $sql->db_Select("user", "user_id, user_name", "ORDER BY user_name ASC","");
    		    while($row = $sql->db_Fetch()){
    		    $usern = $row[user_name];
    		    $userid = $row[user_id];
    		    $umedc = getmedcount($userid);
    		    If ($umedc > 0) {
    		    if ($userid == $selecteduserid) {
			        $text .= "<option name='user_sel_id' value='".$userid."' selected>".$usern."</option>";
				} else {
			        $text .= "<option name='user_sel_id' value='".$userid."'>".$usern."</option>";					
				}
				}
	        	}
        $text .= "
		</td>
    </tr>
    <tr>
    <td colspan='2' 'style='width:70%' class='forumheader3'>
        <input type='hidden' name='medaltake' value='1'>
		<center><input class='button' type='submit' value='".AMS_ADMIN_S3."'></center>
	</td>
	</tr>
</table>
</div>
</center>
<br>
</form>
<br>
";
//-----------------------------------------------------------------------------------------------------------+
//-----------------------------------------------------------------------------------------------------------+
If ($_POST['medaltake'] == "1") {
$text .= "	
<form method='POST' action='admin_main_take.php'>

<div style='text-align:center'>
<table style='width:90%' class='fborder' cellspacing='0' cellpadding='0'>
        <tr>
        <td style='width:50px' class='forumheader3'>".AMS_ADMIN_S12."</td>
        <td style='width:80px' class='forumheader3'>".AMS_ADMIN_S5."</td>
        <td style='width:25%' class='forumheader3'>".AMS_ADMIN_S6."</td>
        <td style='width:35%' class='forumheader3'>".AMS_ADMIN_S17."</td>
        <td style='width:40%' class='forumheader3'>".AMS_ADMIN_S8."</td>
        <td style='width:50px' class='forumheader3'>".AMS_ADMIN_S18."</td>
        </tr>";
        $sql->db_Select("advmedsys_awarded", "*", "WHERE awarded_user_id = '".$selecteduserid."'" , "ORDER BY awarded_date DESC" ,false);
        while($row = $sql->db_Fetch()){
        $sql2->db_Select("advmedsys_medals", "*", "WHERE medal_id = '".$row['awarded_medal_id']."'","");
        $row2 = $sql2->db_Fetch();
        $text .= "
        <tr>
        <td style='width:50px' class='forumheader3'>".$row['awarded_id']."</td>
        <td style='width:80px' class='forumheader3'><center><img src='medalimg/".$row2['medal_pic']."' alt=''></img></center></td>
        <td style='width:25%' class='forumheader3'>".$row2['medal_name']."</td>";
        $sql2->db_Select("user", "*", "WHERE user_id = '".$row['awarded_user_id']."'","");
        $row2 = $sql2->db_Fetch();
        $text .= "
        <td style='width:35%' class='forumheader3'>".$row2['user_name']."</td>
        <td style='width:40%' class='forumheader3'>".$row['awarded_date']."</td>
        <td style='width:50px; text-align:center; white-space: nowrap' class='forumheader3'>
		<input type='image' title='".LAN_DELETE."' name='medal_delete[".$row['awarded_id']."]' src='".ADMIN_DELETE_ICON_PATH."' onclick=\"return jsconfirm('".LAN_CONFIRMDEL." [ID: {$row['awarded_id']} ]')\"/>
		</td>
        </tr>";
                }
        $text .= "
        </table>
        </div>";
        $text .= $rs->form_close();	
}
	      $ns -> tablerender(AMS_PLGIN_S1." v".AMS_VER_S1.": ".AMS_ADMIN_S18, $text);
	      require_once(e_ADMIN."footer.php");
?>
