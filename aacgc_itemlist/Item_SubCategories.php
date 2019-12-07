<?php

/*
#######################################
#     e107 website system plguin      #
#     AACGC Item List                 #
#     by M@CH!N3                      #
#     http://www.aacgc.com            #
#######################################
*/






require_once("../../class2.php");
require_once(HEADERF);

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
//----------------------------------------------------------------------------------------------------

if ($action == "det"){

$sql2->db_Select("aacgc_itemlist_subcat", "*", "item_subcat_id='".intval($sub_action)."'");    
$row2 = $sql2->db_Fetch();

$title = "".$pref['itemlist_subcatpagetitle']."";

$text .= "
<div style='text-align:center'>
<br><a href='".e_PLUGIN."aacgc_itemlist/Item_Categories.php'><center>[ Back To Categories ]</center></a><br>
<table style='width:95%' class='".$themeb."'>
<tr>
<td style='width:' class='".$themea."' colspan=4><center><font color='".$pref['itemlist_subcatfcolor']."' size='".$pref['itemlist_subcatfsize']."'>".$row2['item_subcat_name']."</font></center></td>
</tr>
<tr>
<td style='width:' class='' colspan=4><center><font color='".$pref['itemlist_subcatdetfcolor']."' size='".$pref['itemlist_subcatdetfsize']."'>".$row2['item_subcat_details']."</font></center></td>
</tr>
</table><br>";


$text .= "
<br><table style='width:95%' class='".$themeb."'>
<tr>
<td style='width:' class='".$themea."'><center>ID</center></td>
<td style='width:25%' class='".$themea."'><center>Name / Image</center></td>
<td style='width:75%' class='".$themea."'><center>Details</center></td>
<td style='width:' class='".$themea."'><center>Price</center></td>
</tr>";

$sql->db_Select("aacgc_itemlist", "*", "item_subcat='".intval($sub_action)."' ORDER BY item_name ASC");    
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

$text .= "<tr>
<td style='width:' class='".$themea."'><center>".$row['item_id']."</td>
<td style='width:' class='".$themea."'><center><font color='".$pref['itemlist_itemnamefcolor']."' size='".$pref['itemlist_itemnamefsize']."'>".$row['item_name']."</font><br>".$linkstart."<img width='".$pref['itemlist_itemimgsize']."px' src='".$image."'></img>".$linkend."</td>
<td style='width:' class='".$themea."'><font color='".$pref['itemlist_itemdetailfcolor']."' size='".$pref['itemlist_itemdetailfsize']."'>".$row['item_detail']."</font>";

//-----------------------# Item Rating #--------------------------
if ($pref['itemlist_enable_rating'] == "1"){
include_once(e_HANDLER."rate_class.php");
$rater = new rater;
$text .= "<br><span>";
if($rating = $rater->getrating('aacgc_itemlist', $row['item_id'])){
$text .= "Rating: ";
$text .= $rating[2] ? "{$rating[1]}.{$rating[2]}/{$rating[0]}" : "{$rating[1]}/{$rating[0]}";
$text .= "<br>";
$num = $rating[1];
for($i=1; $i<= $num; $i++){
$text .= "<img src='".e_IMAGE_ABS."user_icons/user_star_".IMODE.".png' style='border:0' alt='' />";}}
if(USER){
if(!$rater->checkrated('aacgc_itemlist', $row['item_id'])){
$text .= " &nbsp; &nbsp;".$rater->rateselect('', 'aacgc_itemlist', $row['item_id']);}}
$text .= "</span>";}
//----------------------------------------------------------------

$text .= "</td>
<td style='width:' class='".$themea."'><center><font color='".$pref['itemlist_itempricefcolor']."' size='".$pref['itemlist_itempricefsize']."'><b>".$row['item_price']."</b></font></td>
</tr>
";}



$text .= "</table>";

$ns -> tablerender($title, $text);}

//----------------------------------------------------------------------------------------------------


require_once(FOOTERF);





