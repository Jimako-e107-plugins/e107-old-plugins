<?php


/*
#######################################
#     e107 website system plguin      #
#     Product Listing                 #
#     by M@CH!N3                      #
#     http://www.aacgc.com            #
#######################################
*/



$pl_title = "Product Categories = Choose Your Section Below";

$pl_text .= "
<table style='width:95%' class=''><tr>";


$sql->mySQLresult = @mysql_query("SELECT * FROM ".MPREFIX."product_listing_cat ORDER BY product_cat_id ASC");
$rows = $sql->db_Rows();
$pcol = 1;
for ($i = 0; $i < $rows; $i++){
$row = $sql->db_Fetch();

$pl_text .= "
<td style='width:25%' class='indent'><center>
<br>
<a href='Products.php?det.".$row['product_cat_id']."'><font color='#2B65EC' size='3'><b>".$row['product_cat_name']."</b></font></a>
<br>
</center></td>";

if ($pcol == 1) 
{$pl_text .= "</tr><tr>";
$pcol = 1;}
else
{$pcol++;}}


$pl_text .= "
</tr></table>
";






$ns -> tablerender($pl_title, $pl_text);



?>

