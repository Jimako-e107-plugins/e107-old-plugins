<?php

/*
#######################################
#     e107 website system plguin      #
#     AACGC Donation Listing          #
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
        if (e_PAGE == "admin_readme.php") {
        $text1 .= "
		<b>
		<a style='cursor:hand; text-decoration:none' href='admin_readme.php'>>> Main <<</a></b>";
        } else {
        $text1 .= "
        <a style='cursor:hand; text-decoration:none' href='admin_readme.php'>Main</a>";         
        }


$text1 .= "
                </td>
                </tr><td style='width:30%' class='header'>-</b>";



$text1 .= "
	<tr>
        <td style='width:30%' class='button'>";
        if (e_PAGE == "admin_config.php") {
        $text1 .= "
		<b>
		<a style='cursor:hand; text-decoration:none' href='admin_config.php'>>> Settings <<</a></b>";
        } else {
        $text1 .= "
        <a style='cursor:hand; text-decoration:none' href='admin_config.php'>Settings</a>";         
        }


$text1 .= "
                </td>
                </tr><td style='width:30%' class='header'>-</b>";



$text1 .= "
        </td>
    </tr>

	<tr>
        <td style='width:30%' class='button'>";
        if (e_PAGE == "admin_new_year.php") {
         $text1 .= "
		 <b><a style='cursor:hand; cursor:pointer; text-decoration:none;' href='admin_new_year.php'>>> Add New Year <<</a></b>";
		} else {
		 $text1 .="
		 <a style='cursor:hand; cursor:pointer; text-decoration:none;' href='admin_new_year.php'> Add New Year </a>";
		}


$text1 .= "
                </td>
                </tr><td style='width:30%' class='header'>-</b>";



$text1 .= "
        </td>
    </tr>

	<tr>
        <td style='width:30%' class='button'>";
        if (e_PAGE == "admin_new_month.php") {
         $text1 .= "
		 <b><a style='cursor:hand; cursor:pointer; text-decoration:none;' href='admin_new_month.php'>>> Add New Month <<</a></b>";
		} else {
		 $text1 .="
		 <a style='cursor:hand; cursor:pointer; text-decoration:none;' href='admin_new_month.php'> Add New Month </a>";
		}


$text1 .= "
                </td>
                </tr><td style='width:30%' class='header'>-</b>";




$text1 .= "
        </td>
    </tr>
	<tr>
        <td style='width:30%' class='button'>";
        if (e_PAGE == "admin_new_donator.php") {
         $text1 .= "
		<b>
		<a style='cursor:hand; text-decoration:none' href='admin_new_donator.php'>>> Add New Donator <<</a>
		</b>";
		} else {
		$text1 .= "
		<a style='cursor:hand; text-decoration:none' href='admin_new_donator.php'> Add New Donator </a>";
		}

$text1 .= "
                </td>
                </tr><td style='width:30%' class='header'>-</b>";


$text1 .= "
        </td>
    </tr>

	<tr>
        <td style='width:30%' class='button'>";
        if (e_PAGE == "admin_edit_year.php") {
         $text1 .= "
		 <b><a style='cursor:hand; cursor:pointer; text-decoration:none;' href='admin_edit_year.php'>>> Edit Year <<</a></b>";
		} else {
		 $text1 .="
		 <a style='cursor:hand; cursor:pointer; text-decoration:none;' href='admin_edit_year.php'> Edit Year </a>";
		}


$text1 .= "
                </td>
                </tr><td style='width:30%' class='header'>-</b>";



$text1 .= "
        </td>
    </tr>

	<tr>
        <td style='width:30%' class='button'>";
        if (e_PAGE == "admin_edit_month.php") {
         $text1 .= "
		 <b><a style='cursor:hand; cursor:pointer; text-decoration:none;' href='admin_edit_month.php'>>> Edit Month <<</a></b>";
		} else {
		 $text1 .="
		 <a style='cursor:hand; cursor:pointer; text-decoration:none;' href='admin_edit_month.php'> Edit Month </a>";
		}


$text1 .= "
                </td>
                </tr><td style='width:30%' class='header'>-</b>";




$text1 .= "
        </td>
    </tr>
	<tr>
        <td style='width:30%' class='button'>";
        if (e_PAGE == "admin_edit_donator.php") {
         $text1 .= "
		<b>
		<a style='cursor:hand; text-decoration:none' href='admin_edit_donator.php'>>> Edit Donator <<</a>
		</b>";
		} else {
		$text1 .= "
		<a style='cursor:hand; text-decoration:none' href='admin_edit_donator.php'> Edit Donator </a>";
		}




$text1 .= "
                </td>
                </tr><td style='width:30%' class='header'>-</b>";




$text1 .= "
        </td>
    </tr>
	<tr>
        <td style='width:30%' class='button'>";
        if (e_PAGE == "admin_vupdate.php") {
         $text1 .= "
		<b>
		<a style='cursor:hand; text-decoration:none' href='admin_vupdate.php'>>> Check For Updates <<</a>
		</b>";
		} else {
		$text1 .= "
		<a style='cursor:hand; text-decoration:none' href='admin_vupdate.php'> Check For Updates </a>";
		}









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
