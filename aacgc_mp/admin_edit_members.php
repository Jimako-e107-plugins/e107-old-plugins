<?php

/*
#######################################
#     AACGC Meeting Planner           #                
#     by M@CH!N3                      #
#     http://www.AACGC.com            #
#######################################
*/

require_once("../../class2.php");
if(!getperms("P")) {
echo "";
exit;
}
require_once(e_ADMIN."auth.php");
require_once(e_HANDLER."form_handler.php"); 
require_once(e_HANDLER."file_class.php");
$rs = new form;
$fl = new e_file;
if (e_QUERY) {
        $tmp = explode('.', e_QUERY);
        $action = $tmp[0];
        $id = $tmp[1];
        unset($tmp);
}
include_lan(e_PLUGIN."aacgc_mp/languages/".e_LANGUAGE.".php");
//-----------------------------------------------------------------------------------------------------------+
if (isset($_POST['update_user'])) {
        $message = ($sql->db_Update("aacgc_mp_members", "user_id='".$_POST['user_id']."',user_meet='".$_POST['user_meet']."',user_choice='".$_POST['user_choice']."',user_det='".$_POST['user_det']."' WHERE id='".$_POST['id']."' ")) ? "".AMP_24."" : "".AMP_25."";
}

if (isset($_POST['main_delete'])) {
        $delete_id = array_keys($_POST['main_delete']);
	$sql2 = new db;
    	$sql2->db_Delete("aacgc_mp_members", "id='".$delete_id[0]."'");
	
}

if (isset($message)) {
        $ns->tablerender("", "<div style='text-align:center'><b>".$message."</b></div>");
}
//-----------------------------------------------------------------------------------------------------------+

if ($action == "") {


        $text .= $rs->form_open("post", e_SELF, "myform_".$row['id']."", "", "");
        $text .= "
        <div style='text-align:center'>
        <table style='width:95%' class='fborder' cellspacing='0' cellpadding='0'>
        <tr>
        <td style='width:0%' class='forumheader3'>".AMP_79."</td>
        <td style='width:20%' class='forumheader3'>".AMP_80."</td>
        <td style='width:30%' class='forumheader3'>".AMP_81."</td>
        <td style='width:0%' class='forumheader3'>".AMP_82."</td>
        <td style='width:50%' class='forumheader3'>".AMP_83."</td>
        <td style='width:0%' class='forumheader3'>".AMP_84."</td>
       </tr>";

        $sql->db_Select("aacgc_mp_members", "*", "ORDER BY user_meet ASC","");
        while($row = $sql->db_Fetch()){
        $sql2 = new db;
        $sql2->db_Select("user", "*", "user_id='".$row['user_id']."'");
        $row2 = $sql2->db_Fetch();
        $sql3 = new db;
        $sql3->db_Select("aacgc_mp_meetings", "*", "meet_id='".$row['user_meet']."'");
        $row3 = $sql3->db_Fetch();

	if ($row['user_choice'] == "1"){$choice = "".MP_24."";}
	if ($row['user_choice'] == "2"){$choice = "".MP_25."";}
	if ($row['user_choice'] == "3"){$choice = "".MP_26."";}

        $text .= "
        <tr>
        <td style='width:' class='forumheader3' name='id' >".$row['id']."</td>
        <td style='width:' class='forumheader3' name='user_id'>".$row2['user_name']."</td>
        <td style='width:' class='forumheader3' name='user_meet'>".$row3['meet_title']."</td>
        <td style='width:' class='forumheader3' name='user_choice'>".$choice."</td>
        <td style='width:' class='forumheader3' name='user_det'>".$row['user_det']."</td>
        <td style='width:' class='forumheader3'>";
        
$text .= "<a href='".e_SELF."?edit.{$row['id']}'>".ADMIN_EDIT_ICON."</a>";
$text .= "<input type='image' title='".LAN_DELETE."' name='main_delete[".$row['id']."]' src='".ADMIN_DELETE_ICON_PATH."' onclick=\"return jsconfirm('".LAN_CONFIRMDEL." [ID: {$row['id']} ]')\"/>
                </td>
        </tr>";
		}
        $text .= "
        </table>
        </div>";
        $text .= $rs->form_close();
	      $ns -> tablerender("".AMP_78."", $text);
	      require_once(e_ADMIN."footer.php");
}



