<?php

/*
#######################################
#     AACGC Payment Tracker           #                
#     by M@CH!N3                      #
#     http://www.AACGC.com            #
#######################################
*/


//-----------------------------------------------------------------------------------------------------------+
include_lan(e_PLUGIN."aacgc_paytrack/languages/".e_LANGUAGE.".php");
//-----------------------------------------------------------------------------------------------------------+

         	

$text1 .= "<table class='fborder' style='width:100%'>";
$text1 .= "<tr>";
        


if (e_PAGE == "admin_main.php") 
{$text1 .= "<td style='width:30%' class='button'><b><a style='cursor:hand; text-decoration:none' href='admin_main.php'>>> ".APT_14." <<</a></b></td>";}
else
{$text1 .= "<td style='width:30%' class='button'><a style='cursor:hand; text-decoration:none' href='admin_main.php'>".APT_14."</a></td>";}



$text1 .= "</tr><tr>
	   <td style='width:30%' class='header'><b>-</b></td>
	   </tr><tr>";


if (e_PAGE == "admin_config.php") 
{$text1 .= "<td style='width:30%' class='button'><b><a style='cursor:hand; text-decoration:none' href='admin_config.php'>>> ".APT_15." <<</a></b></td>";}
else
{$text1 .= "<td style='width:30%' class='button'><a style='cursor:hand; text-decoration:none' href='admin_config.php'>".APT_15."</a></td>";}




$text1 .= "</tr><tr>
	   <td style='width:30%' class='header'><b>-</b></td>
	   </tr><tr>";




if (e_PAGE == "admin_new_cat.php") 
{$text1 .= "<td style='width:30%' class='button'><b><a style='cursor:hand; text-decoration:none' href='admin_new_cat.php'>>> ".APT_18." <<</a></b></td>";}
else
{$text1 .= "<td style='width:30%' class='button'><a style='cursor:hand; text-decoration:none' href='admin_new_cat.php'>".APT_18."</a></td>";}



$text1 .= "</tr><tr>
	   <td style='width:30%' class='header'><b>-</b></td>
	   </tr><tr>";




if (e_PAGE == "admin_edit_cat.php") 
{$text1 .= "<td style='width:30%' class='button'><b><a style='cursor:hand; text-decoration:none' href='admin_edit_cat.php'>>> ".APT_19." <<</a></b></td>";}
else
{$text1 .= "<td style='width:30%' class='button'><a style='cursor:hand; text-decoration:none' href='admin_edit_cat.php'>".APT_19."</a></td>";}



$text1 .= "</tr><tr>
	   <td style='width:30%' class='header'><b>-</b></td>
	   </tr><tr>";





if (e_PAGE == "admin_edit_catorder.php") 
{$text1 .= "<td style='width:30%' class='button'><b><a style='cursor:hand; text-decoration:none' href='admin_edit_catorder.php'>>> ".APT_20." <<</a></b></td>";}
else
{$text1 .= "<td style='width:30%' class='button'><a style='cursor:hand; text-decoration:none' href='admin_edit_catorder.php'>".APT_20."</a></td>";}



$text1 .= "</tr><tr>
	   <td style='width:30%' class='header'><b>-</b></td>
	   </tr><tr>";




if (e_PAGE == "admin_edit_mem.php") 
{$text1 .= "<td style='width:30%' class='button'><b><a style='cursor:hand; text-decoration:none' href='admin_edit_mem.php'>>> ".APT_17." <<</a></b></td>";}
else
{$text1 .= "<td style='width:30%' class='button'><a style='cursor:hand; text-decoration:none' href='admin_edit_mem.php'>".APT_17."</a></td>";}



$text1 .= "</tr><tr>
	   <td style='width:30%' class='header'><b>-</b></td>
	   </tr><tr>";




if (e_PAGE == "admin_new_mem.php") 
{$text1 .= "<td style='width:30%' class='button'><b><a style='cursor:hand; text-decoration:none' href='admin_new_mem.php'>>> ".APT_16." <<</a></b></td>";}
else
{$text1 .= "<td style='width:30%' class='button'><a style='cursor:hand; text-decoration:none' href='admin_new_mem.php'>".APT_16."</a></td>";}



$text1 .= "</tr><tr>
	   <td style='width:30%' class='header'><b>-</b></td>
	   </tr><tr>";




if (e_PAGE == "admin_vupdate.php") 
{$text1 .= "<td style='width:30%' class='button'><b><a style='cursor:hand; text-decoration:none' href='admin_vupdate.php'>>> ".APT_23." <<</a></b></td>";}
else
{$text1 .= "<td style='width:30%' class='button'><a style='cursor:hand; text-decoration:none' href='admin_vupdate.php'>".APT_23."</a></td>";}



$text1 .= "</tr><tr>
	   <td style='width:30%' class='header'><b>-</b></td>
	   </tr><tr>";




$text1 .= "<td><br>
<center>
Donate To AACGC.
<form action='https://www.paypal.com/cgi-bin/webscr' method='post'>
<input type='hidden' name='cmd' value='_s-xclick'>
<input type='hidden' name='hosted_button_id' value='6506985'>
<input type='image' src='https://www.paypal.com/en_US/i/btn/btn_donateCC_LG.gif' border='0' name='submit' alt='PayPal - The safer, easier way to pay online!'>
<img alt='' border='0' src='https://www.paypal.com/en_US/i/scr/pixel.gif' width='1' height='1'>
</form>
</td>";



$text1 .= "</tr>";
$text1 .= "</table>";



$ns -> tablerender($ttl1, $text1);

?>
