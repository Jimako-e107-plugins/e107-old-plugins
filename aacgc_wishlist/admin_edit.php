<?php


/*
#######################################
#     e107 website system plguin      #
#     AACGC Wish List                 #
#     by M@CH!N3                      #
#     http://www.aacgc.com            #
#     admin@aacgc.com                 #
#######################################
*/



                                     ##################
//-----------------------------------#Main Page Config#------------------------------------------------------
                                     ##################

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
require_once(e_HANDLER."calendar/calendar_class.php");
$cal = new DHTML_Calendar(true);
function headerjs()
{
	global $cal;
	require_once(e_HANDLER."calendar/calendar_class.php");
	$cal = new DHTML_Calendar(true);
	return $cal->load_files();
}

include_lan(e_PLUGIN."aacgc_wishlist/languages/".e_LANGUAGE.".php");

//----------------------------------------------------------
if (isset($_POST['update_wishlist'])) {
$message = ($sql->db_Update("aacgc_wishlist", "list_id='".$_POST['list_id']."', list_type='".$_POST['list_type']."', list_date='".$_POST['list_date']."', list_itema='".$_POST['list_itema']."', list_itema_link='".$_POST['list_itema_link']."', list_itemb='".$_POST['list_itemb']."', list_itemb_link='".$_POST['list_itemb_link']."', list_itemc='".$_POST['list_itemc']."', list_itemc_link='".$_POST['list_itemc_link']."', list_itemd='".$_POST['list_itemd']."', list_itemd_link='".$_POST['list_itemd_link']."', list_iteme='".$_POST['list_iteme']."', list_iteme_link='".$_POST['list_iteme_link']."', list_itemf='".$_POST['list_itemf']."', list_itemf_link='".$_POST['list_itemf_link']."', list_itemg='".$_POST['list_itemg']."', list_itemg_link='".$_POST['list_itemg_link']."', list_itemh='".$_POST['list_itemh']."', list_itemh_link='".$_POST['list_itemh_link']."', list_itemi='".$_POST['list_itemi']."', list_itemi_link='".$_POST['list_itemi_link']."', list_itemj='".$_POST['list_itemj']."', list_itemj_link='".$_POST['list_itemj_link']."', list_other='".$_POST['list_other']."', list_other_link='".$_POST['list_other_link']."' WHERE list_user_id='".$_POST['list_user_id']."' ")) ? "".AWL_26."" : "U".AWL_27."";
}


if (isset($_POST['main_delete'])) {

        $delete_id = array_keys($_POST['main_delete']);
	$sql2 = new db;
        $sql2->db_Delete("aacgc_wishlist", "list_user_id='".$delete_id[0]."'");
 }


if (isset($message)) {
$ns->tablerender("", "<div style='text-align:center'><b>".$message."</b></div>");
require_once(e_ADMIN."footer.php");}
//----------------------------------------------------------


