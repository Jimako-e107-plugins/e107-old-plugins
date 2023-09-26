<?php

/*
#######################################
#     e107 website system plguin      #
#     AACGC Favorite Downloads        #
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



//-----------------------------------------------------------------------------------------------------------+

if (isset($_POST['main_delete'])) {
    $delete_id = array_keys($_POST['main_delete']);
    $sql2 = new db;
    $sql2->db_Delete("aacgc_favdls", "user_favdls='".$delete_id[0]."'");

$text .= "<center><b>Favorite Download Removed From List.</b></center><br><br>";}

//-----------------------------------------------------------------------------------------------------------+
if ($action == ""){
if (USER){

        $text .= $rs->form_open("post", e_SELF, "myform_clanapps", "", "");
        $text .= "
        <div style='text-align:center'>
        <table style='width:95%' class='fborder' cellspacing='0' cellpadding='0'>
        <tr>
        <td style='width:100%' class='forumheader3'>Download Name</td>
        <td style='width:0%' class='forumheader3'>Remove</td>
        </tr>";

$sql2->db_Select("aacgc_favdls", "*", "user_id='".USERID."'");
while($row2 = $sql2->db_Fetch()){
$sql3 = new db;
$sql3 ->db_Select("download", "*", "download_id='".intval($row2['user_favdls'])."'");
$row3 = $sql3->db_Fetch();

        $text .= "
        <tr>
        <td style='width:100%' class='forumheader3'><a href='".e_BASE."download.php?view.".$row3['download_id']."'>".$row3['download_name']."</a></td>
        <td style='width:0%' class='forumheader3'>
        <input type='image' title='Remove Favorite Download' name='main_delete[".$row2['user_favdls']."]' src='".e_PLUGIN."aacgc_favdls/images/remove.png' onclick=\"return jsconfirm('Are You Sure You Want To Remove {$row3['download_name']} From Your Favorites List')\"/>
	</td>
        </tr>";}
		
        $text .= "</table></div>";

        $text .= $rs->form_close();

}

else

{$text .= "<i>You must login or register to edit favorites list!</i>";}






//----#AACGC Plugin Copyright&reg; - DO NOT REMOVE BELOW THIS LINE! - #-------+
require(e_PLUGIN . 'aacgc_favdls/plugin.php');
$text .= "<br><br><br><br><br><br><br>
<a href='http://www.aacgc.com' target='_blank'>
<font color='808080' size='1'>".$eplug_name." V".$eplug_version."  &reg;</font>
</a>";
//------------------------------------------------------------------------+


  $ns -> tablerender("Edit Favorite Downloads", $text);

  require_once(FOOTERF);


}


//-----------------------------------------------------------------------------------------------------------+



?>



