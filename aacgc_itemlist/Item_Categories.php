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

if($pref['itemlist_catcols'] == "")
{$width = "width:100%";
$cols = "1";}
if($pref['itemlist_catcols'] == "1"){
$width = "width:100%";
$cols = "1";}
if($pref['itemlist_catcols'] == "2"){
$width = "width:50%";
$cols = "2";}
if($pref['itemlist_catcols'] == "3"){
$width = "width:33%";
$cols = "3";}
if($pref['itemlist_catcols'] == "4"){
$width = "width:25%";
$cols = "4";}
if($pref['itemlist_catcols'] == "5"){
$width = "width:20%";
$cols = "5";}

$title = "".$pref['itemlist_catpagetitle']."";

$text .= "<table style='width:100%' class='".$themeb."'>
          <tr>
          <td class='".$themeb."'><center>
          <font color='".$pref['itemlist_catpageheaderfcolor']."' size='".$pref['itemlist_catpageheaderfsize']."'>".$pref['itemlist_catpageheader']."</font>
          <br>
          <font color='".$pref['itemlist_catpageintrofcolor']."' size='".$pref['itemlist_catpageintrofsize']."'>".$pref['itemlist_catpageintro']."</font>
          </center></td>
          </tr></table><br><br>";

$text .= "<table style='width:100%' class='".$themeb."'>
          <tr>";

$sql->mySQLresult = @mysql_query("SELECT * FROM ".MPREFIX."aacgc_itemlist_cat ORDER BY item_cat_id");
$rows = $sql->db_Rows();
$pcol = 1;
for ($i = 0; $i < $rows; $i++){
$row = $sql->db_Fetch();

$text .= "<td style='".$width."' class='".$themea."'><center>
<a href='".e_PLUGIN."aacgc_itemlist/Item_List.php?det.".$row['item_cat_id']."'><font color='".$pref['itemlist_catfcolor']."' size='".$pref['itemlist_catfsize']."'><b>".$row['item_cat_name']."</b></font></a>
</center></td>
";


if ($pcol == $pref['itemlist_catcols']) 
{$text .= "</tr><tr>";
$pcol = 1;}
else
{$pcol++;}}


$text .= "</tr></table>";



//----#AACGC Plugin Copyright&reg; - DO NOT REMOVE BELOW THIS LINE! - #-------+
require(e_PLUGIN . 'aacgc_itemlist/plugin.php');
$text .= "<br><br><br><br><br><br><br>
<a href='http://www.aacgc.com' target='_blank'>
<font color='#808080' size='1'>".$eplug_name." V".$eplug_version."  &reg;</font>
</a>";
//------------------------------------------------------------------------+



$ns -> tablerender($title, $text);




require_once(FOOTERF);




?>
