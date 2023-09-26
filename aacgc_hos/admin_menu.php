<?php

/*
#######################################
#     AACGC HOS                       #                
#     by M@CH!N3                      #
#     http://www.AACGC.com            #
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



$text1 .= "
</td></tr>
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



$text1 .= "
</td>
</tr>
<tr>
<td style='width:30%' class='button'>";
if (e_PAGE == "admin_new.php") {
$text1 .= "
<b><a style='cursor:hand; cursor:pointer; text-decoration:none;' href='admin_new.php'>>> Add to HOS <<</a></b>";
} else {
 $text1 .="
<a style='cursor:hand; cursor:pointer; text-decoration:none;' href='admin_new.php'>Add to HOS</a>";}



$text1 .= "
</td>
</tr><td style='width:30%' class='header'>-</b>";




$text1 .= "
</td>
</tr>
<tr>
<td style='width:30%' class='button'>";
if (e_PAGE == "admin_edit.php") 
{$text1 .= "
<b>
<a style='cursor:hand; text-decoration:none' href='admin_edit.php'>>> Edit HOS <<</a>
</b>";}
else
{$text1 .= "
<a style='cursor:hand; text-decoration:none' href='admin_edit.php'>Edit HOS</a>";}




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
<a style='cursor:hand; text-decoration:none' href='admin_vupdate.php'>>> Check for Updates <<</a>
</b>";}
else
{$text1 .= "
<a style='cursor:hand; text-decoration:none' href='admin_vupdate.php'>Check for Updates</a>";}




$text1 .= "
            </td>
            </tr>";





$text1 .= "<tr><td><br><br><br><br><br><br>
<center>
Donate To AACGC.
<form action='https://www.paypal.com/cgi-bin/webscr' method='post'>
<input type='hidden' name='cmd' value='_s-xclick'>
<input type='hidden' name='hosted_button_id' value='6506985'>
<input type='image' src='https://www.paypal.com/en_US/i/btn/btn_donateCC_LG.gif' border='0' name='submit' alt='PayPal - The safer, easier way to pay online!'>
<img alt='' border='0' src='https://www.paypal.com/en_US/i/scr/pixel.gif' width='1' height='1'>
</form>
</td></tr>";







$ns -> tablerender($ttl1, $text1);

?>