//-----------------------------------------------------------------------------------------------------------+



if ($action == "edit")
{
        $sql->db_Select("aacgc_mp_members", "*", "id='".$id."'");
        $row = $sql->db_Fetch();

        $sql2 = new db;
        $sql2->db_Select("user", "*", "user_id='".$row['user_id']."'");
        $row2 = $sql2->db_Fetch();

        $sql3 = new db;
        $sql3->db_Select("aacgc_mp_meetings", "*", "meet_id='".$row['user_meet']."'");
        $row3 = $sql3->db_Fetch();

	if ($row['user_choice'] == "1"){$choice = "".MP_24."";}
	if ($row['user_choice'] == "2"){$choice = "".MP_25."";}
	if ($row['user_choice'] == "3"){$choice = "".MP_26."";}

	$sql4 = new db;
	$sql4->db_Select("aacgc_mp_meetings", "*");
	$rows = $sql4->db_Rows();
	for ($i=0; $i < $rows; $i++) {
	$option = $sql4->db_Fetch();

	$meetid = $option['meet_id'];
	$meettitle = $option['meet_title'];
	$dformat = $pref['aacgcmp_dformat'];
	$msdate = date($dformat, $option['meet_sdate']);
	$medate = date($dformat, $option['meet_edate']);

	$options .= "<option name='user_meet' value='".$meetid."'>(".$meetid.") ".$meettitle." (".$msdate." / ".$medate.") </option>";}


        $width = "width:100%";
        $text .= "
        <div style='text-align:center'>
        ".$rs -> form_open("post", e_SELF, "MyForm", "", "enctype='multipart/form-data'", "")."
        <table style='".$width."' class='fborder' cellspacing='0' cellpadding='0'>
        <tr>
        <td style='width:30%; text-align:right' class='forumheader3'>".AMP_80.":</td>
        <td style='width:70%' class='forumheader3'>
        ".$rs->form_hidden("user_id", "".$row2['user_id']."")." ".$row2['user_name']."
        </td>
        </tr>
        <tr>
        <td style='width:; text-align:right' class='forumheader3'>".AMP_81.":</td>
        <td style='width:' class='forumheader3' colspan=2>
		<select name='user_meet' size='1' class='tbox' style='width:80%'>
                <option name='user_meet' value='".$row3['meet_id']."'>".$row3['meet_title']."</option>
		".$options."
        </td>
        </tr>
        <tr>
        <td style='width:; text-align:right' class='forumheader3'>".AMP_82.":</td>
        <td style='width:' class='forumheader3' colspan=2>
		<select name='user_choice' size='1' class='tbox' style='width:60%'>
                <option name='user_choice' value='".$row['user_choice']."'>".$choice."</option>
                <option name='user_choice' value='1'>".MP_24."</option>
                <option name='user_choice' value='2'>".MP_25."</option>
                <option name='user_choice' value='3'>".MP_26."</option>
        </td>
        </tr>
        <tr>
        <td style='width:30%; text-align:right' class='forumheader3'>".AMP_83.":</td>
        <td style='width:70%' class='forumheader3'>
	<textarea class='tbox' rows='3' cols='75' name='user_det'>".$row['user_det']."</textarea>
        </td>
        </tr>
";



        $text .= "</div>
        </td></tr>
        <tr style='vertical-align:top'>
        <td colspan='2' style='text-align:center' class='forumheader'>
        ".$rs->form_hidden("id", "".$row['id']."")."
        ".$rs -> form_button("submit", "update_user", "".AMP_85."")."
        </td>
        </tr>
        </table>
        ".$rs -> form_close()."
        </div>";
	      $ns -> tablerender("", $text);
	      require_once(e_ADMIN."footer.php");
}
?>



