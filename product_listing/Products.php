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


$title = "Products";

$text .= "
<div style='text-align:center'>
<br><a href='Product_Categories.php'><center>[ Go Back ]</center></a><br>
<table style='width:95%' >
<tr>
<td style='width:5%' class='forumheader3'><center>Product ID</center></td>
<td style='width:75%' class='forumheader3'><center>Product</center></td>
<td style='width:20%' class='forumheader3'><center>Price</center></td>
</tr>";

$sql->db_Select("product_listing", "*", "product_cat='".intval($sub_action)."'");    
$rows = $sql->db_Rows();
$pcol = 1;
for ($i = 0; $i < $rows; $i++){
$row = $sql->db_Fetch();

$text .= "
<td style='width:5%' class='indent'><center>
<br>
<font color='' size='1'>".$row['product_id']."</font>
<br>
</td>
<td style='width:750%' class='indent'><center>
<br>
<font color='' size='1'>".$row['product_code']."</font>
<br>
</td>
<td style='width:20%' class='indent'><center>
<br>
<font color='#FF0000' size='4'><b>".$row['product_price']."</b></font>
<br>
</center></td>
</tr>
";



if ($pcol == 1) 
{$text .= "</tr><tr>";
$pcol = 1;}
else
{$pcol++;}}


$text .= "
</tr></table>
";

$ns -> tablerender($title, $text);}

//----------------------------------------------------------------------------------------------------


require_once(FOOTERF);





?>