<?php

/*
#######################################
#     e107 website system plguin      #
#     AACGC Game List                 #
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
//-------------------------# BB Code Support #----------------------------------------------

include(e_HANDLER."ren_help.php");

//------------------------------------------------------------------------------------------
//-----------# Icon Path #---------------+
if($pref['gamelist_adminiconpath'] == "")
{$adminiconpath = "icons";}
else
{$adminiconpath = "".$pref['gamelist_adminiconpath']."";}
//---------------------------------------+

//-----------------------------------------------------------------------------------------------------------+
if (isset($_POST['update_game'])) {
        $message = ($sql->db_Update("aacgc_gamelist", "game_name='".$tp->toDB($_POST['game_name'])."', game_pic='".$_POST['game_pic']."', game_cat='".$_POST['game_cat']."', game_text='".$tp->toDB($_POST['game_text'])."', linka='".$tp->toDB($_POST['linka'])."', linkaname='".$tp->toDB($_POST['linkaname'])."', linkb='".$tp->toDB($_POST['linkb'])."', linkbname='".$tp->toDB($_POST['linkbname'])."', linkc='".$tp->toDB($_POST['linkc'])."', linkcname='".$tp->toDB($_POST['linkcname'])."', video='".$tp->toDB($_POST['video'])."' WHERE game_id='".$_POST['id']."' ")) ? "Successful updated" : "Update failed";
}

if (isset($_POST['main_delete'])) {
        $delete_id = array_keys($_POST['main_delete']);
	$sql2 = new db;
    $sql2->db_Delete("aacgc_gamelist", "game_id='".$delete_id[0]."'");
	
}

if (isset($message)) {
        $ns->tablerender("", "<div style='text-align:center'><b>".$message."</b></div>");
}
//-----------------------------------------------------------------------------------------------------------+
if ($action == "") {



        $text .= $rs->form_open("post", e_SELF, "myform_".$row['game_id']."", "", "");
        $text .= "
        <div style='text-align:center'>
        <table style='width:95%' class='fborder' cellspacing='0' cellpadding='0'>
        <tr>
        <td style='width:0%' class='forumheader3'>Game ID</td>
        <td style='width:0%' class='forumheader3'>Game Name / Icon</td>
        <td style='width:25%' class='forumheader3'>Game Category</td>
        <td style='width:75%' class='forumheader3'>Game Details</td>
        <td style='width:0%' class='forumheader3'>Options</td>
       </tr>";
        $sql->db_Select("aacgc_gamelist", "*", "ORDER BY game_name ASC","");
        while($row = $sql->db_Fetch()){
        $sql2 = new db;
        $sql2->db_Select("aacgc_gamelist_cat", "*", "WHERE cat_id=".$row['game_cat']."","");
        $row2 = $sql2->db_Fetch();
        $text .= "
        <tr>
        <td style='width:' class='forumheader3'>".$row['game_id']."</td>
        <td style='width:' class='forumheader3'>".$row['game_name']."<br><img width='100px' src='".$adminiconpath."/".$row['game_pic']."'></img></td>
        <td style='width:' class='forumheader3'>".$row2['cat_name']."</td>
        <td style='width:' class='forumheader3'>".substr($row['game_text'], 0, 200)."</td>
        <td style='width:' class='forumheader3'>
        
		<a href='".e_SELF."?edit.{$row['game_id']}'>".ADMIN_EDIT_ICON."</a>
		<input type='image' title='".LAN_DELETE."' name='main_delete[".$row['game_id']."]' src='".ADMIN_DELETE_ICON_PATH."' onclick=\"return jsconfirm('".LAN_CONFIRMDEL." [ID: {$row['game_id']} ]')\"/>
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
$sql->db_Select("aacgc_gamelist", "*", "game_id = $id");
$row = $sql->db_Fetch();

$sql2 = new db;
$sql2->db_Select("aacgc_gamelist_cat", "*", "WHERE cat_id=".$row['game_cat']."","");
$row2 = $sql2->db_Fetch();

$sql3 = new db;
$sql3->db_Select("aacgc_gamelist_cat", "*");
$rows = $sql3->db_Rows();
for ($i=0; $i < $rows; $i++) {
$option = $sql3->db_Fetch();
$options .= "<option name='game_cat' value='".$option['cat_id']."'>".$option['cat_name']."</option>";}






        $text = "
        <div style='text-align:center'>
        ".$rs -> form_open("post", e_SELF, "MyForm", "", "enctype='multipart/form-data'", "")."
        <table style='width:100%' class='fborder' cellspacing='0' cellpadding='0'>
        <tr>
        <td style='width:20%; text-align:right' class='forumheader3'>Game Name:</td>
        <td style='width:80%' class='forumheader3' colspan=2>
            ".$rs -> form_text("game_name", 100, $row['game_name'], 500)."
        </td>
        </tr>
       <tr>
        <td style='width:; text-align:right' class='forumheader3'>Category:</td>
        <td style='width:' class='forumheader3' colspan=2>
		<select name='game_cat' size='1' class='tbox' style='width:60%'>
                <option name='game_cat' value='".$row['game_cat']."'>".$row2['cat_name']."</option>
		".$options."
        </td>
        </tr>";

        $rejectlist = array('$.','$..','/','CVS','thumbs.db','Thumbs.db','*._$', 'index', 'null*', 'blank*');
        $iconpath = e_PLUGIN."aacgc_gamelist/".$adminiconpath."/";
        $iconlist = $fl->get_files($iconpath,"",$rejectlist);

        $text .= "
        <tr>
        <td style='width:; text-align:right' class='forumheader3'>Game Icons:</td>
        <td style='width:' class='forumheader3' colspan=2>
        ".$rs -> form_text("game_pic", 50, $row['game_pic'], 100)."
        ".$rs -> form_button("button", '', "Show Icons", "onclick=\"expandit('plcico')\"")."
            <div id='plcico' style='{head}; display:none'>";
            foreach($iconlist as $icon){
            $text .= "<a href=\"javascript:insertext('".$icon['fname']."','game_pic','plcico')\"><img width='100px' src='".$icon['path'].$icon['fname']."' style='border:0' alt='' /></a> ";
            }



        $text .= "</div>
        </td></tr>
        <tr>
        <td style='width:; text-align:right' class='forumheader3'>Game Details:</td>
        <td style='width:' class='forumheader3' colspan=2>
	    <textarea class='tbox' rows='25' cols='100' name='game_text' onselect='storeCaret(this);' onclick='storeCaret(this);' onkeyup='storeCaret(this);'>".$row['game_text']."</textarea><br>";

        $text .= display_help('helpb', 'forum');

        $text .= "
        </td>
        </tr>




        <tr>
        <td style='width:; text-align:right' class='forumheader3'>Link 1:</td>
        <td style='width:' class='forumheader3'>Name:
            ".$rs -> form_text("linkaname", 25, $row['linkaname'], 500)."
        </td>
        <td style='width:' class='forumheader3'>Link:
            ".$rs -> form_text("linka", 75, $row['linka'], 500)."
        </td>
        </tr>





        <tr>
        <td style='width:; text-align:right' class='forumheader3'>Link 2:</td>
        <td style='width:' class='forumheader3'>Name:
            ".$rs -> form_text("linkbname", 25, $row['linkbname'], 500)."
        </td>
        <td style='width:' class='forumheader3'>Link:
            ".$rs -> form_text("linkb", 75, $row['linkb'], 500)."
        </td>
        </tr>






        <tr>
        <td style='width:; text-align:right' class='forumheader3'>Link 3:</td>
        <td style='width:' class='forumheader3'>Name:
            ".$rs -> form_text("linkcname", 25, $row['linkcname'], 500)."
        </td>
        <td style='width:' class='forumheader3'>Link:
            ".$rs -> form_text("linkc", 75, $row['linkc'], 500)."
        </td>
        </tr>






        <tr>
        <td style='width:; text-align:right' class='forumheader3'>Video Code (YouTube or other):</td>
        <td style='width:' class='forumheader3' colspan=2>
            ".$rs -> form_textarea("video", '100', '10', $row['video'], "", "", "", "", "")."
        </td>
        </tr>

        <tr style='vertical-align:top'>
        <td colspan='3' style='text-align:center' class='forumheader'>
        ".$rs->form_hidden("id", "".$row['game_id']."")."
        ".$rs -> form_button("submit", "update_game", "Update")."
        </td>
        </tr>


        </table>
        ".$rs -> form_close()."
        </div>";
	      $ns -> tablerender("", $text);
	      require_once(e_ADMIN."footer.php");
}
?>

