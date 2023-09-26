<?php

/*
#######################################
#     e107 website system plguin      #
#     AACGC Advance Roster            #
#     by M@CH!N3                      #
#     http://www.aacgc.com            #
#######################################
*/



$title .= "Menu";

$text .= "<table class='fborder' style='width:100%;'>";
//-----------------------------------------------------------------------------------------------------------+

$text .= "<tr><td style='width:30%' class='button'>";

        if (e_PAGE == "admin_main.php") 
        {$text .= "<a style='cursor:hand; text-decoration:none' href='admin_main.php'><b>>> Main <<</b></a>";}
        else
        {$text .= "<a style='cursor:hand; text-decoration:none' href='admin_main.php'>Main</a>";}

$text .= "</td></tr>";

//-----------------------------------------------------------------------------------------------------------+

   
$text .= "<tr><td class=''><b>Main Settings</b></td></tr>";

   	

$text .= "<tr><td style='width:30%' class='button'>";

        if (e_PAGE == "admin_config.php") 
        {$text .= "<b><a style='cursor:hand; text-decoration:none' href='admin_config.php'>>> Main Settings <<</a></b>";}
        else
        {$text .= "<a style='cursor:hand; text-decoration:none' href='admin_config.php'>Main Settings</a>";}

$text .= "</td></tr>";



$text .= "<tr><td style='width:30%' class='header'><br></td></tr>";


$text .= "<tr><td style='width:30%' class='button'>";

        if (e_PAGE == "admin_config_showcase.php") 
        {$text .= "<b><a style='cursor:hand; text-decoration:none' href='admin_config_showcase.php'>>> Showcase Settings <<</a></b>";}
        else
        {$text .= "<a style='cursor:hand; text-decoration:none' href='admin_config_showcase.php'>Showcase Settings</a>";}

$text .= "</td></tr>";


$text .= "<tr><td style='width:30%' class='header'><br></td></tr>";


$text .= "<tr><td style='width:30%' class='button'>";

        if (e_PAGE == "admin_config_iconpaths.php") 
        {$text .= "<b><a style='cursor:hand; text-decoration:none' href='admin_config_iconpaths.php'>>> Icon Path Settings <<</a></b>";}
        else
        {$text .= "<a style='cursor:hand; text-decoration:none' href='admin_config_iconpaths.php'>Icon Path Settings</a>";}

$text .= "</td></tr>";


$text .= "<tr><td style='width:30%' class='header'><br></td></tr>";



//-----------------------------------------------------------------------------------------------------------+


$text .= "<tr><td class=''><b>Category Options</b></td></tr>";

$text .= "<tr><td style='width:30%' class='button'>";

if (e_PAGE == "admin_new_cat.php") 
{$text .= "<b><a style='cursor:hand; cursor:pointer; text-decoration:none;' href='admin_new_cat.php'>>> Create Category <<</a></b>";} 
else
{$text .="<a style='cursor:hand; cursor:pointer; text-decoration:none;' href='admin_new_cat.php'>Create Category</a>";}

$text .= "</td></tr>";



$text .= "<td style='width:30%' class='header'><br></td></tr>";




$text .= "<tr><td style='width:30%' class='button'>";

if (e_PAGE == "admin_edit_cat.php") 
{$text .= "<b><a style='cursor:hand; text-decoration:none' href='admin_edit_cat.php'>>> Edit Category <<</a></b>";}
else
{$text .= "<a style='cursor:hand; text-decoration:none' href='admin_edit_cat.php'>Edit Category</a>";}

$text .= "</td></tr>";



$text .= "<td style='width:30%' class='header'><br></td></tr>";



//-----------------------------------------------------------------------------------------------------------+




$text .= "<tr><td class=''><b>Game Options</b></td></tr>";



$text .= "<tr><td style='width:30%' class='button'>";

