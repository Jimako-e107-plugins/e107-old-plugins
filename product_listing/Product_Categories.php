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



$title = "Product Categories - Choose Your Section Below";

$text .= "
<table style='width:60%' class=''><tr></tr><tr>";


$sql->mySQLresult = @mysql_query("SELECT * FROM ".MPREFIX."product_listing_cat ORDER BY product_cat_id ASC");
$rows = $sql->db_Rows();
$pcol = 1;
for ($i = 0; $i < $rows; $i++){
$row = $sql->db_Fetch();

$text .= "
<td style='width:100%' class='forumheader3'><center>
<a href='Product_Sub_Categories.php?det.".$row['product_cat_id']."'><font color='' size='3'><b>".$row['product_cat_name']."</b></font></a>
</center></td>
";

if ($pcol == 1) 
{$text .= "</tr><tr>";
$pcol = 1;}
else
{$pcol++;}}


$text .= "
</tr></table>
";



//----#AACGC Plugin Copyright&reg; - DO NOT REMOVE BELOW THIS LINE! - #-------+
require(e_PLUGIN . 'product_listing/plugin.php');
$text .= "<br><br><br><br><br><br><br>
<a href='http://www.aacgc.com' target='_blank'>
<font color='#808080' size='1'>".$eplug_name." V".$eplug_version."  &reg;</font>
</a>";
//------------------------------------------------------------------------+



$ns -> tablerender($title, $text);




require_once(FOOTERF);



//---------------------------------------------------------------------------------------------------------------------




if ($action == "Product")
{

        


        $text .= "
        <div style='text-align:center'>
	<br><a href='Product_Categories.php'><center>[ Go Back ]</center></a><br>
        <table style='width:95%'>
        <tr>
        <td style='width:80px' class='forumheader3'>Product</td>
        <td style='width:100%' class='forumheader3'>Price</td>
        </tr>";
    


$sql->db_Select("product_listing", "*", "product_cat='".intval($sub_action)."'");
$rows = $sql->db_Rows();
$pcol = 1;
for ($i = 0; $i < $rows; $i++){
$row = $sql->db_Fetch();

$text .= "
<td style='width:25%' class='indent'><center>
<br>
".$row['product_code']."
<br>
</td>
<td style='width:25%' class='indent'><center>
<br>
".$row['product_price']."
<br>
</center></td>";

if ($pcol == 1) 
{$text .= "</tr><tr>";
$pcol = 1;}
else
{$pcol++;}}


$text .= "
</tr></table>
";


//----#AACGC Plugin Copyright&reg; - DO NOT REMOVE BELOW THIS LINE! - #-------+
require(e_PLUGIN . 'product_listing/plugin.php');
$text .= "<br><br><br><br><br><br><br>
<a href='http://www.aacgc.com' target='_blank'>
<font color='#808080' size='1'>".$eplug_name." V".$eplug_version."  &reg;</font>
</a>";
//------------------------------------------------------------------------+








$ns -> tablerender($title, $text);

}

require_once(FOOTERF);

?>
