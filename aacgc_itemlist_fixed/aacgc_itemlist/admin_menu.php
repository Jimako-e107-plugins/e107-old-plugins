<?php

/*
#######################################
#     e107 website system plguin      #
#     AACGC Item List                 #
#     by M@CH!N3                      #
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
		<a style='cursor:hand; text-decoration:none' href='admin_main.php'>>> ".LAN_AIL_MENU_02." <<</a></b>";
        } else {
        $text1 .= "
        <a style='cursor:hand; text-decoration:none' href='admin_main.php'>".LAN_AIL_MENU_02."</a>";         
        }


$text1 .= "
                </td>
                </tr> ";


$text1 .= "
	<tr>
        <td style='width:30%' class='button'>";
        if (e_PAGE == "admin_config.php") {
        $text1 .= "
		<b>
		<a style='cursor:hand; text-decoration:none' href='admin_config.php'>>> ".LAN_AIL_MENU_01." <<</a></b>";
        } else {
        $text1 .= "
        <a style='cursor:hand; text-decoration:none' href='admin_config.php'>".LAN_AIL_MENU_01."</a>";         
        }


$text1 .= "
                </td>
                </tr><td style='width:30%' class='header'>-</b>";


$text1 .= "
        </td>
    </tr>

	<tr>
        <td style='width:30%' class='button'>";
        if (e_PAGE == "admin_new_cat.php") {
         $text1 .= "
		 <b><a style='cursor:hand; cursor:pointer; text-decoration:none;' href='admin_new_cat.php'>>> ".LAN_AIL_MENU_03." <<</a></b>";
		} else {
		 $text1 .="
		 <a style='cursor:hand; cursor:pointer; text-decoration:none;' href='admin_new_cat.php'>".LAN_AIL_MENU_03." </a>";
		}



$text1 .= "
                </td>
                </tr> ";
$text1 .= "
	<tr>
        <td style='width:30%' class='button'>";
        if (e_PAGE == "admin_edit_cat.php") {
         $text1 .= "
		<b>
		<a style='cursor:hand; text-decoration:none' href='admin_edit_cat.php'>>> ".LAN_AIL_MENU_04." <<</a>
		</b>";
		} else {
		$text1 .= "
		<a style='cursor:hand; text-decoration:none' href='admin_edit_cat.php'> ".LAN_AIL_MENU_04." </a>";
		}

$text1 .= "
                </td>
                </tr><tr><td style='width:30%' class='header'>-</b>";



$text1 .= "
        </td>
    </tr>

	<tr>
        <td style='width:30%' class='button'>";
        if (e_PAGE == "admin_new_subcat.php") {
         $text1 .= "
		 <b><a style='cursor:hand; cursor:pointer; text-decoration:none;' href='admin_new_subcat.php'>>> ".LAN_AIL_MENU_05." <<</a></b>";
		} else {
		 $text1 .="
		 <a style='cursor:hand; cursor:pointer; text-decoration:none;' href='admin_new_subcat.php'>".LAN_AIL_MENU_05."</a>";
		}



$text1 .= "
                </td>
                </tr> ";
$text1 .= "
	<tr>
        <td style='width:30%' class='button'>";
        if (e_PAGE == "admin_edit_subcat.php") {
         $text1 .= "
		<b>
		<a style='cursor:hand; text-decoration:none' href='admin_edit_subcat.php'>>> ".LAN_AIL_MENU_06." <<</a>
		</b>";
		} else {
		$text1 .= "
		<a style='cursor:hand; text-decoration:none' href='admin_edit_subcat.php'> ".LAN_AIL_MENU_06." </a>";
		}

$text1 .= "</td>
     </tr> <tr><td style='width:30%' class='header'>-</b></td></tr>";
$text1 .= "
	<tr>
        <td style='width:30%' class='button'>";
        if (e_PAGE == "admin_new.php") {
         $text1 .= "
		 <b><a style='cursor:hand; cursor:pointer; text-decoration:none;' href='admin_new.php'>>> ".LAN_AIL_MENU_07." <<</a></b>";
		} else {
		 $text1 .="
		 <a style='cursor:hand; cursor:pointer; text-decoration:none;' href='admin_new.php'>".LAN_AIL_MENU_07."</a>";
		}


$text1 .= "
                </td>
                </tr>";
$text1 .= "
	<tr>
        <td style='width:30%' class='button'>";
        if (e_PAGE == "admin_edit.php") {
         $text1 .= "
		<b>
		<a style='cursor:hand; text-decoration:none' href='admin_edit.php'>>> ".LAN_AIL_MENU_08." <<</a>
		</b>";
		} else {
		$text1 .= "
		<a style='cursor:hand; text-decoration:none' href='admin_edit.php'> ".LAN_AIL_MENU_08." </a>";
		}
         	
 


$text1 .= "
                </td>
                </tr><td style='width:30%' class='header'>-</b>";


$text1 .= "
        </td>
    </tr>
 
				
				</table>";




$text1 .= "<br><br><br><br><br><br>
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
