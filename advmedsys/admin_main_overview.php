<?php

/*
#######################################
#     e107 website system plguin     	 #
#     Advanced Medal System V1.2     	 #
#     by Marc Peppler                 	#
#     http://www.marc-peppler.at 	#
#     mail@marc-peppler.at            	#
#    Updated version 1.3, 1.4, 1.41 by garyt  #
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

	$pageid = "admin_menu_02";

$rs = new form;
$fl = new e_file;
if (e_QUERY) {
        $tmp = explode('.', e_QUERY);
        $action = $tmp[0];
        $id = $tmp[1];
        unset($tmp);
}
//-----------------------------------------------------------------------------------------------------------+
if (isset($_POST['update_medal'])) {
        $message = ($sql->db_Update("advmedsys_medals", "medal_pic ='".$_POST['medal_pic']."',medal_name ='".$_POST['medal_name']."', medal_txt ='".$_POST['medal_txt']."' WHERE medal_id='".$_POST['id']."' ")) ? AMS_ADMIN_S21 : AMS_ADMIN_S22;
}

if (isset($_POST['main_delete'])) {
        $delete_id = array_keys($_POST['main_delete']);
	$sql2 = new db;
    $sql2->db_Delete("advmedsys_medals", "medal_id='".$delete_id[0]."'");
	$sql = new db;
	$sql->db_Delete("advmedsys_awarded", "awarded_medal_id='".$delete_id[0]."'");
}

if (isset($message)) {
        $ns->tablerender("", "<div style='text-align:center'><b>".$message."</b></div>");
}
//-----------------------------------------------------------------------------------------------------------+
if ($action == "") {
        $width = "width:100%";
        $text .= $rs->form_open("post", e_SELF, "myform_".$row['medal_id']."", "", "");
        $text .= "
        <div style='text-align:center'>
        <table style='".$width."' class='fborder' cellspacing='0' cellpadding='0'>
        <tr>
        <td style='width:50px' class='forumheader3'>".AMS_ADMIN_S12."</td>
        <td style='width:80px' class='forumheader3'>".AMS_ADMIN_S5."</td>
        <td style='width:35%' class='forumheader3'>".AMS_ADMIN_S6."</td>
        <td style='width:65%' class='forumheader3'>".AMS_ADMIN_S7."</td>
        <td style='width:50px' class='forumheader3'>".AMS_ADMIM_S9."</td>
        </tr>";
        $sql->db_Select("advmedsys_medals", "*", "ORDER BY medal_name ASC","");
        while($row = $sql->db_Fetch()){
        $text .= "
        <tr>
        <td style='width:50px' class='forumheader3'>".$row['medal_id']."</td>
        <td style='width:80px' class='forumheader3'><center><img src='medalimg/".$row['medal_pic']."' alt=''></img></center></td>
        <td style='width:35%' class='forumheader3'>".$row['medal_name']."</td>
		<td style='width:65%' class='forumheader3'>".$row['medal_txt']."</td>
        <td style='width:50px; text-align:center; white-space: nowrap' class='forumheader3'>
        
		<a href='".e_SELF."?edit.{$row['medal_id']}'>".ADMIN_EDIT_ICON."</a>
		<input type='image' title='".LAN_DELETE."' name='main_delete[".$row['medal_id']."]' src='".ADMIN_DELETE_ICON_PATH."' onclick=\"return jsconfirm('".LAN_CONFIRMDEL." [ID: {$row['medal_id']} ]')\"/>
		</td>
        </tr>";
		}
        $text .= "
        </table>
        </div>";
        $text .= $rs->form_close();
	      $ns -> tablerender(AMS_PLGIN_S1." v".AMS_VER_S1.": ".AMS_ADMIM_S6, $text);
	      require_once(e_ADMIN."footer.php");
}
//-----------------------------------------------------------------------------------------------------------+

//-----------------------------------------------------------------------------------------------------------+

if ($action == "edit")
{
                $sql->db_Select("advmedsys_medals", "medal_id, medal_name, medal_txt, medal_pic", "medal_id = $id");
                $row = $sql->db_Fetch();
        $width = "width:100%";
        $text = "
        <div style='text-align:center'>
        ".$rs -> form_open("post", e_SELF, "MyForm", "", "enctype='multipart/form-data'", "")."
        <table style='".$width."' class='fborder' cellspacing='0' cellpadding='0'>
        <tr>
        <td style='width:30%; text-align:right' class='forumheader3'>".AMS_ADMIN_S6.":</td>
        <td style='width:70%' class='forumheader3'>
            ".$rs -> form_text("medal_name", 60, $row['medal_name'], 100)."
        </td>
        </tr>
        <tr>
        <td style='width:30%; text-align:right' class='forumheader3'>".AMS_ADMIN_S7.":</td>
        <td style='width:70%' class='forumheader3'>
            ".$rs -> form_textarea("medal_txt", '59', '3', $row['medal_txt'], "", "", "", "", "")."
        </td>
        </tr>";

        $rejectlist = array('$.','$..','/','CVS','thumbs.db','Thumbs.db','*._$', 'index', 'null*', 'blank*');
        $iconpath = e_PLUGIN."advmedsys/medalimg/";
        $iconlist = $fl->get_files($iconpath,"",$rejectlist);

        $text .= "
        <tr>
        <td style='width:30%; text-align:right' class='forumheader3'>".AMS_ADMIN_S5.":</td>
        <td style='width:70%' class='forumheader3'>
            ".$rs -> form_text("medal_pic", 60, $row['medal_pic'], 100)."
            ".$rs -> form_button("button", '', AMS_ADMIN_S3, "onclick=\"expandit('plcico')\"")."
            <div id='plcico' style='{head}; display:none'>";
            foreach($iconlist as $icon){
                $text .= "<a href=\"javascript:insertext('".$icon['fname']."','medal_pic','plcico')\"><img src='".$icon['path'].$icon['fname']."' style='border:0' alt='' /></a> ";
            }
            $text .= "</div>
        </td></tr>
        <tr style='vertical-align:top'>
        <td colspan='2' style='text-align:center' class='forumheader'>
        ".$rs->form_hidden("id", "".$row['medal_id']."")."
        ".$rs -> form_button("submit", "update_medal", AMS_ADMIN_S16, "", "", "")."
        </td>
        </tr>
        </table>
        ".$rs -> form_close()."
        </div>";
	      $ns -> tablerender(AMS_PLGIN_S1." v".AMS_VER_S1.": ".AMS_ADMIN_S16, $text);
	      require_once(e_ADMIN."footer.php");
}
?>
