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

$sql2->db_Select("aacgc_itemlist_cat", "*", "item_cat_id='".intval($sub_action)."'");    
$row2 = $sql2->db_Fetch();

$title = "".$pref['itemlist_pagetitle']."";

if($pref['itemlist_subcatcols'] == "")
{$width = "width:100%";
$cols = "1";}
if($pref['itemlist_subcatcols'] == "1"){
$width = "width:100%";
$cols = "1";}
if($pref['itemlist_subcatcols'] == "2"){
$width = "width:50%";
$cols = "2";}
if($pref['itemlist_subcatcols'] == "3"){
$width = "width:33%";
$cols = "3";}
if($pref['itemlist_subcatcols'] == "4"){
$width = "width:25%";
$cols = "4";}
if($pref['itemlist_subcatcols'] == "5"){
$width = "width:20%";
$cols = "5";}



$text .= "
<div style='text-align:center'>
<br><a href='".e_PLUGIN."aacgc_itemlist/Item_Categories.php'><center>[ Go Back ]</center></a><br>
<table style='width:95%' class='".$themeb."'>
<tr>
<td style='width:' class='".$themea."' colspan=4><center><font color='".$pref['itemlist_subitemcatfcolor']."' size='".$pref['itemlist_subitemcatfsize']."'>".$row2['item_cat_name']."</font></center></td>
</tr>
<tr>
<td style='width:' class='' colspan=4><center><font color='".$pref['itemlist_subitemcatdetfcolor']."' size='".$pref['itemlist_subitemcatdetfsize']."'>".$row2['item_cat_details']."</font></center></td>
</tr>
</table><br>";


$text .= "<table style='width:95%' class='".$themeb."'><tr>";

//---------------------# subcategories #-----------------------------

$sql3 = new db;
$sql3->db_Select("aacgc_itemlist_subcat", "*", "item_subcat_cat='".intval($row2['item_cat_id'])."'");    
$rows = $sql3->db_Rows();
$pcol = 1;
for ($i = 0; $i < $rows; $i++){
$row3 = $sql3->db_Fetch();


$text .= "<td class='".$themea."' width='".$width."'><center><a href='".e_PLUGIN."aacgc_itemlist/Item_SubCategories.php?det.".$row3['item_subcat_id']."'>".$row3['item_subcat_name']."</a></center></td>";

if ($pcol == $pref['itemlist_subcatcols']) 
{$text .= "</tr><tr>";
$pcol = 1;}
else
{$pcol++;}}

$text .= "</tr></table>";


//------------------------------------# Items #---------------------------------


$text .= "
<br><table style='width:95%' class='".$themeb."'>
<tr>
<td style='width:' class='".$themea."'><center>ID</center></td>
<td style='width:25%' class='".$themea."'><center>Name / Image</center></td>
<td style='width:75%' class='".$themea."'><center>Details</center></td>
<td style='width:' class='".$themea."'><center>Price</center></td>
</tr>";

$sql->db_Select("aacgc_itemlist", "*", "item_cat='".intval($sub_action)."' ORDER BY item_name ASC");    
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





