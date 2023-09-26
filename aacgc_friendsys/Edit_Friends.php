<?php

/*
#######################################
#     e107 website system plguin      #
#     AACGC Friend System             #
#     by M@CH!N3                      #
#     http://www.AACGC.com            #
#######################################
*/
require_once("../../class2.php");
require_once(HEADERF);
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

include_lan(e_PLUGIN."aacgc_friendsys/languages/".e_LANGUAGE.".php");

//-----------------------------------------------------------------------------------------------------------+

if (isset($_POST['main_delete'])) {
    $delete_id = array_keys($_POST['main_delete']);
    $sql2 = new db;
    $sql2->db_Delete("aacgc_friend_sys", "user_friends='".intval($delete_id[0])."'");

$text .= "<center><b>".FSYS_09."</b></center><br><br>";}

//-----------------------------------------------------------------------------------------------------------+
if ($action == ""){
if (USER){

        $text .= $rs->form_open("post", e_SELF, "myform_clanapps", "", "");
        $text .= "
        <div style='text-align:center'>
        <table style='width:95%' class='fborder' cellspacing='0' cellpadding='0'>
        <tr>
        <td style='width:100%' class='forumheader3'>".FSYS_10."</td>
        <td style='width:0%' class='forumheader3'>".FSYS_11."</td>
        </tr>";

$sql2->db_Select("aacgc_friend_sys", "*", "user_id='".USERID."'");
while($row2 = $sql2->db_Fetch()){
$sql3 = new db;
$sql3 ->db_Select("user", "*", "user_id='".intval($row2['user_friends'])."'");
$row3 = $sql3->db_Fetch();

if ($pref['fl_enable_gold'] == "1")
{$userorb = "<a href='".e_BASE."user.php?id.".$row3['user_id']."'>".$gold_obj->show_orb($row3['user_id'])."</a>";}
else
{$userorb = "<a href='".e_BASE."user.php?id.".$row3['user_id']."'>".$row3['user_name']."</a>";}

        $text .= "
        <tr>
        <td style='width:100%' class='forumheader3'>".$userorb."</td>
        <td style='width:0%' class='forumheader3'>
        <input type='image' title='Remove Friend' name='main_delete[".$row2['user_friends']."]' src='".e_PLUGIN."aacgc_friendsys/images/removeme.png' onclick=\"return jsconfirm('".FSYS_12." {$row3['user_name']} ".FSYS_13."')\"/>
	</td>
        </tr>";}
		
        $text .= "</table></div>";

        $text .= $rs->form_close();

}

else

{$text .= "".FSYS_14."";}






//----#AACGC Plugin Copyright&reg; - DO NOT REMOVE BELOW THIS LINE! - #-------+
require(e_PLUGIN . 'aacgc_friendsys/plugin.php');
$text .= "<br><br><br><br><br><br><br>
<a href='http://www.aacgc.com' target='_blank'>
<font color='808080' size='1'>".$eplug_name." V".$eplug_version."  &reg;</font>
</a>";
//------------------------------------------------------------------------+


  $ns -> tablerender("".FSYS_15."", $text);

  require_once(FOOTERF);


}


//-----------------------------------------------------------------------------------------------------------+



?>



