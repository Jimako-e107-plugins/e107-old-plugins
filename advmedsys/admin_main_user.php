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
if(!getperms("P")){ 
header("location:".e_BASE."index.php");
exit;
}
require_once(e_ADMIN."auth.php");
require_once(e_HANDLER."form_handler.php"); 
require_once(e_HANDLER."file_class.php");
$lan_file = e_PLUGIN."advmedsys/languages/Admin/".e_LANGUAGE.".php";
require_once(file_exists($lan_file) ? $lan_file :  e_PLUGIN."advmedsys/languages/Admin/English.php");
require_once(e_PLUGIN."advmedsys/advmedsys_ver.php");

	$pageid = "admin_menu_06";

$rs = new form;
        $width = "width:60%";
        $txt = "
        <div style='text-align:center'>
        ".$rs -> form_open("post", e_SELF, "MyForm", "", "enctype='multipart/form-data'", "")."
        <br>
		<table style='".$width."' class='fborder' cellspacing='0' cellpadding='0'>
        <tr>
        <td style='width:30%; text-align:right' class='forumheader3'>".AMS_ADMIN_S2.":</td>
        <td style='width:70%' class='forumheader3'>";
        $sql->db_Select("user", "user_id, user_name", "ORDER BY user_name ASC", "");
        $txt .= $rs->form_select_open("mouser_form");
        while($row = $sql->db_Fetch()){
        $txt .= $rs->form_option( $row['user_name'], "", $row['user_id']);
        }
        $txt .= $rs->form_select_close();
        $txt .= "</td>
        </tr>
        <tr style='vertical-align:top'>
        <td colspan='2' style='text-align:center' class='forumheader'>";
        $txt .= $rs -> form_button("submit", "showit", AMS_ADMIN_S3, "", "", "");
        $txt .= "</td>
        </tr>
        </table>
        ".$rs -> form_close()."
        </div>";
        $ns -> tablerender(AMS_PLGIN_S1." v".AMS_VER_S1.": ".AMS_ADMIM_S2, $txt);
//--------------------------------------------------------------------
//--------------------------------------------------------------------
if(isset($_POST['showit'])){
$width = "width:100%";
           $text .= "
        <div style='text-align:center'>
        <table style='".$width."' class='fborder' cellspacing='0' cellpadding='0'>
        <tr>
        <td style='width:80px' class='forumheader3'>".AMS_ADMIN_S5."</td>
        <td style='width:60%' class='forumheader3'>".AMS_ADMIN_S6."</td>
        <td style='width:40%' class='forumheader3'>".AMS_ADMIN_S8."</td>
        </tr>";

	$sql->db_Select("advmedsys_awarded", "*", "WHERE awarded_user_id like ".$_POST['mouser_form'], "ORDER BY awarded_date DESC", false);
	while($row = $sql->db_Fetch()){
	$sql2->db_Select("advmedsys_medals", "*", "medal_id like ".$row['awarded_medal_id'], true);
	$row2 = $sql2->db_Fetch();
        $text .= "
        <tr>
	<td style='width:80px' class='forumheader3'><img src='medalimg/".$row2['medal_pic']."' alt = ''></img></td>
        <td style='width:60%' class='forumheader3'>".$row2['medal_name']."</td>
        <td style='width:40%' class='forumheader3'>".$row['awarded_date']."</td>
        </tr>";
}
 	$text .="</table></div>";
	$sql->db_Select("user", "*", "user_id like ".$_POST['mouser_form'], true);
	$row3 = $sql->db_Fetch();
	      $ns -> tablerender(AMS_PLGIN_S1." v".AMS_VER_S1.": ".AMS_ADMIN_S4.$row3['user_name'], $text);
	}
require_once(e_ADMIN."footer.php");
?>