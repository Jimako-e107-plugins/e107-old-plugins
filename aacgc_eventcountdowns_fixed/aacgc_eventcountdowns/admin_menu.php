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



$text1 .= "</tr> <tr>";


if (e_PAGE == "admin_config.php") 
{$text1 .= "<td style='width:30%' class='button'><b><a style='cursor:hand; text-decoration:none' href='admin_config.php'>>> ".ACR_02." <<</a></b></td>";}
else
{$text1 .= "<td style='width:30%' class='button'><a style='cursor:hand; text-decoration:none' href='admin_config.php'>".ACR_02."</a></td>";}


$text1 .= "</tr> <tr>";
	
	
if (e_PAGE == "admin_events.php") 
{$text1 .= "<td style='width:30%' class='button'><b><a style='cursor:hand; text-decoration:none' href='admin_events.php'>>> ".ACR_04." <<</a></b></td>";}
else
{$text1 .= "<td style='width:30%' class='button'><a style='cursor:hand; text-decoration:none' href='admin_events.php'>".ACR_04."</a></td>";}



$text1 .= "</tr><tr>";
	
 

$text1 .= "</tr>";
	   
$text1 .= "</table>";

  
 


$ns -> tablerender($ttl1, $text1);

?>
