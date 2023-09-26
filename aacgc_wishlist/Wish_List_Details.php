<?php

/*
#######################################
#     e107 website system plguin      #
#     AACGC Wish List                 #
#     by M@CH!N3                      #
#     http://www.AACGC.com            #
#######################################
*/

require_once("../../class2.php");
require_once(HEADERF);

include_lan(e_PLUGIN."aacgc_wishlist/languages/".e_LANGUAGE.".php");

if (e_QUERY) {
        $tmp = explode('.', e_QUERY);
        $action = $tmp[0];
        $sub_action = $tmp[1];
        $id = $tmp[2];
        unset($tmp);
}
if ($pref['wishlist_enable_theme'] == "1")
{$themea = "forumheader3";
$themeb = "indent";}
else
{$themea = "";
$themeb = "";}
//----------------------------------------------------------------------------------------------------

if ($action == "det"){


$sql->db_Select("aacgc_wishlist", "*", "list_user_id='".$sub_action."'");
$row = $sql->db_Fetch();
        $sql2 = new db;
        $sql2 ->db_Select("user", "*", "user_id = '".$row['list_user_id']."'");
        $row2 = $sql2 ->db_Fetch();

        if ($pref['wishlist_enable_gold'] == "1")
        {$userorb = "".$gold_obj->show_orb($row2['user_id'])."</font>";}
        else
        {$userorb = "".$row2['user_name']."";}
        if ($pref['wishlist_enable_avatar'] == "1"){
        if ($row2['user_image'] == "")
        {$avatar = "<img src='".e_PLUGIN."aacgc_wishlist/images/default.png' width=".$pref['wishlist_avatarsize']."px></img>";}
        else
        {$useravatar = $row2[user_image];
        require_once(e_HANDLER."avatar_handler.php");
        $useravatar = avatar($useravatar);
        $avatar = "<img src='".$useravatar."' width=".$pref['wishlist_avatarsize']."px></img>";}}

        if ($pref['wishlist_enable_listtype'] == "1"){
        if ($row['list_type'] == "xmas")
        {$type = "<img src='".e_PLUGIN."aacgc_wishlist/images/xmas.gif'></img> ".WL_01."";}
        if ($row['list_type'] == "bday")
        {$type = "<img src='".e_PLUGIN."aacgc_wishlist/images/bday.jpg'></img> ".WL_02."";}
        if ($row['list_type'] == "other")
        {$type = "<img src='".e_PLUGIN."aacgc_wishlist/images/other.gif'></img> ".WL_03."";}
        if ($row['list_type'] == "")
        {$type = "<img src='".e_PLUGIN."aacgc_wishlist/images/other.gif'></img> ".WL_03."";}
        $listtype = "".$type."";}


//----# Counter #------------------------

$page = $row['list_id'];
$count = "0";
$sql4 = new db;
$sql4->mySQLresult = @mysql_query("select * from ".MPREFIX."aacgc_wishlist_views where page=".$page.";");
$row4 = $sql4->db_fetch();

if ($row4['page'] == ""){
$newcounter = '1';
$newcpage = $row['list_id'];
$newvisitor = '0';
$sql->db_Insert("aacgc_wishlist_views", "NULL, '".$newcounter."', '".$newcpage."', '".$newvisitor."'") or die(mysql_error());}

$count = $row4['counter'];
$count = $count+1;
$sql->db_Update("aacgc_wishlist_views", "countid='".$row4['countid']."',counter='".$count."',visitor='0' WHERE page='".$page."'");

$pageviews = "<i>".WL_25.": ".$count."</i>";

//---------------------------------------


        $text .= "<center><table style='width:100%' class='".$themea."'>";

        $text .= "
        <tr>
        <td class='".$themea."' colspan=3><center>".$avatar." ".$userorb."</td></tr>
        <td class='".$themeb."'>".$listtype."</td>
        <td class='".$themeb."'>".WL_10.": ".$row['list_date']."</td>
        <td class='".$themeb."'>".$pageviews."</td>
        </tr>";

        $text .= "</table>";




        $text .= "<table style='width:100%' class='".$themeb."'>
                  <tr>
                  <td class='".$themea."' colspan=2><center><b><u>Items On Wish List</u></b></td>
                  </tr>";

//-------------------------------------
        if ($row['list_itema'] == ""){}
        else {
        $text .= "
        <tr>
        <td class='".$themea."'>1.</td><td style='width:100%; text-align:left' class='".$themeb."'><a href='".$row['list_itema_link']."' target='_blank'>".$row['list_itema']."</a></td>
        </tr>";}

//-------------------------------------
        if ($row['list_itemb'] == ""){}
        else {
        $text .= "
        <tr>
        <td class='".$themea."'>2.</td><td style='width:100%; text-align:left' class='".$themeb."'><a href='".$row['list_itemb_link']."' target='_blank'>".$row['list_itemb']."</a></td>
        </tr>";}

//-------------------------------------
        if ($row['list_itemc'] == ""){}
        else {
        $text .= "
        <tr>
        <td class='".$themea."'>3.</td><td style='width:100%; text-align:left' class='".$themeb."'><a href='".$row['list_itemc_link']."' target='_blank'>".$row['list_itemc']."</a></td>
        </tr>";}

//-------------------------------------
        if ($row['list_itemd'] == ""){}
        else {
        $text .= "
        <tr>
        <td class='".$themea."'>4.</td><td style='width:100%; text-align:left' class='".$themeb."'><a href='".$row['list_itemd_link']."' target='_blank'>".$row['list_itemd']."</a></td>
        </tr>";}

//-------------------------------------
        if ($row['list_iteme'] == ""){}
        else {
        $text .= "
        <tr>
        <td class='".$themea."'>5.</td><td style='width:100%; text-align:left' class='".$themeb."'><a href='".$row['list_iteme_link']."' target='_blank'>".$row['list_iteme']."</a></td>
        </tr>";}

//-------------------------------------
        if ($row['list_itemf'] == ""){}
        else {
        $text .= "
        <tr>
        <td class='".$themeb."'>6.</td><td style='width:100%; text-align:left' class='".$themeb."'><a href='".$row['list_itemf_link']."' target='_blank'>".$row['list_itemf']."</a></td>
        </tr>";}

//-------------------------------------
        if ($row['list_itemg'] == ""){}
        else {
        $text .= "
        <tr>
        <td class='".$themeb."'>7.</td><td style='width:100%; text-align:left' class='".$themeb."'><a href='".$row['list_itemg_link']."' target='_blank'>".$row['list_itemg']."</a></td>
        </tr>";}

//-------------------------------------
        if ($row['list_itemh'] == ""){}
        else {
        $text .= "
        <tr>
        <td class='".$themeb."'>8.</td><td style='width:100%; text-align:left' class='".$themeb."'><a href='".$row['list_itemh_link']."' target='_blank'>".$row['list_itemh']."</a></td>
        </tr>";}

//-------------------------------------
        if ($row['list_itemi'] == ""){}
        else {
        $text .= "
        <tr>
        <td class='".$themeb."'>9.</td><td style='width:100%; text-align:left' class='".$themeb."'><a href='".$row['list_itemi_link']."' target='_blank'>".$row['list_itemi']."</a></td>
        </tr>";}

//-------------------------------------
        if ($row['list_itemj'] == ""){}
        else {
        $text .= "
        <tr>
        <td class='".$themeb."'>10.</td><td style='width:100%; text-align:left' class='".$themeb."'><a href='".$row['list_itemj_link']."' target='_blank'>".$row['list_itemj']."</a></td>
        </tr>";}


//-------------------------------------
        if ($row['list_other'] == ""){}
        else {
        $text .= "
        <tr>
        <td class='".$themeb."'>Other Lists.</td><td style='width:100%; text-align:left' class='".$themeb."'><a href='".$row['list_other_link']."' target='_blank'>".$row['list_other']."</a></td>
        </tr>";}

        $text .= "</table>";


    
        $text .= "<br><br><center><br><a href='".e_PLUGIN."aacgc_wishlist/Wish_List.php'>[ Back To Wish List ]</center></a><br>";


$title = "".WL_26."";

$ns -> tablerender($title, $text);}



require_once(FOOTERF);

?>






