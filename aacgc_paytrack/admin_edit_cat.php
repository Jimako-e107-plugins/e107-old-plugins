<?php

/*
#######################################
#     e107 website system plguin      #
#     AACGC Payment Tracker           #
#     by M@CH!N3                      #
#     http://www.aacgc.com            #
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

include_lan(e_PLUGIN."aacgc_paytrack/languages/".e_LANGUAGE.".php");
//-------------------------# BB Code Support #----------------------------------------------

include(e_HANDLER."ren_help.php");

//------------------------------------------------------------------------------------------

//-----------------------------------------------------------------------------------------------------------+
if (isset($_POST['update_cat'])) {
        $message = ($sql->db_Update("aacgc_paytrack_cat", "cat_title='".$tp->toDB($_POST['cat_title'])."', cat_det='".$tp->toDB($_POST['cat_det'])."', cat_order='".$tp->toDB($_POST['cat_order'])."' WHERE cat_id='".$_POST['id']."' ")) ? "".APT_24."" : "".APT_25."";
}

if (isset($_POST['main_delete'])) {
        $delete_id = array_keys($_POST['main_delete']);
	$sql2 = new db;
    $sql2->db_Delete("aacgc_paytrack_cat", "cat_id='".$delete_id[0]."'");
	
}

if (isset($message)) {
        $ns->tablerender("", "<div style='text-align:center'><b>".$message."</b></div>");
}
//-----------------------------------------------------------------------------------------------------------+
if ($action == "") {
        $text .= $rs->form_open("post", e_SELF, "myform_catedit", "", "");
        $text .= "
        <div style='text-align:center'>
        <table style='width:100%' class='fborder' cellspacing='0' cellpadding='0'>
        <tr>
        <td style='width:0%' class='forumheader3'>".APT_39."</td>
        <td style='width:25%' class='forumheader3'>".APT_35."</td>
        <td style='width:75%' class='forumheader3'>".APT_36."</td>
        <td style='width:0%' class='forumheader3'>".APT_37."</td>
        <td style='width:0%' class='forumheader3'>".APT_30."</td>
       </tr>";
        $sql->db_Select("aacgc_paytrack_cat", "*", "ORDER BY cat_order ASC","");
        while($row = $sql->db_Fetch()){
        $text .= "
        <tr>
        <td style='width:' class='forumheader3'>".$row['cat_id']."</td>
        <td style='width:' class='forumheader3'>".$row['cat_title']."</td>
        <td style='width:' class='forumheader3'>".$row['cat_det']."</td>
        <td style='width:' class='forumheader3'>".$row['cat_order']."</td>
        <td style='width:' class='forumheader3'>
        
		<a href='".e_SELF."?edit.{$row['cat_id']}'>".ADMIN_EDIT_ICON."</a>
		<input type='image' title='".LAN_DELETE."' name='main_delete[".$row['cat_id']."]' src='".ADMIN_DELETE_ICON_PATH."' onclick=\"return jsconfirm('".LAN_CONFIRMDEL." [ID: {$row['cat_id']} ]')\"/>
		</td>
        </tr>";
		}
        $text .= "
        </table>
        </div>";
        $text .= $rs->form_close();
	      $ns -> tablerender("", $text);
	      require_once(e_ADMIN."footer.php");
}
//-----------------------------------------------------------------------------------------------------------+

//-----------------------------------------------------------------------------------------------------------+

if ($action == "edit")
{
                $sql->db_Select("aacgc_paytrack_cat", "*", "cat_id = $id");
                $row = $sql->db_Fetch();

$sql2 = new db;
$sql2->db_Select("aacgc_paytrack_cat", "*");
$rows = $sql2->db_Rows();
for ($i=0; $i < $rows; $i++) {
$option = $sql2->db_Fetch();
$n++;
$options .= "<option name='cat_order' value='".$n."'>".$n."</option>";}
$next = $n + 1;

        $width = "width:100%";
        $text = "
        <div style='text-align:center'>
        ".$rs -> form_open("post", e_SELF, "MyForm", "", "enctype='multipart/form-data'", "")."
        <table style='".$width."' class='fborder' cellspacing='0' cellpadding='0'>
        <tr>
        <td style='width:30%; text-align:right' class='forumheader3'>".APT_35.":</td>
        <td style='width:70%' class='forumheader3'>
            ".$rs -> form_text("cat_title", 100, $row['cat_title'], 500)."
        </td>
        </tr>
        <tr>
        <td style='width:; text-align:right' class='forumheader3'>".APT_36.":</td>
        <td style='width:' class='forumheader3' colspan=2>
	    <textarea class='tbox' rows='25' cols='100' name='cat_det' onselect='storeCaret(this);' onclick='storeCaret(this);' onkeyup='storeCaret(this);'>".$row['cat_det']."</textarea><br>";

        $text .= display_help('helpb', 'forum');

        $text .= "
        </td>
        </tr>
	<tr>
        <td style='width:30%; text-align:right' class='forumheader3'>".APT_37.":</td>
        <td style='width:70%' class='forumheader3'>
	<select name='cat_order' size='1' class='tbox' style='width:20%'>
	<option name='cat_order' value='".$row['cat_order']."'>".$row['cat_order']."</option>
        ".$options."
	<option name='cat_order' value='".$next."'>".$next."</option>
        </td>
        </tr>

";

        $text .= "</div>
        </td></tr>
        <tr style='vertical-align:top'>
        <td colspan='2' style='text-align:center' class='forumheader'>
        ".$rs->form_hidden("id", "".$row['cat_id']."")."
        ".$rs -> form_button("submit", "update_cat", "".APT_44."")."
        </td>
        </tr>
        </table>
        ".$rs -> form_close()."
        </div>";
	      $ns -> tablerender("AACGC Payment Tracker (".APT_43.")", $text);
	      require_once(e_ADMIN."footer.php");
}
?>


