<?php

/*
#######################################
#     e107 website system plguin      #
#     AACGC Network Bar               #
#     by Reid Baughman                #
#     http://www.aacgc.com            #
#######################################
*/


//-----------------------------------------------------------------------------------------------------------+
//-----------------------------------------------------------------------------------------------------------+	


$text1 .= "
<table class='fborder' style='width:100%;'>
	<tr>
        <td style='width:30%' class='button'>";
        if (e_PAGE == "admin_main.php") {
        $text1 .= "
		<b>
		<a style='cursor:hand; text-decoration:none' href='admin_main.php'>>> Main <<</a></b>";
        } else {
        $text1 .= "
        <a style='cursor:hand; text-decoration:none' href='admin_main.php'>Main</a>";}



$text1 .= "
           </td>
           </tr><td style='width:30%' class='header'>-</b>";



$text1 .= "</td>
           </tr>
	<tr>
        <td style='width:30%' class='button'>";
        if (e_PAGE == "admin_config.php") {
        $text1 .= "
		<b>
		<a style='cursor:hand; text-decoration:none' href='admin_config.php'>>> Settings <<</a></b>";
        } else {
        $text1 .= "
        <a style='cursor:hand; text-decoration:none' href='admin_config.php'>Settings</a>";}


$text1 .= "
           </td>
           </tr><td style='width:30%' class='header'>-</b>";



$text1 .= "</td>
           </tr>
	<tr>
        <td style='width:30%' class='button'>";
        if (e_PAGE == "admin_new_cat.php") {
        $text1 .= "
		<b>
		<a style='cursor:hand; text-decoration:none' href='admin_new_cat.php'>>> Create Category <<</a></b>";
        } else {
        $text1 .= "
        <a style='cursor:hand; text-decoration:none' href='admin_new_cat.php'>Create Category</a>";}




$text1 .= "
           </td>
           </tr><td style='width:30%' class='header'>-</b>";



$text1 .= "</td>
           </tr>
	<tr>
        <td style='width:30%' class='button'>";
        if (e_PAGE == "admin_edit_cat.php") {
        $text1 .= "
		<b>
		<a style='cursor:hand; text-decoration:none' href='admin_edit_cat.php'>>> Edit Category <<</a></b>";
        } else {
        $text1 .= "
        <a style='cursor:hand; text-decoration:none' href='admin_edit_cat.php'>Edit Category</a>";}




$text1 .= "
           </td>
           </tr><td style='width:30%' class='header'>-</b>";




$text1 .= "</td>
           </tr>
	<tr>
        <td style='width:30%' class='button'>";
        if (e_PAGE == "admin_new_team.php") {
        $text1 .= "
		<b>
		<a style='cursor:hand; text-decoration:none' href='admin_new_team.php'>>> Create Team <<</a></b>";
        } else {
        $text1 .= "
        <a style='cursor:hand; text-decoration:none' href='admin_new_team.php'>Create Team</a>";}




$text1 .= "
           </td>
           </tr><td style='width:30%' class='header'>-</b>";



$text1 .= "</td>
           </tr>
	<tr>
        <td style='width:30%' class='button'>";
        if (e_PAGE == "admin_edit_team.php") {
        $text1 .= "
		<b>
		<a style='cursor:hand; text-decoration:none' href='admin_edit_team.php'>>> Edit Team <<</a></b>";
        } else {
        $text1 .= "
        <a style='cursor:hand; text-decoration:none' href='admin_edit_team.php'>Edit Team</a>";}




$text1 .= "
           </td>
           </tr><td style='width:30%' class='header'>-</b>";



$text1 .= "</td>
           </tr>
	<tr>
        <td style='width:30%' class='button'>";
        if (e_PAGE == "admin_give.php") {
        $text1 .= "
		<b>
		<a style='cursor:hand; text-decoration:none' href='admin_give.php'>>> Add User <<</a></b>";
        } else {
        $text1 .= "
        <a style='cursor:hand; text-decoration:none' href='admin_give.php'>Add User</a>";}


$text1 .= "
           </td>
           </tr><td style='width:30%' class='header'>-</b>";



$text1 .= "</td>
           </tr>
	<tr>
        <td style='width:30%' class='button'>";
        if (e_PAGE == "admin_take.php") {
        $text1 .= "
		<b>
		<a style='cursor:hand; text-decoration:none' href='admin_take.php'>>> Remove User <<</a></b>";
        } else {
        $text1 .= "
        <a style='cursor:hand; text-decoration:none' href='admin_take.php'>Remove User</a>";}




$text1 .= "
           </td>
           </tr><td style='width:30%' class='header'>-</b>";




$text1 .= "</td>
           </tr>
	<tr>
        <td style='width:30%' class='button'>";
        if (e_PAGE == "admin_standings.php") {
        $text1 .= "
		<b>
		<a style='cursor:hand; text-decoration:none' href='admin_standings.php'>>> Adjust Bracket (Add)<<</a></b>";
        } else {
        $text1 .= "
        <a style='cursor:hand; text-decoration:none' href='admin_standings.php'>Adjust Bracket (Add)</a>";}



$text1 .= "
           </td>
           </tr><td style='width:30%' class='header'>-</b>";




$text1 .= "</td>
           </tr>
	<tr>
        <td style='width:30%' class='button'>";
        if (e_PAGE == "admin_standing.php") {
        $text1 .= "
		<b>
		<a style='cursor:hand; text-decoration:none' href='admin_standing.php'>>> Adjust Bracket (Remove)<<</a></b>";
        } else {
        $text1 .= "
        <a style='cursor:hand; text-decoration:none' href='admin_standing.php'>Adjust Bracket (Remove)</a>";}



$text1 .= "
           </td>
           </tr><td style='width:30%' class='header'>-</b>";






$text1 .= "
</td>
</tr>
<tr>
<td style='width:30%' class='button'>";
if (e_PAGE == "admin_vupdate.php") 
{$text1 .= "
<b>
<a style='cursor:hand; text-decoration:none' href='admin_vupdate.php'>>> Check For Updates <<</a>
</b>";}
else
{$text1 .= "
<a style='cursor:hand; text-decoration:none' href='admin_vupdate.php'>Check For Updates</a>";}

$text1 .= "</td>
           </tr>";


//--------------------------------------------------------------------------------------------


$text1 .= "<tr><td><br><br><br><br><br><br>
<center>
Donate To AACGC.
<form action='https://www.paypal.com/cgi-bin/webscr' method='post'>
<input type='hidden' name='cmd' value='_s-xclick'>
<input type='hidden' name='hosted_button_id' value='6506985'>
<input type='image' src='https://www.paypal.com/en_US/i/btn/btn_donateCC_LG.gif' border='0' name='submit' alt='PayPal - The safer, easier way to pay online!'>
<img alt='' border='0' src='https://www.paypal.com/en_US/i/scr/pixel.gif' width='1' height='1'>
</form>
<br><br>
</td></tr>";

$text1 .= "<tr>
           <td style='width:30%' class='button'>
           <b><a style='cursor:hand; text-decoration:none' href='http://www.aacgc.com/SSGC/e107_plugins/faq/faq.php' target='_blank'>AACGC FAQs</a></b>
           </td>
           </tr>";


$text1 .= "<tr><td style='width:30%' class='header'>-</b></td></tr>";


$text1 .= "<tr>
           <td style='width:30%' class='button'>
           <b><a style='cursor:hand; text-decoration:none' href='http://www.aacgc.com/SSGC/e107_plugins/helpdesk3_menu/helpdesk.php' target='_blank'>AACGC HelpDesk</a></b>
           </td>
           </tr>";

//-----------------------------------------------------------------------------------------------------






$ns -> tablerender($ttl1, $text1);

?>
