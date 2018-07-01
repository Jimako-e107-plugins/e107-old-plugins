<?php

/*
#######################################
#     e107 website system plguin     	 #
#     Advanced Medal System V1.2     	 #
#     by Marc Peppler                 	#
#     http://www.marc-peppler.at 	#
#     mail@marc-peppler.at            	#
#    Updated version 1.3, 1.4 by garyt  #
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

	$pageid = "admin_menu_07";

$rs = new form;
        $width = "width:60%";
        $txt = "
        <div style='text-align:center'>
        ".$rs -> form_open("post", e_SELF, "MyForm", "", "enctype='multipart/form-data'", "")."
		<br>
        <table style='".$width."' class='fborder' cellspacing='0' cellpadding='0'>
        <tr>
        <td style='width:30%; text-align:right' class='forumheader3'>".AMS_ADMIN_S9.":</td>
        <td style='width:70%' class='forumheader3'>";
        $sql->db_Select("advmedsys_medals", "medal_id, medal_name", "ORDER BY medal_name ASC", "");
        $txt .= $rs->form_select_open("momedal_form");
        while($row = $sql->db_Fetch()){
        $txt .= $rs->form_option( $row['medal_name'], "", $row['medal_id']);
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
	      $ns -> tablerender(AMS_PLGIN_S1." v".AMS_VER_S1.": ".AMS_ADMIM_S4, $txt);
//--------------------------------------------------------------------
//--------------------------------------------------------------------
if(isset($_POST['showit'])){
$width = "width:100%";
           $text .= "
        <div style='text-align:center'>
        <table style='".$width."' class='fborder' cellspacing='0' cellpadding='0'>
        <tr>
        <td style='width:80px' class='forumheader3'>".AMS_ADMIN_S5."</td>
        <td style='width:100%' class='forumheader3'>".AMS_ADMIN_S10."</td>
        </tr>";
	$sql->db_Select("advmedsys_medals", "*", "medal_id like ".$_POST['momedal_form'], true);
	$row = $sql->db_Fetch();
        $text .= "
        <tr>
	<td style='width:80px' class='forumheader3'><center><img src='medalimg/".$row['medal_pic']."' alt = ''></img></center></td>
        <td style='width:100%' class='forumheader3'>".$row['medal_name']."<br><br>".$row['medal_txt']."</td>
        </tr>";
 	$text .="</table></div>";
	      $ns -> tablerender($row['medal_name'], $text);
	}
require_once(e_ADMIN."footer.php");
?>