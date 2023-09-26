<?php

/*
#######################################
#     e107 website system plguin      #
#     AACGC Donation Listing          #
#     by M@CH!N3                      #
#     http://www.aacgc.com            #
#######################################
*/


global $sc_style;


//-------------------------Menu Title--------------------------------+

$latestdmenu_title .= "Last ".$pref['latestdmenu_count']." Donators";

//-------------------------------------------------------------------+



if ($pref['donation_enable_gold'] == "1")
{$gold_obj = new gold();}

//-------------------------Menu News & Info Section-------------------+


if ($pref['latestdmenu_enable_scroll'] == "1"){
$latestdmenu_text .= "<marquee height='".$pref['latestdmenu_height']."px' scrollamount='".$pref['latestdmenu_speed']."' onMouseover='this.scrollAmount=".$pref['latestdmenu_mouseoverspeed']."' onMouseout='this.scrollAmount=".$pref['latestdmenu_mouseoutspeed']."' direction='up' loop='true'>";}



$latestdmenu_text .= "<table style='width:95%' class=''>
        <tr>
        <td style='width:5%'></td>
        <td style='width:85%'><u>User</u></td>
        <td style='width:10%'><u>Amount</u></td>
";
        $n = "0";
        $sql ->db_Select("donation_listing", "*", "ORDER BY don_id DESC LIMIT 0,".$pref['latestdmenu_count']."","");
        while($row = $sql ->db_Fetch()){

        $sql2 = new db;
        $sql2 ->db_Select("user", "*", "user_id='".intval($row['user_id'])."'");
        $row2 = $sql2 ->db_Fetch();

        if ($pref['donation_enable_gold'] == "1")
        {$userorb = "<font color='#00FF00'>".$gold_obj->show_orb($row2['user_id'])."</font>";}
        else
        {$userorb = "".$row2['user_name']."";}
        $n++;

$latestdmenu_text .= "
        <tr>
        <td style='width:5%'>".$n.".</td>
        <td style='width:85%' class=''><a href='".e_BASE."user.php?id.".$row['user_id']."'>".$userorb."</a></td>";

if ($pref['latestdmenu_enable_ammount'] == "1"){
$latestdmenu_text .= "<td style='width:10%'>".$row['user_amount']."</td>";}

$latestdmenu_text .= "</tr>";}




$latestdmenu_text .= "</table>";

if ($pref['latestdmenu_enable_scroll'] == "1"){
$latestdmenu_text .= "</marquee>";}

//--------------------------------------------------------------------+








$ns -> tablerender($latestdmenu_title, $latestdmenu_text);


?>