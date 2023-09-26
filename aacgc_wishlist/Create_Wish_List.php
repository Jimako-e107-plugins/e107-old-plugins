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
include_lan(e_PLUGIN."aacgc_wishlist/languages/".e_LANGUAGE.".php");
require_once(e_HANDLER."calendar/calendar_class.php");
$cal = new DHTML_Calendar(true);
function headerjs()
{
	global $cal;
	require_once(e_HANDLER."calendar/calendar_class.php");
	$cal = new DHTML_Calendar(true);
	return $cal->load_files();
}
$offset = +0;
$time = time()  + ($offset * 60 * 60);


if ($pref['wishlist_enable_theme'] == "1")
{$themea = "forumheader3";
$themeb = "indent";}
else
{$themea = "";
$themeb = "";}

if (USER){
$sql->db_Select("aacgc_wishlist", "*", "list_user_id ='".USERID."'");
$row = $sql->db_Fetch();
$wishlistuser = "".$row['list_user_id']."";
$onlineuserid = "".USERID."";

//------------------------------------------

if ($_POST['main_delete']) {

        $delete_id = array_keys($_POST['main_delete']);
	$sql2 = new db;
        $sql2->db_Delete("aacgc_wishlist", "list_user_id='".$delete_id[0]."'");

$ns->tablerender("", "<center><b>".WL_05.".</b><br>[<a href='".e_PLUGIN."aacgc_wishlist/Wish_List.php'> ".WL_06." </a>]</center>");

require_once(FOOTERF);}

//------------------------------------------

if ($_POST['add_list'] == '1') {
$newname = $_POST['list_user_id'];
$newtype = $_POST['list_type'];
$newdate = $_POST['list_date'];
$newitema = $_POST['list_itema'];
$newitemalink = $_POST['list_itema_link'];
$newitemb = $_POST['list_itemb'];
$newitemblink = $_POST['list_itemb_link'];
$newitemc = $_POST['list_itemc'];
$newitemclink = $_POST['list_itemc_link'];
$newitemd = $_POST['list_itemd'];
$newitemdlink = $_POST['list_itemd_link'];
$newiteme = $_POST['list_iteme'];
$newitemelink = $_POST['list_iteme_link'];
$newitemf = $_POST['list_itemf'];
$newitemflink = $_POST['list_itemf_link'];
$newitemg = $_POST['list_itemg'];
$newitemglink = $_POST['list_itemg_link'];
$newitemh = $_POST['list_itemh'];
$newitemhlink = $_POST['list_itemh_link'];
$newitemi = $_POST['list_itemi'];
$newitemilink = $_POST['list_itemi_link'];
$newitemj = $_POST['list_itemj'];
$newitemjlink = $_POST['list_itemj_link'];
$newother = $_POST['list_other'];
$newotherlink = $_POST['list_other_link'];

$sql->db_Insert("aacgc_wishlist", "NULL, '".$newname."', '".$newtype."', '".$newdate."', '".$newitema."', '".$newitemalink."', '".$newitemb."', '".$newitemblink."', '".$newitemc."', '".$newitemclink."', '".$newitemd."', '".$newitemdlink."', '".$newiteme."', '".$newitemelink."', '".$newitemf."', '".$newitemflink."', '".$newitemg."', '".$newitemglink."', '".$newitemh."', '".$newitemhlink."', '".$newitemi."', '".$newitemilink."', '".$newitemj."', '".$newitemjlink."', '".$newother."', '".$newotherlink."'") or die(mysql_error());

$ns->tablerender("", "<center><b>".WL_09.".</b><br>[<a href='".e_PLUGIN."aacgc_wishlist/Wish_List.php'> ".WL_06." </a>]</center>");

require_once(FOOTERF);
}

//------------------------------------------

if ($wishlistuser == "{$onlineuserid}"){
//----------------------------------------------# Current Wish List #--------------------------------

$sql2->db_Select("aacgc_wishlist", "*", "list_user_id ='".USERID."'");
$row2 = $sql2->db_Fetch();
        if ($pref['wishlist_enable_listtype'] == "1"){
        if ($row2['list_type'] == "xmas")
        {$type = "<img src='".e_PLUGIN."aacgc_wishlist/images/xmas.gif'></img> <b>".WL_01."</b>";}
        else if ($row2['list_type'] == "bday")
        {$type = "<img src='".e_PLUGIN."aacgc_wishlist/images/bday.jpg'></img> <b>".WL_02."</b>";}
        else
        {$type = "<img src='".e_PLUGIN."aacgc_wishlist/images/other.gif'></img> <b>".WL_03."</b>";}
        
        $wishlisttype = "".$type."";}

$text .= "<center><table style='width:100%' class='".$themea."'>
          <tr>
          <td class='".$themeb."'><center><img src='".e_PLUGIN."aacgc_wishlist/images/wishlist_logol.gif'></img></td>
          <td class='".$themea."'><center><font size='5'><b><u>".WL_17."</u></b></font></td>
          <td class='".$themeb."'><center><img src='".e_PLUGIN."aacgc_wishlist/images/wishlist_logor.gif'></img></td>
          </tr>
          <tr><td class='".$themea."' colspan=3><center>".$wishlisttype."</td></tr>
          <tr><td class='".$themea."' colspan=3><center>".WL_10.": [".$row2['list_date']."]</td></tr>
          </table>";



        $text .= "<table style='width:100%' class='".$themea."'>
                  <tr>
                  <td class='".$themea."' colspan=2><center><b><u>".WL_04."</u></b></td>
                  </tr>";


//-------------------------------------
        if ($row['list_itema'] == ""){}
        else {
        $text .= "
        <tr>
        <td class='".$themeb."'>1.</td><td style='width:100%' class='".$themeb."'><a href='".$row2['list_itema_link']."' target='_blank'>".$row2['list_itema']."</a></td>
        </tr>";}

//-------------------------------------
        if ($row['list_itemb'] == ""){}
        else {
        $text .= "
        <tr>
        <td class='".$themeb."'>2.</td><td style='width:100%' class='".$themeb."'><a href='".$row2['list_itemb_link']."' target='_blank'>".$row2['list_itemb']."</a></td>
        </tr>";}

//-------------------------------------
        if ($row['list_itemc'] == ""){}
        else {
        $text .= "
        <tr>
        <td class='".$themeb."'>3.</td><td style='width:100%' class='".$themeb."'><a href='".$row2['list_itemc_link']."' target='_blank'>".$row2['list_itemc']."</a></td>
        </tr>";}

//-------------------------------------
        if ($row['list_itemd'] == ""){}
        else {
        $text .= "
        <tr>
        <td class='".$themeb."'>4.</td><td style='width:100%' class='".$themeb."'><a href='".$row2['list_itemd_link']."' target='_blank'>".$row2['list_itemd']."</a></td>
        </tr>";}

//-------------------------------------
        if ($row['list_iteme'] == ""){}
        else {
        $text .= "
        <tr>
        <td class='".$themeb."'>5.</td><td style='width:100%' class='".$themeb."'><a href='".$row2['list_iteme_link']."' target='_blank'>".$row2['list_iteme']."</a></td>
        </tr>";}

//-------------------------------------
        if ($row['list_itemf'] == ""){}
        else {
        $text .= "
        <tr>
        <td class='".$themeb."'>6.</td><td style='width:100%' class='".$themeb."'><a href='".$row2['list_itemf_link']."' target='_blank'>".$row2['list_itemf']."</a></td>
        </tr>";}

//-------------------------------------
        if ($row['list_itemg'] == ""){}
        else {
        $text .= "
        <tr>
        <td class='".$themeb."'>7.</td><td style='width:100%' class='".$themeb."'><a href='".$row2['list_itemg_link']."' target='_blank'>".$row2['list_itemg']."</a></td>
        </tr>";}

//-------------------------------------
        if ($row['list_itemh'] == ""){}
        else {
        $text .= "
        <tr>
        <td class='".$themeb."'>8.</td><td style='width:100%' class='".$themeb."'><a href='".$row2['list_itemh_link']."' target='_blank'>".$row2['list_itemh']."</a></td>
        </tr>";}

//-------------------------------------
        if ($row['list_itemi'] == ""){}
        else {
        $text .= "
        <tr>
        <td class='".$themeb."'>9.</td><td style='width:100%' class='".$themeb."'><a href='".$row2['list_itemi_link']."' target='_blank'>".$row2['list_itemi']."</a></td>
        </tr>";}

//-------------------------------------
        if ($row['list_itemj'] == ""){}
        else {
        $text .= "
        <tr>
        <td class='".$themeb."'>10.</td><td style='width:100%' class='".$themeb."'><a href='".$row2['list_itemj_link']."' target='_blank'>".$row2['list_itemj']."</a></td>
        </tr>";}

//-------------------------------------
        if ($row['list_other'] == ""){}
        else {
        $text .= "
        <tr>
        <td class='".$themeb."'>Other List.</td><td style='width:100%' class='".$themeb."'><a href='".$row2['list_other_link']."' target='_blank'>".$row2['list_other']."</a></td>
        </tr>";}

        $text .= "</table>";


//----------------------------------------------# Edit / Delete Wish List #----------------------------------


$text .= "<br><br><form method='POST'><center>
	  <table style='width:100%' class='".$themea."'><tr>";

$text .= "<td style='width:50%' class='".themeb."'><center><a href='".e_PLUGIN."aacgc_wishlist/Edit_Wish_List.php'>[ ".WL_07." ]</a></td>
          <td style='width:50%' class='".themeb."'><center><input type='hidden' name='main_delete[".USERID."]'>
          <input class='".themeb."' type='submit' value='[ ".WL_08." ]'>
          </center></td>";

$text .= "</tr></table></form>";

$text .= "<br><br>   
          <center>
          [<a href='".e_PLUGIN."aacgc_wishlist/Wish_List.php'> ".WL_06." </a>]
          </center>
          <br></center>";

}

//----------------------------------------------------------------------------------------------------

else

//----------------------------------------------# Create Wish List #----------------------------------

{

$sql->db_Select("aacgc_wishlist", "*", "list_user_id ='".USERID."'");
$row = $sql->db_Fetch();


//----------------------------

$text .= "<br><br><center>
<form method='POST' action='Create_Wish_List.php'>
<table style='' class='indent'><tr>
<td colspan=2>
<input type='hidden' name='list_user_id' value='".USERID."'>
</td>
</tr>
";


//---------------# Type #-----------+
$text .= "
<tr>
<td class='".$themea."'>".WL_18.":</td>
<td class='".$themea."'>

<img src='".e_PLUGIN."aacgc_wishlist/images/xmas.gif'></img>
<input class='tbox' type='radio'  name='list_type' value='xmas' ".
($row['list_type']=='xmas'?"checked='checked'":'')." /> ".WL_01."<br>

<img src='".e_PLUGIN."aacgc_wishlist/images/bday.jpg'></img>
<input class='tbox' type='radio'  name='list_type' value='dbday' ".
($row['list_type']=="bday"?"checked='checked'":'')." /> ".WL_02."<br>

<img src='".e_PLUGIN."aacgc_wishlist/images/other.gif'></img>
<input class='tbox' type='radio'  name='list_type' value='other' " . 
($row['list_type']=="other"?"checked='checked'":'')." /> ".WL_03."

</td>
</tr>";
//---------------# Date #-----------+
$text .= "
<tr>
<td class='".$themea."'>".WL_10.":</td>
<td class='".$themea."'>";

$text .= $cal->make_input_field(
           array('firstDay'       => 1, // show Monday first
                 'showsTime'      => true,
                 'showOthers'     => true,
                 'ifFormat'       => '%m/%d/%Y',
                 'weekNumbers'    => false,
                 'timeFormat'     => '12'),
           array('style'       => 'color: #840; background-color: #ff8; border: 1px solid #000; text-align: center',
                 'name'        => 'list_date',
                 'value'       => date("m/d/Y", $time)));

$text .= "</td></tr>";
//---------------# Item 1 #-----------+
$text .= "
<tr>
<td class='".$themea."'>".WL_11." #1:</td>
<td class='".$themea."'>
<input class='tbox' type='text' name='list_itema' size='100'>
</td>
</tr>
<tr>
<td class='".$themea."'>".WL_11." #1 ".WL_12." (".WL_13."):</td>
<td class='".$themeb."'>
<input class='tbox' type='text' name='list_itema_link' size='100'>
</td>
</tr>";
//---------------# Item 2 #-----------+
$text .= "
<tr>
<td class='".$themea."'>".WL_11." #2:</td>
<td class='".$themea."'>
<input class='tbox' type='text' name='list_itemb' size='100'>
</td>
</tr>
<tr>
<td class='".$themea."'>".WL_11." #2 ".WL_12." (".WL_13."):</td>
<td class='".$themeb."'>
<input class='tbox' type='text' name='list_itemb_link' size='100'>
</td>
</tr>";
//---------------# Item 3 #-----------+
$text .= "
<tr>
<td class='".$themea."'>".WL_11." #3:</td>
<td class='".$themea."'>
<input class='tbox' type='text' name='list_itemc' size='100'>
</td>
</tr>
<tr>
<td class='".$themea."'>".WL_11." #3 ".WL_12." (".WL_13."):</td>
<td class='".$themeb."'>
<input class='tbox' type='text' name='list_itemc_link' size='100'>
</td>
</tr>";
//---------------# Item 4 #-----------+
$text .= "
<tr>
<td class='".$themea."'>".WL_11." #4:</td>
<td class='".$themea."'>
<input class='tbox' type='text' name='list_itemd' size='100'>
</td>
</tr>
<tr>
<td class='".$themea."'>".WL_11." #4 ".WL_12." (".WL_13."):</td>
<td class='".$themeb."'>
<input class='tbox' type='text' name='list_itemd_link' size='100'>
</td>
</tr>";
//---------------# Item 5 #-----------+
$text .= "
<tr>
<td class='".$themea."'>".WL_11." #5:</td>
<td class='".$themea."'>
<input class='tbox' type='text' name='list_iteme' size='100'>
</td>
</tr>
<tr>
<td class='".$themea."'>".WL_11." #5 ".WL_12." (".WL_13."):</td>
<td class='".$themeb."'>
<input class='tbox' type='text' name='list_iteme_link' size='100'>
</td>
</tr>";
//---------------# Item 6 #-----------+
$text .= "
<tr>
<td class='".$themea."'>".WL_11." #6:</td>
<td class='".$themea."'>
<input class='tbox' type='text' name='list_itemf' size='100'>
</td>
</tr>
<tr>
<td class='".$themea."'>".WL_11." #6 ".WL_12." (".WL_13."):</td>
<td class='".$themeb."'>
<input class='tbox' type='text' name='list_itemf_link' size='100'>
</td>
</tr>";
//---------------# Item 7 #-----------+
$text .= "
<tr>
<td class='".$themea."'>".WL_11." #7:</td>
<td class='indent'>
<input class='tbox' type='text' name='list_itemg' size='100'>
</td>
</tr>
<tr>
<td class='".$themea."'>".WL_11." #7 ".WL_12." (".WL_13."):</td>
<td class='".$themeb."'>
<input class='tbox' type='text' name='list_itemg_link' size='100'>
</td>
</tr>";
//---------------# Item 8 #-----------+
$text .= "
<tr>
<td class='".$themea."'>".WL_11." #8:</td>
<td class='".$themea."'>
<input class='tbox' type='text' name='list_itemh' size='100'>
</td>
</tr>
<tr>
<td class='".$themea."'>".WL_11." #8 ".WL_12." (".WL_13."):</td>
<td class='".$themeb."'>
<input class='tbox' type='text' name='list_itemh_link' size='100'>
</td>
</tr>";
//---------------# Item 9 #-----------+
$text .= "
<tr>
<td class='".$themea."'>".WL_11." #9:</td>
<td class='".$themea."'>
<input class='tbox' type='text' name='list_itemi' size='100'>
</td>
</tr>
<tr>
<td class='".$themea."'>".WL_11." #9 ".WL_12." (".WL_13."):</td>
<td class='".$themeb."'>
<input class='tbox' type='text' name='list_itemi_link' size='100'>
</td>
</tr>";
//---------------# Item 10 #-----------+
$text .= "
<tr>
<td class='".$themea."'>".WL_11." #10:</td>
<td class='".$themea."'>
<input class='tbox' type='text' name='list_itemj' size='100'>
</td>
</tr>
<tr>
<td class='".$themea."'>".WL_11." #10 ".WL_12." (".WL_13."):</td>
<td class='".$themeb."'>
<input class='tbox' type='text' name='list_itemj_link' size='100'>
</td>
</tr>";
//---------------# Other List #-----------+
$text .= "
<tr>
<td class='".$themea."'>".WL_19.":</td>
<td class='".$themea."'>
<input class='tbox' type='text' name='list_other' size='100'>
</td>
</tr>
<tr>
<td class='".$themea."'>".WL_19." ".WL_12." (".WL_13."):</td>
<td class='".$themeb."'>
<input class='tbox' type='text' name='list_other_link' size='100'>
</td>
</tr>";


$text .= "
</table>
<br><br>
<input type='hidden' name='add_list' value='1'>
<input class='forumheader3' type='submit' value='[ ".WL_14." ]'>
</form>
";


$text .= "<br><br>   
          <center>
          [<a href='".e_PLUGIN."aacgc_wishlist/Wish_List.php'> ".WL_06." </a>]
          </center>
          <br>";

}

//---------------------------# Guests #------------------------------------------------

}
else

{$text .= "<center><br><br><b><i>".WL_15."</i></b><br><br></center>";
$text .= "<br><br>   
          <center>
          [<a href='".e_PLUGIN."aacgc_wishlist/Wish_List.php'> ".WL_06." </a>]
          </center>
          <br>";

}

$ns -> tablerender("".WL_16."", $text);

require_once(FOOTERF);

?>