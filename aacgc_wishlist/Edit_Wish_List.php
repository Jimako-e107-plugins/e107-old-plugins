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
require_once(HEADERF);
require_once(e_HANDLER."form_handler.php"); 
require_once(e_HANDLER."file_class.php");
$rs = new form;
$fl = new e_file;

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

if ($pref['wishlist_enable_theme'] == "1")
{$themea = "forumheader3";
$themeb = "indent";}
else
{$themea = "";
$themeb = "";}

$sql->db_Select("aacgc_wishlist", "*", "list_user_id = '".USERID."'");
$row = $sql->db_Fetch();

//----------------------------------------------# Update Wish List #----------------------------------

if (isset($_POST['update_wishlist'])) {
$message = ($sql->db_Update("aacgc_wishlist", "list_id='".$_POST['list_id']."', list_type='".$_POST['list_type']."', list_date='".$_POST['list_date']."', list_itema='".$_POST['list_itema']."', list_itema_link='".$_POST['list_itema_link']."', list_itemb='".$_POST['list_itemb']."', list_itemb_link='".$_POST['list_itemb_link']."', list_itemc='".$_POST['list_itemc']."', list_itemc_link='".$_POST['list_itemc_link']."', list_itemd='".$_POST['list_itemd']."', list_itemd_link='".$_POST['list_itemd_link']."', list_iteme='".$_POST['list_iteme']."', list_iteme_link='".$_POST['list_iteme_link']."', list_itemf='".$_POST['list_itemf']."', list_itemf_link='".$_POST['list_itemf_link']."', list_itemg='".$_POST['list_itemg']."', list_itemg_link='".$_POST['list_itemg_link']."', list_itemh='".$_POST['list_itemh']."', list_itemh_link='".$_POST['list_itemh_link']."', list_itemi='".$_POST['list_itemi']."', list_itemi_link='".$_POST['list_itemi_link']."', list_itemj='".$_POST['list_itemj']."', list_itemj_link='".$_POST['list_itemj_link']."', list_other='".$_POST['list_other']."', list_other_link='".$_POST['list_other_link']."' WHERE list_user_id='".$_POST['list_user_id']."' ")) ? "".WL_20."" : "".WL_21."";
}

if (isset($message)) {
 $text = "<div style='text-align:center'><b>".$message."</b></div><br><br>   
          <center>
          [<a href='".e_PLUGIN."aacgc_wishlist/Wish_List.php'> ".WL_06." </a>]
          </center>
          <br>";

$ns -> tablerender("".WL_17."", $text);
require_once(FOOTERF);}


//----------------------------



$time = time($row['list_date']);

        $text = "
        ".$rs -> form_open("post", e_SELF, "MyForm", "", "enctype='multipart/form-data'", "")."
        ".$rs->form_hidden("list_user_id", $row['list_user_id'])."
        <table style='width:100%' class='fborder' cellspacing='0' cellpadding='0'>";



        $text .= "
        <tr>
        <td style='width:; text-align:right' class='".$themea."'>".WL_18.":</td>
        <td style='width:' class='forumheader3' colspan=2>
        <img src='".e_PLUGIN."aacgc_wishlist/images/xmas.gif'></img>
	<input class='tbox' type='radio'  name='list_type' value='xmas' ".($row['list_type']=='xmas'?"checked='checked'":'')." /> ".WL_01."
        <br>
        <img src='".e_PLUGIN."aacgc_wishlist/images/bday.jpg'></img>
	<input class='tbox' type='radio'  name='list_type' value='bday' ".($row['list_type']==''?"checked='checked'":'')." /> ".WL_02."
        <br>
        <img src='".e_PLUGIN."aacgc_wishlist/images/other.gif'></img>
	<input class='tbox' type='radio'  name='list_type' value='other' ".($row['list_type']=='other'?"checked='checked'":'')." /> ".WL_03."
        </td>
        </tr>";


        $text .= "
        <tr>
        <td style='width:; text-align:right' class='".$themea."'>".WL_10.":</td>
        <td style='width:' class='".$themea."' colspan=2>";