if (e_PAGE == "admin_new.php") 
{$text .= "<b><a style='cursor:hand; cursor:pointer; text-decoration:none;' href='admin_new.php'>>> Add Game <<</a></b>";}
else
{$text .="<a style='cursor:hand; cursor:pointer; text-decoration:none;' href='admin_new.php'>Add Game</a>";}

$text .= "</td></tr>";



$text .= "<td style='width:30%' class='header'><br></td></tr>";




$text .= "<tr><td style='width:30%' class='button'>";

if (e_PAGE == "admin_edit.php") 
{$text .= "<b><a style='cursor:hand; text-decoration:none' href='admin_edit.php'>>> Edit Game <<</a></b>";}
else
{$text .= "<a style='cursor:hand; text-decoration:none' href='admin_edit.php'>Edit Game</a>";}

$text .= "</td></tr>";



$text .= "<td style='width:30%' class='header'><br></td></tr>";



$text .= "<tr><td style='width:30%' class='button'>";

if (e_PAGE == "admin_editusers.php") 
{$text .= "<b><a style='cursor:hand; text-decoration:none' href='admin_editusers.php'>>> Remove Users <<</a></b>";}
else
{$text .= "<a style='cursor:hand; text-decoration:none' href='admin_editusers.php'>Remove Users</a>";}


$text .= "</td></tr>";



$text .= "<td style='width:30%' class='header'><br></td></tr>";



//-----------------------------------------------------------------------------------------------------------+



$text .= "<tr><td class=''><b>Mark Options</b></td></tr>";




$text .= "<tr><td style='width:30%' class='button'>";

if (e_PAGE == "admin_new_mark.php") 
{$text .= "<b><a style='cursor:hand; cursor:pointer; text-decoration:none;' href='admin_new_mark.php'>>> Create Mark <<</a></b>";}
else
{$text .="<a style='cursor:hand; cursor:pointer; text-decoration:none;' href='admin_new_mark.php'>Create Mark</a>";}

$text .= "</td></tr>";




$text .= "<td style='width:30%' class='header'><br></td></tr>";




$text .= "<tr><td style='width:30%' class='button'>";

if (e_PAGE == "admin_edit_mark.php") 
{$text .= "<b><a style='cursor:hand; text-decoration:none' href='admin_edit_mark.php'>>> Edit Mark <<</a></b>";}
else
{$text .= "<a style='cursor:hand; text-decoration:none' href='admin_edit_mark.php'>Edit Mark</a>";}

$text .= "</td></tr>";



$text .= "<td style='width:30%' class='header'><br></td></tr>";



$text .= "<tr><td style='width:30%' class='button'>";

