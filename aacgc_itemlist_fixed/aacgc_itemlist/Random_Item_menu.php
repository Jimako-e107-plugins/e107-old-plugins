<?php

/*
#######################################
#     e107 website system plguin      #
#     AACGC Item List                 #
#     by M@CH!N3                      #
#     http://www.aacgc.com            #
#######################################
*/


if (e_QUERY) {
        $tmp = explode('.', e_QUERY);
        $action = $tmp[0];
        $sub_action = $tmp[1];
        $id = $tmp[2];
        unset($tmp);
}
if ($pref['itemlist_enable_theme'] == "1")
{$themea = "forumheader3";
$themeb = "indent";}
else
{$themea = "";
$themeb = "";}

$imgsize = "".$pref['itemlist_randommenuimgsize']."";

if($pref['itemlist_randommenucat'] == "All Categories"){
$cat = "";}
else
{$cat = "".$pref['itemlist_randommenucat']."";}

//----------------------------------------------------------------------------------------------------

$randitemlist_title = "Random Store Item";

//----------------------------------------------------------------------------------------------------


$randitemlist_text .= "<table style='width:95%' class='".$themeb."'><tr><td style='width:100%' class='".$themea."'><center>";

$sql->db_Select("aacgc_itemlist", "*", "item_cat='".$cat."' ORDER BY rand() LIMIT 0,1");    
while($row = $sql->db_Fetch()){

if ($row['item_image'] == "")
{$image = "".e_PLUGIN."aacgc_itemlist/images/NoPhotoAvailable.jpg";}
else
{$image = "".$row['item_image']."";}

if ($row['item_link'] == "")
{$linkstart = "";
$linkend = "";}
else
{$linkstart = "<a href='".$row['item_link']."' target='_blank'>";
$linkend = "</a>";}


$randitemlist_text .= "".$linkstart."<font size='3'>".$row['item_name']."</font>".$linkend."<br>";

if ($pref['itemlist_enable_randmenupreview'] == "1"){
$randitemlist_text .= "".$linkstart."<img width='".$imgsize."px' src='".$image."'></img>".$linkend."<br>";}

$randitemlist_text .= "<font color='".$pref['itemlist_itempricefcolor']."' size='1'><b>".$row['item_price']."</b></font>";}



$randitemlist_text .= "</td></tr></table>";

$ns -> tablerender($randitemlist_title, $randitemlist_text);

//----------------------------------------------------------------------------------------------------


?>