$text .= $cal->make_input_field(
           array('firstDay'       => 1, // show Monday first
                 'showsTime'      => true,
                 'showOthers'     => true,
                 'ifFormat'       => '%m/%d/%Y',
                 'weekNumbers'    => false,
                 'timeFormat'     => '12'),
           array('style'       => 'color: #840; background-color: #ff8; border: 1px solid #000; text-align: center',
                 'name'        => 'list_date',
                 'value'       => $row['list_date']));

        $text .= "</td></tr>";

        $text .= "
        <tr>
        <td style='width:; text-align:right' class='".$themea."'>".WL_11." #1:</td>
        <td style='width:' class='".$themea."' colspan=2>
        ".$rs -> form_text("list_itema", 75, $row['list_itema'], 500)."
        </td>
        </tr>
        <tr>
        <td style='width:; text-align:right' class='".$themea."'>".WL_11." #1 ".WL_12.":</td>
        <td style='width:' class='".$themeb."' colspan=2>
        ".$rs -> form_text("list_itema_link", 75, $row['list_itema_link'], 500)."
        </td>
        </tr>";


        $text .= "
        <tr>
        <td style='width:; text-align:right' class='".$themea."'>".WL_11." #2:</td>
        <td style='width:' class='".$themea."' colspan=2>
        ".$rs -> form_text("list_itemb", 75, $row['list_itemb'], 500)."
        </td>
        </tr>
        <tr>
        <td style='width:; text-align:right' class='".$themea."'>".WL_11." #2 ".WL_12.":</td>
        <td style='width:' class='".$themeb."' colspan=2>
        ".$rs -> form_text("list_itemb_link", 75, $row['list_itemb_link'], 500)."
        </td>
        </tr>";


        $text .= "
        <tr>
        <td style='width:; text-align:right' class='".$themea."'>".WL_11." #3:</td>
        <td style='width:' class='".$themea."' colspan=2>
        ".$rs -> form_text("list_itemc", 75, $row['list_itemc'], 500)."
        </td>
        </tr>
        <tr>
        <td style='width:; text-align:right' class='".$themea."'>".WL_11." #3 ".WL_12.":</td>
        <td style='width:' class='".$themeb."' colspan=2>
        ".$rs -> form_text("list_itemc_link", 75, $row['list_itemc_link'], 500)."
        </td>
        </tr>";


        $text .= "
        <tr>
        <td style='width:; text-align:right' class='".$themea."'>".WL_11." #4:</td>
        <td style='width:' class='".$themea."' colspan=2>
        ".$rs -> form_text("list_itemd", 75, $row['list_itemd'], 500)."
        </td>
        </tr>
        <tr>
        <td style='width:; text-align:right' class='".$themea."'>".WL_11." #4 ".WL_12.":</td>
        <td style='width:' class='".$themeb."' colspan=2>
        ".$rs -> form_text("list_itemd_link", 75, $row['list_itemd_link'], 500)."
        </td>
        </tr>";


        $text .= "
        <tr>
        <td style='width:; text-align:right' class='".$themea."'>".WL_11." #5:</td>
        <td style='width:' class='".$themea."' colspan=2>
        ".$rs -> form_text("list_iteme", 75, $row['list_iteme'], 500)."
        </td>
        </tr>
        <tr>
        <td style='width:; text-align:right' class='".$themea."'>".WL_11." #5 ".WL_12.":</td>
        <td style='width:' class='".$themeb."' colspan=2>
        ".$rs -> form_text("list_iteme_link", 75, $row['list_iteme_link'], 500)."
        </td>
        </tr>";


        $text .= "
        <tr>
        <td style='width:; text-align:right' class='".$themea."'>".WL_11." #6:</td>
        <td style='width:' class='".$themea."' colspan=2>
        ".$rs -> form_text("list_itemf", 75, $row['list_itemf'], 500)."
        </td>
        </tr>
        <tr>
        <td style='width:; text-align:right' class='".$themea."'>".WL_11." #6 ".WL_12.":</td>
        <td style='width:' class='".$themeb."' colspan=2>
        ".$rs -> form_text("list_itemf_link", 75, $row['list_itemf_link'], 500)."
        </td>
        </tr>";


        $text .= "
        <tr>
        <td style='width:; text-align:right' class='".$themea."'>".WL_11." #7:</td>
        <td style='width:' class='".$themea."' colspan=2>
        ".$rs -> form_text("list_itemg", 75, $row['list_itemg'], 500)."
        </td>
        </tr>
        <tr>
        <td style='width:; text-align:right' class='".$themea."'>".WL_11." #7 ".WL_12.":</td>
        <td style='width:' class='".$themeb."' colspan=2>
        ".$rs -> form_text("list_itemg_link", 75, $row['list_itemg_link'], 500)."
        </td>
        </tr>";


        $text .= "
        <tr>
        <td style='width:; text-align:right' class='".$themea."'>".WL_11." #8:</td>
        <td style='width:' class='".$themea."' colspan=2>
        ".$rs -> form_text("list_itemh", 75, $row['list_itemh'], 500)."
        </td>
        </tr>
        <tr>
        <td style='width:; text-align:right' class='".$themea."'>".WL_11." #8 ".WL_12.":</td>
        <td style='width:' class='".$themeb."' colspan=2>
        ".$rs -> form_text("list_itemh_link", 75, $row['list_itemh_link'], 500)."
        </td>
        </tr>";


        $text .= "
        <tr>
        <td style='width:; text-align:right' class='".$themea."'>".WL_11." #9:</td>
        <td style='width:' class='".$themea."' colspan=2>
        ".$rs -> form_text("list_itemi", 75, $row['list_itemi'], 500)."
        </td>
        </tr>
        <tr>
        <td style='width:; text-align:right' class='".$themea."'>".WL_11." #9 ".WL_12.":</td>
        <td style='width:' class='".$themeb."' colspan=2>
        ".$rs -> form_text("list_itemi_link", 75, $row['list_itemi_link'], 500)."
        </td>
        </tr>";


        $text .= "
        <tr>
        <td style='width:; text-align:right' class='".$themea."'>".WL_11." #10:</td>
        <td style='width:' class='".$themea."' colspan=2>
        ".$rs -> form_text("list_itemj", 75, $row['list_itemj'], 500)."
        </td>
        </tr>
        <tr>
        <td style='width:; text-align:right' class='".$themea."'>".WL_11." #10 ".WL_12.":</td>
        <td style='width:' class='".$themeb."' colspan=2>
        ".$rs -> form_text("list_itemj_link", 75, $row['list_itemj_link'], 500)."
        </td>
        </tr>";


        $text .= "
        <tr>
        <td style='width:; text-align:right' class='".$themea."'>".WL_19.":</td>
        <td style='width:' class='".$themea."' colspan=2>
        ".$rs -> form_text("list_other", 75, $row['list_other'], 500)."
        </td>
        </tr>
        <tr>
        <td style='width:; text-align:right' class='".$themea."'>".WL_19." ".WL_12.":</td>
        <td style='width:' class='".$themeb."' colspan=2>
        ".$rs -> form_text("list_other_link", 75, $row['list_other_link'], 500)."
        </td>
        </tr>";


       $text .= "
       <tr>
       <td colspan='3' style='text-align:center' class='".$themea."'>
       ".$rs->form_hidden("list_id", $row['list_id'])."
       ".$rs -> form_button("submit", "update_wishlist", "".WL_22."")."
       </td>
       </tr>
       </table>
       ".$rs -> form_close()."
";

$text .= "<br><br>   
          <center>
          [<a href='".e_PLUGIN."aacgc_wishlist/Wish_List.php'> ".WL_06." </a>]
          </center>
          <br>";
	      
$ns -> tablerender("".WL_17."", $text);
require_once(FOOTERF);

?>
