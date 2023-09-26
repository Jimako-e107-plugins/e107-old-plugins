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

//-------------------------# Title #--------------------------------------+

$wishlist_title .= "".$pref['wishlist_title']."";

//-------------------------# Info Needed #--------------------------------+

if ($pref['wishlist_enable_gold'] == "1")
{$gold_obj = new gold();}


if ($pref['wishlist_enable_theme'] == "1")
{$themea = "forumheader3";
$themeb = "indent";}
else
{$themea = "";
$themeb = "";}

//-------------------------# Page Start #---------------------------------+




$wishlist_text .= "<table style='width:100%' class='".$themea."'><tr>
                   <td class='".$themeb."' rowspan=2><center><img src='".e_PLUGIN."aacgc_wishlist/images/wishlist_logolbig.gif'></img></td>
                   <td class='".$themea."'><center>
                   <font size='".$pref['wishlist_headerfsize']."'>".$pref['wishlist_header']."</font>
                   <br>
                   <font size='".$pref['wishlist_introfsize']."'>".$pref['wishlist_intro']."</font>
                   </center><br></td>
                   <td class='".$themeb."' rowspan=2><center><img src='".e_PLUGIN."aacgc_wishlist/images/wishlist_logorbig.gif'></img></td>
                   </tr><tr>
                   <td class='".$themea."'><center><a href='".e_PLUGIN."aacgc_wishlist/Create_Wish_List.php'>[ ".WL_17." ]</a></center></td>
                   </tr></table>";


$wishlist_text .= "<br><br><center><table style='width:100%' class='".$themeb."'><tr>
                   <td style='width:0%' class='".$themea."'><center><u>".WL_18."</u></td>
                   <td style='width:70%' class='".$themea."'><u>".WL_23."</u></td>
                   <td style='width:30%' class='".$themea."'><center><u>".WL_24."</u></td>
                   </tr>";





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

        if ($pref['wishlist_enable_listtype'] == "1"){
        if ($row['list_type'] == "xmas")
        {$type = "<img src='".e_PLUGIN."aacgc_wishlist/images/xmas.gif' alt='".WL_01."'></img>";}
        if ($row['list_type'] == "bday")
        {$type = "<img src='".e_PLUGIN."aacgc_wishlist/images/bday.jpg' alt='".WL_02."'></img>";}
        if ($row['list_type'] == "other")
        {$type = "<img src='".e_PLUGIN."aacgc_wishlist/images/other.gif' alt='".WL_19."'></img>";}
        if ($row['list_type'] == "")
        {$type = "<img src='".e_PLUGIN."aacgc_wishlist/images/other.gif' alt='".WL_19."'></img>";}
        $listtype = "".$type."";}




$wishlist_text .= "<tr>";

$wishlist_text .= "<td style='width:' class='".$themea."'>".$listtype."</td>";

$wishlist_text .= "<td style='width:' class='".$themea."'><a href='".e_PLUGIN."aacgc_wishlist/Wish_List_Details.php?det.".$row2['user_id']."'>".$avatar." ".$userorb."</a></td>";

$wishlist_text .= "<td style='width:' class='".$themea."'><center>".$row['list_date']."</center></td>";

$wishlist_text .= "</tr>";}





$wishlist_text .= "</table></center>";



//--------------------------------------------------------------------+

//----#AACGC Plugin Copyright&reg; - DO NOT REMOVE BELOW THIS LINE! - #-------+
require(e_PLUGIN . 'aacgc_wishlist/plugin.php');
$wishlist_text .= "<br><br><br><br><br><br><br>
<a href='http://www.aacgc.com' target='_blank'>
<font color='808080' size='1'>".$eplug_name." V".$eplug_version."  &reg;</font>
</a>";
//------------------------------------------------------------------------+


$ns -> tablerender($wishlist_title, $wishlist_text);

require_once(FOOTERF);


?>
