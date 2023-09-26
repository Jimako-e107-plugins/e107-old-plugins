<?php

/*
#######################################
#     e107 website system plguin      #
#     AACGC Donation Listing          #
#     by M@CH!N3                      #
#     http://www.aacgc.com            #
#######################################
*/

require_once("../../class2.php");
require_once(HEADERF);


if ($pref['donation_enable_gold'] == "1")
{$gold_obj = new gold();}


//---------------------------------------------------------------------------------

$title .= "".$pref['donation_pagetitle'].""; 

//---------------------------------------------------------------------------------


$text .= "<table style='width:60%' class=''>";

        $sql ->db_Select("donation_listing_year", "*", "ORDER BY year_id DESC","");
        while($row = $sql ->db_Fetch()){


$text .= "<tr>
          <td class='forumheader3' colspan=3>
        <center><font color='".$pref['donation_pagefyearc']."' size='".$pref['donation_pagefyears']."'><u>".$row['year_name']."</u></font>
          </td>
          </tr>";


        $sql2 = new db;
        $sql2 ->db_Select("donation_listing_month", "*", "year='".intval($row['year_id'])."' ORDER BY month_id DESC");
        while($row2 = $sql2 ->db_Fetch()){
 


$text .= "<tr>
          <td class='forumheader3' colspan=3>
          <center><font color='".$pref['donation_pagefmonthc']."' size='".$pref['donation_pagefmonths']."'>".$row2['month_name']."</font>
          </td>
          </tr><tr>
          <td style='width:10%' class='forumheader3'><b><u>Day</b></u></td>
          <td style='width:80%' class='forumheader3'><center><b><u>Member Name</b></u></center></td>
          <td style='width:10%' class='forumheader3'><b><u>Amount</b></u></td>
          </tr>";

    
         
        $sql3 = new db;
        $sql3 ->db_Select("donation_listing", "*", "month='".intval($row2['month_id'])."' ORDER BY don_id DESC");
        while($row3 = $sql3 ->db_Fetch()){

        $sql4 = new db;
        $sql4 ->db_Select("user", "*", "user_id='".intval($row3['user_id'])."'");
        $row4 = $sql4 ->db_Fetch();
    


if ($pref['donation_enable_gold'] == "1")
{$username = "<font color='#00FF00'>".$gold_obj->show_orb($row3['user_id'])."</font>";}
else
{$username = "".$row4['user_name']."";}

$text .= "
        <tr>
        <td style='width:' class='indent'>".$row3['user_day']."</td>
        <td style='width:' class='indent'><center><a href='".e_BASE."user.php?id.".$row3['user_id']."'>".$username."</a></center></td>
        <td style='width:' class='indent'>".$row3['user_amount']."</td>
        </tr>";}}}

$text .= "
        </table>
        ";









//----#AACGC Plugin Copyright&reg; - DO NOT REMOVE BELOW THIS LINE! - #-------+
require(e_PLUGIN . 'donation_listing/plugin.php');
$text .= "<br><br><br><br><br><br><br>
<a href='http://www.aacgc.com' target='_blank'>
<font color='808080' size='1'>".$eplug_name." V".$eplug_version."  &reg;</font>
</a>";
//------------------------------------------------------------------------+





$ns -> tablerender($title, $text);











//----------------------------------------------------------------------------------

require_once(FOOTERF);



?>