if ($action == "") {
       $text .= $rs->form_open("post", e_SELF, "myform", "", "");
        $text .= "
        <div style='text-align:center'>
        <table style='width:95%' class='fborder' cellspacing='0' cellpadding='0'>
        <tr>
        <td style='width:5%' class='forumheader3'>".AWL_28."</td>
        <td style='width:5%' class='forumheader3'>".AWL_29."</td>
        <td style='width:' class='forumheader3'>".AWL_30."</td>
        <td style='width:' class='forumheader3'>".AWL_31."</td>
        <td style='width:' class='forumheader3'>".AWL_32."</td>
        <td style='width:5%' class='forumheader3'>".AWL_33."</td>
       </tr>";
        $sql->db_Select("aacgc_wishlist", "*", "ORDER BY list_id ASC","");
        while($row = $sql->db_Fetch()){
        $sql2->db_Select("user", "*", "WHERE user_id=".$row['list_user_id']."", "");
        $row2 = $sql2->db_Fetch();
        if ($row['list_type'] == "xmas")
        {$type = "<img src='".e_PLUGIN."aacgc_wishlist/images/xmas.gif'></img> ".AWL_34."";}
        if ($row['list_type'] == "bday")
        {$type = "<img src='".e_PLUGIN."aacgc_wishlist/images/bday.jpg'></img> ".AWL_35."";}
        if ($row['list_type'] == "other")
        {$type = "<img src='".e_PLUGIN."aacgc_wishlist/images/other.gif'></img> ".AWL_36."";}
        if ($row['list_type'] == "")
        {$type = "<img src='".e_PLUGIN."aacgc_wishlist/images/other.gif'></img> ".AWL_36."";}
        $listtype = "".$type."";

        $text .= "
        <tr>
        <td style='width:' class='forumheader3'>".$row['list_id']."</td>
        <td style='width:' class='forumheader3'>".$row['list_user_id']."</td>
        <td style='width:' class='forumheader3'>".$row2['user_name']."</td>
        <td style='width:' class='forumheader3'>".$row['list_date']."</td>
        <td style='width:' class='forumheader3'>".$listtype."</td>
        <td style='width:' class='forumheader3'>
        
		<a href='".e_SELF."?edit.{$row['list_user_id']}'>".ADMIN_EDIT_ICON."</a>
		<input type='image' title='".LAN_DELETE."' name='main_delete[".$row['list_user_id']."]' src='".ADMIN_DELETE_ICON_PATH."' onclick=\"return jsconfirm('".LAN_CONFIRMDEL." [ID: {$row2['user_name']} ]')\"/>
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


//----------------------------------------------# Update Wish List #----------------------------------


if ($action == "edit"){

$sql->db_Select("aacgc_wishlist", "*", "list_user_id = $id");
$row = $sql->db_Fetch();
$time = time($row['list_date']);


        $text .= "
        <div style='text-align:center'>
        ".$rs -> form_open("post", e_SELF, "MyForm", "", "enctype='multipart/form-data'", "")."
        ".$rs->form_hidden("list_user_id", $row['list_user_id'])."
        <table style='width:100%' class='fborder' cellspacing='0' cellpadding='0'>";




        $text .= "
        <tr>
        <td style='width:30%; text-align:right' class='forumheader3'>".AWL_32.":</td>
        <td style='width:70%' class='forumheader3' colspan=2>
       <img src='".e_PLUGIN."aacgc_wishlist/images/xmas.gif'></img><input class='tbox' type='radio'  name='list_type' value='xmas' " . 
(list_type=='xmas'?"checked='checked'":'') . " /> ".AWL_34."
        <br>
        <img src='".e_PLUGIN."aacgc_wishlist/images/bday.jpg'></img><input class='tbox' type='radio'  name='list_type' value='dbday' " . 
(list_type=="bday"?"checked='checked'":'') . " /> ".AWL_35."
        <br>
        <img src='".e_PLUGIN."aacgc_wishlist/images/other.gif'></img><input class='tbox' type='radio'  name='list_type' value='other' " . 
(list_type=="other"?"checked='checked'":'') . " /> ".AWL_36."
        </td>
        </tr>";

        $text .= "
        <tr>
        <td style='width:30%; text-align:right' class='forumheader3'>".AWL_31.":</td>
        <td style='width:70%' class='forumheader3' colspan=2>";

        $text .= $cal->make_input_field(
           array('firstDay'       => 1, // show Monday first
                 'showsTime'      => true,
                 'showOthers'     => true,
                 'ifFormat'       => '%m/%d/%Y',
                 'weekNumbers'    => false,
                 'timeFormat'     => '12'),
           array('style'       => 'color: #840; background-color: #ff8; border: 1px solid #000; text-align: center',
                 'name'        => 'list_date',
                 'value'       => date("m/d/Y h:i a", $time)));

        $text .= "</td></tr>";

        $text .= "
        <tr>
        <td style='width:30%; text-align:right' class='forumheader3'>".AWL_37." #1:</td>
        <td style='width:70%' class='forumheader3' colspan=2>
        ".$rs -> form_text("list_itema", 100, $row['list_itema'], 500)."
        </td>
        </tr>
        <tr>
        <td style='width:; text-align:right' class='forumheader3'>".AWL_37." #1 ".AWL_38.":</td>
        <td style='width:' class='forumheader3' colspan=2>
        ".$rs -> form_text("list_itema_link", 100, $row['list_itema_link'], 500)."
        </td>
        </tr>";


        $text .= "
        <tr>
        <td style='width:; text-align:right' class='forumheader3'>".AWL_37." #2:</td>
        <td style='width:' class='forumheader3' colspan=2>
        ".$rs -> form_text("list_itemb", 100, $row['list_itemb'], 500)."
        </td>
        </tr>
        <tr>
        <td style='width:; text-align:right' class='forumheader3'>".AWL_37." #2 ".AWL_38.":</td>
        <td style='width:' class='forumheader3' colspan=2>
        ".$rs -> form_text("list_itemb_link", 100, $row['list_itemb_link'], 500)."
        </td>
        </tr>";


        $text .= "
        <tr>
        <td style='width:; text-align:right' class='forumheader3'>".AWL_37." #3:</td>
        <td style='width:' class='forumheader3' colspan=2>
        ".$rs -> form_text("list_itemc", 100, $row['list_itemc'], 500)."
        </td>
        </tr>
        <tr>
        <td style='width:; text-align:right' class='forumheader3'>".AWL_37." #3 ".AWL_38.":</td>
        <td style='width:' class='forumheader3' colspan=2>
        ".$rs -> form_text("list_itemc_link", 100, $row['list_itemc_link'], 500)."
        </td>
        </tr>";


        $text .= "
        <tr>
        <td style='width:; text-align:right' class='forumheader3'>".AWL_37." #4:</td>
        <td style='width:' class='forumheader3' colspan=2>
        ".$rs -> form_text("list_itemd", 100, $row['list_itemd'], 500)."
        </td>
        </tr>
        <tr>
        <td style='width:; text-align:right' class='forumheader3'>".AWL_37." #4 ".AWL_38.":</td>
        <td style='width:' class='forumheader3' colspan=2>
        ".$rs -> form_text("list_itemd_link", 100, $row['list_itemd_link'], 500)."
        </td>
        </tr>";


        $text .= "
        <tr>
        <td style='width:; text-align:right' class='forumheader3'>".AWL_37." #5:</td>
        <td style='width:' class='forumheader3' colspan=2>
        ".$rs -> form_text("list_iteme", 100, $row['list_iteme'], 500)."
        </td>
        </tr>
        <tr>
        <td style='width:; text-align:right' class='forumheader3'>".AWL_37." #5 ".AWL_38.":</td>
        <td style='width:' class='forumheader3' colspan=2>
        ".$rs -> form_text("list_iteme_link", 100, $row['list_iteme_link'], 500)."
        </td>
        </tr>";


        $text .= "
        <tr>
        <td style='width:; text-align:right' class='forumheader3'>".AWL_37." #6:</td>
        <td style='width:' class='forumheader3' colspan=2>
        ".$rs -> form_text("list_itemf", 100, $row['list_itemf'], 500)."
        </td>
        </tr>
        <tr>
        <td style='width:; text-align:right' class='forumheader3'>".AWL_37." #6 ".AWL_38.":</td>
        <td style='width:' class='forumheader3' colspan=2>
        ".$rs -> form_text("list_itemf_link", 100, $row['list_itemf_link'], 500)."
        </td>
        </tr>";


        $text .= "
        <tr>
        <td style='width:; text-align:right' class='forumheader3'>".AWL_37." #7:</td>
        <td style='width:' class='forumheader3' colspan=2>
        ".$rs -> form_text("list_itemg", 100, $row['list_itemg'], 500)."
        </td>
        </tr>
        <tr>
        <td style='width:; text-align:right' class='forumheader3'>".AWL_37." #7 ".AWL_38.":</td>
        <td style='width:' class='forumheader3' colspan=2>
        ".$rs -> form_text("list_itemg_link", 100, $row['list_itemg_link'], 500)."
        </td>
        </tr>";


        $text .= "
        <tr>
        <td style='width:; text-align:right' class='forumheader3'>".AWL_37." #8:</td>
        <td style='width:' class='forumheader3' colspan=2>
        ".$rs -> form_text("list_itemh", 100, $row['list_itemh'], 500)."
        </td>
        </tr>
        <tr>
        <td style='width:; text-align:right' class='forumheader3'>".AWL_37." #8 ".AWL_38.":</td>
        <td style='width:' class='forumheader3' colspan=2>
        ".$rs -> form_text("list_itemh_link", 100, $row['list_itemh_link'], 500)."
        </td>
        </tr>";


        $text .= "
        <tr>
        <td style='width:; text-align:right' class='forumheader3'>".AWL_37." #9:</td>
        <td style='width:' class='forumheader3' colspan=2>
        ".$rs -> form_text("list_itemi", 100, $row['list_itemi'], 500)."
        </td>
        </tr>
        <tr>
        <td style='width:; text-align:right' class='forumheader3'>".AWL_37." #9 ".AWL_38.":</td>
        <td style='width:' class='forumheader3' colspan=2>
        ".$rs -> form_text("list_itemi_link", 100, $row['list_itemi_link'], 500)."
        </td>
        </tr>";


        $text .= "
        <tr>
        <td style='width:; text-align:right' class='forumheader3'>".AWL_37." #10:</td>
        <td style='width:' class='forumheader3' colspan=2>
        ".$rs -> form_text("list_itemj", 100, $row['list_itemj'], 500)."
        </td>
        </tr>
        <tr>
        <td style='width:; text-align:right' class='forumheader3'>".AWL_37." #10 ".AWL_38.":</td>
        <td style='width:' class='forumheader3' colspan=2>
        ".$rs -> form_text("list_itemj_link", 100, $row['list_itemj_link'], 500)."
        </td>
        </tr>";


        $text .= "
        <tr>
        <td style='width:; text-align:right' class='forumheader3'>".AWL_39.":</td>
        <td style='width:' class='forumheader3' colspan=2>
        ".$rs -> form_text("list_other", 100, $row['list_other'], 500)."
        </td>
        </tr>
        <tr>
        <td style='width:; text-align:right' class='forumheader3'>".AWL_39." ".AWL_38.":</td>
        <td style='width:' class='forumheader3' colspan=2>
        ".$rs -> form_text("list_other_link", 100, $row['list_other_link'], 500)."
        </td>
        </tr>";

       $text .= "
       <tr>
       <td colspan='3' style='text-align:center' class='forumheader3'>
       ".$rs->form_hidden("list_id", $row['list_id'])."
       ".$rs -> form_button("submit", "update_wishlist", "".AWL_40."")."
       </td>
       </tr>
       </table>
       ".$rs -> form_close()."
       </div>";


	      
$ns -> tablerender("AACGC Wish List (Edit User's Wish List)", $text);
require_once(e_ADMIN."footer.php");}

?>