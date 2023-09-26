<?php

/*
####################################
#  AACGC Donation Listing          #
#  M@CH!N3 admin@aacgc.com         # 
####################################
*/



global $sc_style;


//-------------------------Menu Title--------------------------------+

$currentdmenu_title .= "This Month's Donators";

//-------------------------------------------------------------------+



if ($pref['donation_enable_gold'] == "1")
{$gold_obj = new gold();}

//-------------------------Menu News & Info Section-------------------+





        $sql ->db_Select("donation_listing_month", "*", "ORDER BY month_id DESC LIMIT 0,1","");
        $row = $sql ->db_Fetch();


$currentdmenu_text .= "<table style='width:95%' class=''><tr>
                       <td colspan=3><center><font color='".$pref['currentdmenu_fcolor']."' size='".$pref['currentdmenu_fsize']."'><b><u>".$row['month_name']."</u></b></td>
                       </tr><tr>
                       <td style='width:10%'></td>
                       <td style='width:80%'><u>User</u></td>";

if ($pref['currentdmenu_enable_ammount'] == "1"){
$currentdmenu_text .= "<td style='width:10%'><u>Amount</u></td>";}

$currentdmenu_text .= "</tr></table>";






if ($pref['currentdmenu_enable_scroll'] == "1"){
$currentdmenu_text .= "<marquee height='".$pref['currentdmenu_height']."px' scrollamount='".$pref['currentdmenu_speed']."' onMouseover='this.scrollAmount=".$pref['currentdmenu_mouseoverspeed']."' onMouseout='this.scrollAmount=".$pref['currentdmenu_mouseoutspeed']."' direction='up' loop='true'>";}

$currentdmenu_text .= "<table style='width:95%' class=''>";

        $n = "0";
        $sql2 = new db;
        $sql2 ->db_Select("donation_listing", "*", "month='".intval($row['month_id'])."' ORDER BY don_id DESC");
        while($row2 = $sql2 ->db_Fetch()){
        $sql3 = new db;
        $sql3 ->db_Select("user", "*", "user_id='".intval($row2['user_id'])."'");
        $row3 = $sql3 ->db_Fetch();

        if ($pref['donation_enable_gold'] == "1")
        {$userorb = "<font color='#00FF00'>".$gold_obj->show_orb($row2['user_id'])."</font>";}
        else
        {$userorb = "".$row2['user_name']."";}
        $n++;

$currentdmenu_text .= "
        <tr>
        <td style='width:5%'>".$n.".</td>
        <td style='width:85%' class=''><a href='".e_BASE."user.php?id.".$row2['user_id']."'>".$userorb."</a></td>";

if ($pref['currentdmenu_enable_ammount'] == "1"){
$currentdmenu_text .= "<td style='width:10%'>".$row2['user_amount']."</td>";}

$currentdmenu_text .= "</tr>";}

$currentdmenu_text .= "</table>";


if ($pref['currentdmenu_enable_scroll'] == "1"){
$currentdmenu_text .= "</marquee>";}



//--------------------------------------------------------------------+


$ns -> tablerender($currentdmenu_title, $currentdmenu_text);


?>
