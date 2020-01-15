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

$count = "".$pref['itemlist_recentmenucount']."";
$imgsize = "".$pref['itemlist_recentmenuimgsize']."";

//----------------------------------------------------------------------------------------------------

$itemlist_title = "".$count." Newest Store Items";

//----------------------------------------------------------------------------------------------------


$itemlist_text .= "<table style='width:95%' class='".$themeb."'>
<tr>";

if ($pref['itemlist_enable_menupreview'] == "1"){
$itemlist_text .= "<td style='width:0%' class='".$themea."'><center>Image</center></td>";}

$itemlist_text .= "<td style='width:100%' class='".$themea."'><center>Name</center></td>
<td style='width:0%' class='".$themea."'><center>Price</center></td>
</tr>";

$sql->db_Select("aacgc_itemlist", "*", "ORDER BY item_id DESC LIMIT 0,".$count."","");    
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

$itemlist_text .= "<tr>";
if ($pref['itemlist_enable_menupreview'] == "1"){
$itemlist_text .= "<td style='width:' class='".$themea."'>".$linkstart."<img width='".$imgsize."px' src='".$image."'></img>".$linkend."</td>";}

$itemlist_text .= "<td style='width:' class='".$themea."'>".$linkstart."".$row['item_name']."".$linkend."</td>
<td style='width:' class='".$themea."'><center><font color='".$pref['itemlist_itempricefcolor']."' size='1'><b>".$row['item_price']."</b></font></td>
</tr>
";}



$itemlist_text .= "</table>";

$ns -> tablerender($itemlist_title, $itemlist_text);

//----------------------------------------------------------------------------------------------------


?>



