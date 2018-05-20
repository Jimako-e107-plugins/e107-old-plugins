<?php

/*
#######################################
#     e107 website system plguin      #
#     AACGC Public News               #
#     by M@CH!N3                      #
#     http://www.aacgc.com            #
#######################################
*/


include_lan(e_PLUGIN."aacgc_pnews/languages/".e_LANGUAGE.".php");



$title .= "Menu";

$text .= "<table class='fborder' style='width:100%;'>";

//-----------------------------------------------------------------------------------------------------------+
   

$text .= "<tr><td><b>Main</b></td></tr>";

   	

$text .= "<tr><td style='width:30%' class='button'>";

        if (e_PAGE == "admin_main.php") 
        {$text .= "<a style='cursor:hand; text-decoration:none' href='admin_main.php'><b>>> ".APNEWS_83." <<</b></a>";}
        else
        {$text .= "<a style='cursor:hand; text-decoration:none' href='admin_main.php'>".APNEWS_83."</a>";}

$text .= "</td></tr>";




$text .= "<tr><td style='width:30%' class='header'><br></td></tr>";




$text .= "<tr><td style='width:30%' class='button'>";

        if (e_PAGE == "admin_config.php") 
        {$text .= "<b><a style='cursor:hand; text-decoration:none' href='admin_config.php'>>> ".APNEWS_84." <<</a></b>";}
        else
        {$text .= "<a style='cursor:hand; text-decoration:none' href='admin_config.php'>".APNEWS_84."</a>";}

$text .= "</td></tr>";



$text .= "<tr><td style='width:30%' class='header'><br></td></tr>";



//-----------------------------------------------------------------------------------------------------------+



$text .= "<tr><td><b>Category Options</b></td></tr>";

$text .= "<tr><td style='width:30%' class='button'>";

if (e_PAGE == "admin_new_cat.php") 
{$text .= "<b><a style='cursor:hand; cursor:pointer; text-decoration:none;' href='admin_new_cat.php'>>> ".APNEWS_85." <<</a></b>";} 
else
{$text .="<a style='cursor:hand; cursor:pointer; text-decoration:none;' href='admin_new_cat.php'>".APNEWS_85."</a>";}

$text .= "</td></tr>";



$text .= "<td style='width:30%' class='header'><br></td></tr>";




$text .= "<tr><td style='width:30%' class='button'>";

if (e_PAGE == "admin_edit_cat.php") 
{$text .= "<b><a style='cursor:hand; text-decoration:none' href='admin_edit_cat.php'>>> ".APNEWS_86." <<</a></b>";}
else
{$text .= "<a style='cursor:hand; text-decoration:none' href='admin_edit_cat.php'>".APNEWS_86."</a>";}

$text .= "</td></tr>";



$text .= "<td style='width:30%' class='header'><br></td></tr>";




//-----------------------------------------------------------------------------------------------------------+




$text .= "<tr><td><b>News Options</b></td></tr>";



$text .= "<tr><td style='width:30%' class='button'>";

if (e_PAGE == "admin_new.php") 
{$text .= "<b><a style='cursor:hand; cursor:pointer; text-decoration:none;' href='admin_new.php'>>> ".APNEWS_87." <<</a></b>";}
else
{$text .="<a style='cursor:hand; cursor:pointer; text-decoration:none;' href='admin_new.php'>".APNEWS_87."</a>";}

$text .= "</td></tr>";



$text .= "<td style='width:30%' class='header'><br></td></tr>";



$text .= "<tr><td style='width:30%' class='button'>";

if (e_PAGE == "admin_edit.php") 
{$text .= "<b><a style='cursor:hand; text-decoration:none' href='admin_edit.php'>>> ".APNEWS_88." <<</a></b>";}
else
{$text .= "<a style='cursor:hand; text-decoration:none' href='admin_edit.php'>".APNEWS_88."</a>";}

$text .= "</td></tr>";



$text .= "<td style='width:30%' class='header'><br></td></tr>";



$text .= "<tr><td style='width:30%' class='button'>";

if (e_PAGE == "admin_subnews.php") 
{$text .= "<b><a style='cursor:hand; text-decoration:none' href='admin_subnews.php'>>> ".APNEWS_89." <<</a></b>";}
else
{$text .= "<a style='cursor:hand; text-decoration:none' href='admin_subnews.php'>".APNEWS_89."</a>";}

$text .= "</td></tr>";



$text .= "<td style='width:30%' class='header'><br></td></tr>";




//-----------------------------------------------------------------------------------------------------------+






//----------------------------------------#Update/FAQ/Bugtracker Button#-------------------------------------------------------------



$text .= "<tr><td><b>Update / Help / Donate</b></td></tr>";


$text .= "
</td>
</tr>
<tr>
<td style='width:30%' class='button'>";
if (e_PAGE == "admin_vupdate.php") 
{$text .= "
<b>
<a style='cursor:hand; text-decoration:none' href='admin_vupdate.php'>>> ".APNEWS_90." <<</a>
</b>";}
else
{$text .= "
<a style='cursor:hand; text-decoration:none' href='admin_vupdate.php'>".APNEWS_90."</a>";}

$text .= "</td></tr>";

$text .= "<tr><td style='width:30%' class='header'><br></td></tr>";


$text .= "<tr><td style='width:30%' class='button'>
           <a style='cursor:hand; text-decoration:none' href='http://www.aacgc.com/SSGC/e107_plugins/faq/faq.php' target='_blank'>AACGC FAQs</a>
           </td></tr>";

$text .= "<tr><td style='width:30%' class='header'><br></td></tr>";

$text .= "<tr><td style='width:30%' class='button'>
           <a style='cursor:hand; text-decoration:none' href='http://www.wiki.aacgc.com' target='_blank'>AACGC Wiki</a>
           </td></tr>";


//----------------------------------------#Donation Button#-------------------------------------------------------------


$text .= "<tr><td><br><br><center>
Donate To AACGC.
<form action='https://www.paypal.com/cgi-bin/webscr' method='post'>
<input type='hidden' name='cmd' value='_s-xclick'>
<input type='hidden' name='hosted_button_id' value='6506985'>
<input type='image' src='https://www.paypal.com/en_US/i/btn/btn_donateCC_LG.gif' border='0' name='submit' alt='PayPal - The safer, easier way to pay online!'>
<img alt='' border='0' src='https://www.paypal.com/en_US/i/scr/pixel.gif' width='1' height='1'>
</form>
<br><br></td></tr></table>";



$ns -> tablerender($title, $text);

?>