if (e_PAGE == "admin_new_marked.php") {
$text .= "
<b><a style='cursor:hand; cursor:pointer; text-decoration:none;' href='admin_new_marked.php'>>> Mark Game <<</a></b>";
} else {
 $text .="
<a style='cursor:hand; cursor:pointer; text-decoration:none;' href='admin_new_marked.php'>Mark Game</a>";}

$text .= "</td></tr>";




$text .= "<td style='width:30%' class='header'><br></td></tr>";




$text .= "<tr><td style='width:30%' class='button'>";

if (e_PAGE == "admin_edit_marked.php") 
{$text .= "<b><a style='cursor:hand; text-decoration:none' href='admin_edit_marked.php'>>> Un-Mark Game <<</a></b>";}
else
{$text .= "<a style='cursor:hand; text-decoration:none' href='admin_edit_marked.php'>Un-Mark Game</a>";}

$text .= "</td></tr>";




$text .= "<td style='width:30%' class='header'><br></td></tr>";



//-----------------------------------------------------------------------------------------------------------+




$text .= "<tr><td class=''><b>Other AACGC Plugin Support</b></td></tr>";



$text .= "<tr><td style='width:30%' class='button'>";

        if (e_PAGE == "admin_config_other.php") 
        {$text .= "<b><a style='cursor:hand; text-decoration:none' href='admin_config_other.php'>>> Settings <<</a></b>";}
        else
        {$text .= "<a style='cursor:hand; text-decoration:none' href='admin_config_other.php'>Settings</a>";}

$text .= "</td></tr>";



$text .= "<td style='width:30%' class='header'><br></td></tr>";

if ($pref['gamelist_enable_cmms'] == "1"){
$text .= "<tr><td style='width:30%' class='button'>";


if (e_PAGE == "admin_link_cmms.php") 
{$text .= "<b><a style='cursor:hand; cursor:pointer; text-decoration:none;' href='admin_link_cmms.php'>>> Link CMMS <<</a></b>";}
else
{$text .="<a style='cursor:hand; cursor:pointer; text-decoration:none;' href='admin_link_cmms.php'>Link CMMS</a>";}

$text .= "</td></tr>";

$text .= "<td style='width:30%' class='header'><br></td></tr>";}



if ($pref['gamelist_enable_clanlist'] == "1"){
$text .= "<tr><td style='width:30%' class='button'>";

if (e_PAGE == "admin_link_clan.php") 
{$text .= "<b><a style='cursor:hand; cursor:pointer; text-decoration:none;' href='admin_link_clan.php'>>> Link Clan <<</a></b>";}
else
{$text .="<a style='cursor:hand; cursor:pointer; text-decoration:none;' href='admin_link_clan.php'>Link Clan</a>";}

$text .= "</td></tr>";

$text .= "<td style='width:30%' class='header'><br></td></tr>";}



if ($pref['gamelist_enable_gameservers'] == "1"){

$text .= "<tr><td style='width:30%' class='button'>";

if (e_PAGE == "admin_link_gameserver.php") 
{$text .= "<b><a style='cursor:hand; cursor:pointer; text-decoration:none;' href='admin_link_gameserver.php'>>> Link Game Server <<</a></b>";}
else
{$text .="<a style='cursor:hand; cursor:pointer; text-decoration:none;' href='admin_link_gameserver.php'>Link Game Server</a>";}

$text .= "</td></tr>";

$text .= "<td style='width:30%' class='header'><br></td></tr>";}




if ($pref['gamelist_enable_product'] == "1"){

$text .= "<tr><td style='width:30%' class='button'>";

if (e_PAGE == "admin_link_product.php") 
{$text .= "<b><a style='cursor:hand; cursor:pointer; text-decoration:none;' href='admin_link_product.php'>>> Link Product Category <<</a></b>";}
else
{$text .="<a style='cursor:hand; cursor:pointer; text-decoration:none;' href='admin_link_product.php'>Link Product Category</a>";}

$text .= "</td></tr>";

$text .= "<td style='width:30%' class='header'><br></td></tr>";}


//----------------------------------------#Update/FAQ/Bugtracker Button#-------------------------------------------------------------



$text .= "<tr><td class=''><b>Update / Help / Donate</b></td></tr>";


$text .= "
</td>
</tr>
<tr>
<td style='width:30%' class='button'>";
if (e_PAGE == "admin_vupdate.php") 
{$text .= "
<b>
<a style='cursor:hand; text-decoration:none' href='admin_vupdate.php'>>> Check For Updates <<</a>
</b>";}
else
{$text .= "
<a style='cursor:hand; text-decoration:none' href='admin_vupdate.php'>Check For Updates</a>";}

$text .= "</td></tr>";

$text .= "<tr><td style='width:30%' class='header'><br></td></tr>";


$text .= "<tr><td style='width:30%' class='button'>
           <a style='cursor:hand; text-decoration:none' href='http://www.aacgc.com/SSGC/e107_plugins/faq/faq.php' target='_blank'>AACGC FAQs</a>
           </td></tr>";

$text .= "<tr><td style='width:30%' class='header'><br></td></tr>";

$text .= "<tr><td style='width:30%' class='button'>
           <a style='cursor:hand; text-decoration:none' href='http://www.aacgc.com/SSGC/e107_plugins/helpdesk3_menu/helpdesk.php' target='_blank'>AACGC BugTracker</a>
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
