<?php

/*
#######################################
#     e107 website system plguin      #
#     AACGC Wish List                 #    
#     by M@CH!N3                      #
#     http://www.AACGC.com            #
#######################################
*/

include_lan(e_PLUGIN."aacgc_wishlist/languages/".e_LANGUAGE.".php");

//-------------------------# Title #--------------------------------------+

$wishlistmenu_title .= "".$pref['wishlist_menutitle']."";

//-------------------------# Info Needed #--------------------------------+

if ($pref['wishlist_enable_gold'] == "1")
{$gold_obj = new gold();}


if ($pref['wishlist_enable_theme'] == "1")
{$themea = "forumheader3";
$themeb = "indent";}
else
{$themea = "";
$themeb = "";}

//-------------------------# Menu Start #---------------------------------+




$wishlistmenu_text .= "<table style='width:100%' class='".$themea."'>
                       <tr>
                       <td class='".$themeb."'><center><a href='".e_PLUGIN."aacgc_wishlist/Create_Wish_List.php'>[ ".WL_17." ]</a></center></td>
                       </tr>
                       </table>";


$wishlistmenu_text .= "<br><center><table style='width:100%' class='".$themea."'><tr>
                   <td style='width:100%' colspan=2><center><a href='".e_PLUGIN."aacgc_wishlist/Wish_List.php'><b>".WL_26."</b></a></td>
                   </tr></table>";

if ($pref['wishlist_enable_autoscroll'] == "1"){
$wishlistmenu_text .= "
<script type=\"text/javascript\">
function wishlistmenuup(){wishlistmenu.direction = \"up\";}
function wishlistmenudown(){wishlistmenu.direction = \"down\";}
function wishlistmenustop(){wishlistmenu.stop();}
function wishlistmenustart(){wishlistmenu.start();}
</script>
<marquee height='".$pref['wishlist_menuheight']."px' id='wishlistmenu' scrollamount='".$pref['wishlist_menuspeed']."' onMouseover='this.scrollAmount=".$pref['wishlist_menuoverspeed']."' onMouseout='this.scrollAmount=".$pref['wishlist_menuspeed']."' direction='down' loop='true'>";}
else
{$wishlistmenu_text .= "<div style='width:100%; height:".$pref['wishlist_menuheight']."px; overflow auto'>";}


$wishlistmenu_text .= "<table style='width:100%' class='".$themea."'><tr>";



        $sql ->db_Select("aacgc_wishlist", "*", "ORDER BY list_user_id ASC","");
        while($row = $sql ->db_Fetch()){
        $sql2 = new db;
        $sql2 ->db_Select("user", "*", "WHERE user_id = '".$row['list_user_id']."'","");
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

        if ($pref['wishlist_enable_listtypemenu'] == "1"){
        if ($row['list_type'] == "xmas")
        {$type = "<img src='".e_PLUGIN."aacgc_wishlist/images/xmas.gif' alt='".WL_01."'></img>";}
        if ($row['list_type'] == "bday")
        {$type = "<img src='".e_PLUGIN."aacgc_wishlist/images/bday.jpg' alt='".WL_02."'></img>";}
        if ($row['list_type'] == "other")
        {$type = "<img src='".e_PLUGIN."aacgc_wishlist/images/other.gif' alt='".WL_03."'></img>";}
        if ($row['list_type'] == "")
        {$type = "<img src='".e_PLUGIN."aacgc_wishlist/images/other.gif' alt='".WL_03."'></img>";}
        $listtype = "".$type."";}



$wishlistmenu_text .= "<tr>";

if ($pref['wishlist_enable_listtypemenu'] == "1"){
$wishlistmenu_text .= "<td style='width:0%' class='".$themeb."'>".$listtype."</td>";}

$wishlistmenu_text .= "<td style='width:100%' class='".$themeb."'><a href='".e_PLUGIN."aacgc_wishlist/Wish_List_Details.php?det.".$row2['user_id']."'>".$avatar." ".$userorb."</a></td>
        </tr>";}




if ($pref['wishlist_enable_autoscroll'] == "1"){
$wishlistmenu_text .= "</table></marquee>
<br><br>
<table style='width:100%' class=''><tr><td>
<center>
<input class=\"button\" value=\"".WL_27."\" onClick=\"wishlistmenustart();\" type=\"button\">
<input class=\"button\" value=\"".WL_28."\" onClick=\"wishlistmenustop();\" type=\"button\">
<input class=\"button\" value=\"".WL_29."\" onClick=\"wishlistmenuup();\" type=\"button\">
<input class=\"button\" value=\"".WL_30."\" onClick=\"wishlistmenudown();\" type=\"button\">
</center>
</td></tr></table>
<br>
";}
else
{$wishlistmenu_text .= "</table></div>";}




$ns -> tablerender($wishlistmenu_title, $wishlistmenu_text);



?>

