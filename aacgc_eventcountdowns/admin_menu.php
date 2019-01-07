<?php


/*
#######################################
#     e107 website system plguin      #
#     AACGC Event Countdowns          #    
#     by M@CH!N3                      #
#     http://www.AACGC.com            #
#######################################
*/



//-----------------------------------------------------------------------------------------------------------+
include_lan(e_PLUGIN."aacgc_eventcountdowns/languages/".e_LANGUAGE.".php");
//-----------------------------------------------------------------------------------------------------------+

         	

$text1 .= "<table class='fborder' style='width:100%'>";
$text1 .= "<tr>";
        


if (e_PAGE == "admin_main.php") 
{$text1 .= "<td style='width:30%' class='button'><b><a style='cursor:hand; text-decoration:none' href='admin_main.php'>>> ".ACR_01." <<</a></b></td>";}
else
{$text1 .= "<td style='width:30%' class='button'><a style='cursor:hand; text-decoration:none' href='admin_main.php'>".ACR_01."</a></td>";}



$text1 .= "</tr><tr>
	   <td style='width:30%' class='header'><b>-</b></td>
	   </tr><tr>";


if (e_PAGE == "admin_config.php") 
{$text1 .= "<td style='width:30%' class='button'><b><a style='cursor:hand; text-decoration:none' href='admin_config.php'>>> ".ACR_02." <<</a></b></td>";}
else
{$text1 .= "<td style='width:30%' class='button'><a style='cursor:hand; text-decoration:none' href='admin_config.php'>".ACR_02."</a></td>";}


$text1 .= "</tr><tr>
	   <td style='width:30%' class='header'><b>-</b></td>
	   </tr><tr>";
	
	
if (e_PAGE == "admin_events.php") 
{$text1 .= "<td style='width:30%' class='button'><b><a style='cursor:hand; text-decoration:none' href='admin_events.php'>>> ".ACR_04." <<</a></b></td>";}
else
{$text1 .= "<td style='width:30%' class='button'><a style='cursor:hand; text-decoration:none' href='admin_events.php'>".ACR_04."</a></td>";}



$text1 .= "</tr><tr>
	   <td style='width:30%' class='header'><b>-</b></td>
	   </tr><tr>";
	
	
if (e_PAGE == "admin_vupdate.php") 
{$text1 .= "<td style='width:30%' class='button'><b><a style='cursor:hand; text-decoration:none' href='admin_vupdate.php'>>> ".ACR_03." <<</a></b></td>";}
else
{$text1 .= "<td style='width:30%' class='button'><a style='cursor:hand; text-decoration:none' href='admin_vupdate.php'>".ACR_03."</a></td>";}



$text1 .= "</tr><tr>
	   <td style='width:30%' class='header'><b>-</b></td>
	   </tr>";
	   
$text1 .= "</table>";

  
$text1 .= "<br>
<center>
Donate To AACGC.
<form action='https://www.paypal.com/cgi-bin/webscr' method='post'>
<input type='hidden' name='cmd' value='_s-xclick'>
<input type='hidden' name='hosted_button_id' value='6506985'>
<input type='image' src='https://www.paypal.com/en_US/i/btn/btn_donateCC_LG.gif' border='0' name='submit' alt='PayPal - The safer, easier way to pay online!'>
<img alt='' border='0' src='https://www.paypal.com/en_US/i/scr/pixel.gif' width='1' height='1'>
</form>
";



$ns -> tablerender($ttl1, $text1);

?>
