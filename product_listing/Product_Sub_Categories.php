<?php

/*
#######################################
#     e107 website system plguin      #
#     Product Listing                 #
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

//----------------------------------------------------------------------------------------------------

if ($action == "det"){


$title = "Sub-Categories";

$text .= "
<div style='text-align:center'>
<br><a href='Product_Categories.php'><center>[ Go Back ]</center></a><br>
<table style='width:95%' >
";

$sql->db_Select("product_listing_subcat", "*", "product_cat='".intval($sub_action)."' ORDER BY product_subcat_name ASC");    
while($row = $sql->db_Fetch()){

$text .= "<tr>
<td style='width:750%' class='forumheader3'><center>
<a href='Products.php?det.".$row['product_subcat_id']."'><font color='' size='4'>".$row['product_subcat_name']."</font>
</td>
</tr>
";}

$text .= "
</table>
";
//----#AACGC Plugin Copyright&reg; - DO NOT REMOVE BELOW THIS LINE! - #-------+
require(e_PLUGIN . 'product_listing/plugin.php');
$text .= "<br><br><br><br><br><br><br>
<a href='http://www.aacgc.com' target='_blank'>
<font color='#808080' size='1'>".$eplug_name." V".$eplug_version."  &reg;</font>
</a>";
//------------------------------------------------------------------------+


$ns -> tablerender($title, $text);}

//----------------------------------------------------------------------------------------------------


require_once(FOOTERF);



